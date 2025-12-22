<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class SendWaNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 60;

    protected $target;
    protected string $pesan;

    public function __construct($target, string $pesan)
    {
        $this->target = $target;
        $this->pesan  = $pesan;
    }

    /* ===============================
       NORMALISASI NOMOR
    =============================== */
    protected function extractPhone($input): ?string
    {
        if ($input instanceof Model) {
            $input = $input->telp ?? $input->phone ?? null;
        }

        if (!$input) return null;

        $telp = preg_replace('/\D+/', '', $input);

        if (preg_match('/^0/', $telp)) {
            $telp = '62' . substr($telp, 1);
        }

        if (!str_starts_with($telp, '62')) {
            $telp = '62' . $telp;
        }

        return strlen($telp) >= 9 ? $telp : null;
    }

    public function handle(): void
    {
        // 🚨 GLOBAL PAUSE
        if (cache()->get('wa_global_pause')) {
            Log::warning("WA PAUSE aktif, job dilewati");
            return;
        }

        $telp = $this->extractPhone($this->target);

        if (!$telp) {
            Log::warning("WA JOB: nomor tidak valid", ['target' => $this->target]);
            return;
        }

        Log::info("WA JOB → Kirim ke {$telp}");

        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
            'Accept'        => 'application/json',
        ])->timeout(30)->post('https://api.fonnte.com/send', [
            'target'      => $telp,
            'message'     => $this->pesan,
            'countryCode' => '62',
        ]);

        $body = $response->json();

        if ($response->status() == 429 || $response->status() >= 500) {
            throw new \Exception("Provider error {$response->status()}");
        }

        if (isset($body['status']) && $body['status'] === false) {
            $reason = strtolower($body['reason'] ?? '');

            if (str_contains($reason, 'disconnect') || str_contains($reason, 'device')) {
                cache()->put('wa_global_pause', true, now()->addMinutes(30));
                throw new \Exception("Device WA disconnected");
            }

            Log::error("WA JOB gagal permanen", [
                'target' => $telp,
                'reason' => $body
            ]);

            return;
        }

        Log::info("WA JOB berhasil", ['target' => $telp]);
    }

    public function failed(\Throwable $e)
    {
        Log::error("WA JOB FAILED TOTAL", [
            'error' => $e->getMessage(),
            'target' => $this->target
        ]);
    }
}

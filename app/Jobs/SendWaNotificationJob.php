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
    public $backoff = 30;

    public $target;
    public $pesan;

    /**
     * @param mixed $target string|Model|array
     */
    public function __construct($target, string $pesan)
    {
        $this->target = $target;
        $this->pesan  = $pesan;
    }

 
    protected function extractPhone($input): ?string
    {
        if (is_string($input)) {
            $trim = trim($input);
            if ((str_starts_with($trim, '{') || str_starts_with($trim, '[')) && $json = json_decode($trim, true)) {
                $input = $json;
            } else {
                $tel = preg_replace('/\D+/', '', $input);
                if (preg_match('/^0+/', $tel)) {
                    $tel = preg_replace('/^0+/', '62', $tel);
                }
                if (!preg_match('/^62/', $tel)) {
                    $tel = '62' . ltrim($tel, '0');
                }
                return strlen($tel) >= 9 ? $tel : null;
            }
        }

        if ($input instanceof Model) {
            foreach (['telp', 'phone', 'no_hp', 'telepon', 'telephone'] as $attr) {
                if ($input->getAttribute($attr)) {
                    return $this->extractPhone($input->getAttribute($attr));
                }
            }

            $arr = $input->toArray();
            $phone = $this->extractPhone($arr);
            return $phone;
        }

        if (is_array($input)) {
            foreach (['telp', 'phone', 'no_hp', 'telepon', 'telephone', 'target'] as $k) {
                if (isset($input[$k]) && $input[$k]) {
                    return $this->extractPhone($input[$k]);
                }
            }
            return null;
        }

        return null;
    }

    public function handle(): void
    {
        $rawTarget = $this->target;

        $telp = $this->extractPhone($rawTarget);

        if (empty($telp)) {
            Log::warning("SendWaNotificationJob: gagal — tidak menemukan nomor telepon dari target", [
                'target_raw' => $rawTarget,
            ]);
            return; 
        }

        Log::info("WA JOB → Mengirim WA ke target", ['target' => $telp]);

        $payload = [
            'target'      => $telp,
            'message'     => $this->pesan,
            'countryCode' => '62',
        ];

        try {
            $response = Http::withHeaders([
               'Authorization' => 'pANbKpk5VMVSHXsGwMyx',
                'Accept'        => 'application/json',
            ])->timeout(30)
              ->post('https://api.fonnte.com/send', $payload);

            $httpStatus = $response->status();
            $body = null;
            try {
                $body = $response->json();
            } catch (\Throwable $e) {
                $body = ['raw_body' => $response->body()];
            }

            Log::info("WA JOB → Response Fonnte", ['status' => $httpStatus, 'body' => $body]);

            $providerStatus = null;
            if (is_array($body) && isset($body['status'])) {
                $providerStatus = $body['status'];
            } elseif (is_array($body) && isset($body['response']['status'])) {
                $providerStatus = $body['response']['status'];
            }

            if ($httpStatus >= 500 || $httpStatus == 429) {
                throw new \Exception("Provider HTTP {$httpStatus}");
            }

            if ($providerStatus === false) {
                $reason = $body['response']['reason'] ?? ($body['reason'] ?? null);
                $reasonL = strtolower((string) $reason);
                Log::warning("WA JOB → provider returned status:false", ['reason' => $reason, 'target' => $telp]);

                if (str_contains($reasonL, 'disconnected') || str_contains($reasonL, 'device')) {
                    throw new \Exception("Provider disconnected: " . $reason);
                }

                Log::error("WA JOB → permanent failure, skip", ['target' => $telp, 'reason' => $reason, 'body' => $body]);
                return;
            }

            if ($httpStatus >= 200 && $httpStatus < 300 && ($providerStatus === true || $providerStatus === null)) {
                Log::info("WA JOB → berhasil mengirim ke {$telp}", ['provider_body' => $body]);
                return;
            }

            throw new \Exception("Unexpected provider response");
        } catch (\Throwable $e) {
            Log::error("WA JOB → Gagal mengirim ke {$telp}: " . $e->getMessage(), [
                'exception' => $e,
            ]);
            throw $e; 
        }
    }

    public function failed(\Throwable $exception)
    {
        Log::error("SendWaNotificationJob failed permanently: " . $exception->getMessage(), [
            'target_raw' => $this->target,
            'pesan' => $this->pesan,
        ]);

       
    }
}

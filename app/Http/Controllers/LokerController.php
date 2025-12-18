<?php

namespace App\Http\Controllers;

use App\Jobs\SendWaNotificationJob;
use App\Models\Loker;
use App\Models\Alumni;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokerController extends Controller
{

    public function index()
    {
        $query = Loker::with('alumni')->latest();
        $filter = request('filter');

        if ($filter === 'mine' && Auth::check() && Auth::user()->alumni) {
            $query->where('id_alumni', Auth::user()->alumni->id);
        }

        if ($filter === 'expired') {
            $query->whereDate('masa_aktif', '<', now()->toDateString());
        }

        $lokers = $query->get();

        return view('admin.loker.index', compact('lokers'));
    }



  
    public function create()
    {
        $alumni = Alumni::all();
        return view('admin.loker.create', compact('alumni'));
    }

  
public function store(Request $request)
{
    $request->validate([
        'nama'        => 'required',
        'lokasi'      => 'nullable',
        'deskripsi'   => 'nullable',
        'id_alumni'   => 'nullable|exists:alumnis,id',
        'masa_aktif'  => 'nullable|date',
        'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:12048',
    ]);

    $data = $request->only([
        'nama',
        'lokasi',
        'deskripsi',
        'id_alumni',
        'masa_aktif',
    ]);

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('loker', 'public');
    }

    $loker = Loker::create($data);

   
    $alumnis = Alumni::where('status_bekerja', 'belum_bekerja')->get();

    $index = 0; // untuk delay 120 detik per pesan (2 menit)

    foreach ($alumnis as $alumni) {
        // // Simpan notifikasi ke DB (supaya tetap ada di aplikasi)
        // Notification::create([
        //     'user_id'   => $alumni->id_user,                // pastikan alumni punya user_id
        //     'aktivitas' => 'Lowongan baru: ' . $loker->nama,
        //     'waktu'     => now(),
        //     'read_at'   => null,
        // ]);

        // Jika alumni punya nomor handphone, dispatch job WA
        $raw = $alumni->telp ?? $alumni->phone ?? null; // sesuaikan field model
        if (empty($raw)) {
            continue;
        }

        $telp = preg_replace('/\D+/', '', $raw);

        if (strpos($raw, '+62') === 0) {
            $telp = preg_replace('/^\+/', '', $raw);
            $telp = preg_replace('/\D+/', '', $telp);
        }

        if (preg_match('/^0+/', $telp)) {
            $telp = preg_replace('/^0+/', '62', $telp);
        }

        if (!preg_match('/^62/', $telp)) {
            $telp = '62' . ltrim($telp, '0');
        }

        if (strlen($telp) < 9) {
            Log::warning("store(Loker): nomor alumni di-skip karena tidak valid", [
                'alumni_id' => $alumni->id,
                'raw' => $raw,
                'normalized' => $telp,
            ]);
            continue;
        }

        $pesan = "Lowongan Baru 📣

Nama Lowongan: *{$loker->nama}*
Lokasi: *" . ($loker->lokasi ?? '-') . "*
Deskripsi: *" . (strlen($loker->deskripsi) ? $loker->deskripsi : '-') . "*
Masa Aktif: *" . ($loker->masa_aktif ? $loker->masa_aktif->format('Y-m-d') : '-') . "*

Silakan cek detail dan segera apply jika berminat.
Terima kasih.";

        $delaySeconds = 500 * $index;

        SendWaNotificationJob::dispatch($alumni, $pesan)
            ->delay(now()->addSeconds($delaySeconds));

        $index++;
    }

    return redirect()->route('loker.index')->with('success', 'Loker berhasil ditambahkan dan notifikasi/WA telah dijadwalkan untuk dikirim');
}

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama'        => 'required',
    //         'lokasi'      => 'nullable',
    //         'deskripsi'   => 'nullable',
    //         'id_alumni'   => 'nullable|exists:alumnis,id',
    //         'masa_aktif'  => 'nullable|date',
    //         'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     $data = $request->only([
    //         'nama',
    //         'lokasi',
    //         'deskripsi',
    //         'id_alumni',
    //         'masa_aktif',
    //     ]);

    //     // Upload Foto
    //     if ($request->hasFile('foto')) {
    //         $data['foto'] = $request->file('foto')->store('loker', 'public');
    //     }

    //     // Simpan Loker
    //     $loker = Loker::create($data);


    //     $alumnis = \App\Models\Alumni::where('status_bekerja', 'belum_bekerja')->get();

    //     foreach ($alumnis as $alumni) {
    //         \App\Models\Notification::create([
    //             'user_id'   => $alumni->id_user,                // pastikan alumni punya user_id
    //             'aktivitas' => 'Lowongan baru: ' . $loker->nama,
    //             'waktu'     => now(),
    //             'read_at'   => null,
    //         ]);
    //     }

    //     return redirect()->route('loker.index')->with('success', 'Loker berhasil ditambahkan dan notifikasi telah dikirim');
    // }



    public function show($id)
    {
        $loker = Loker::with('alumni')->findOrFail($id);
        return view('admin.loker.show', compact('loker'));
    }


    public function edit($id)
    {
        $loker = Loker::findOrFail($id);
        $alumni = Alumni::all();

        return view('admin.loker.edit', compact('loker', 'alumni'));
    }

 
    public function update(Request $request, $id)
    {
        $loker = Loker::findOrFail($id);

        $request->validate([
            'nama'        => 'required',
            'lokasi'      => 'nullable',
            'deskripsi'   => 'nullable',
            'id_alumni'   => 'nullable|exists:alumnis,id',
            'masa_aktif'  => 'nullable|date',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:12048',
        ]);

        $data = $request->only([
            'nama',
            'lokasi',
            'deskripsi',
            'id_alumni',
            'masa_aktif',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('loker', 'public');
        }

        $loker->update($data);

        return redirect()->route('loker.index')->with('success', 'Loker berhasil diperbarui');
    }


    public function destroy($id)
    {
        $loker = Loker::findOrFail($id);
        $loker->delete();

        return redirect()->route('loker.index')->with('success', 'Loker berhasil dihapus');
    }
}

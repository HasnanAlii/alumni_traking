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
            'nama','lokasi','deskripsi','id_alumni','masa_aktif'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('loker', 'public');
        }

        $loker = Loker::create($data);

        $hour = now('Asia/Jakarta')->hour;
        if ($hour < 8 || $hour > 20) {
            return redirect()->route('loker.index')
                ->with('warning', 'Loker disimpan, WA dikirim di jam kerja.');
        }


        $alumnis = Alumni::where('status_bekerja', 'belum_bekerja')
            ->limit(30) 
            ->get();

        $templates = [
            "Pemberitahuan Lowongan Pekerjaan\n\n"
            . "Nama Lowongan : {{loker}}\n"
            . "Lokasi        : {{lokasi}}\n"
            . "Masa Berlaku  : {{masa}}\n\n"
            . "Silakan login ke sistem untuk melihat detail dan melakukan pendaftaran.",
        ];


        $index = 0;

        foreach ($alumnis as $alumni) {
                Notification::create([
                    'user_id'   => $alumni->id_user,              
                    'aktivitas' => 'Lowongan baru: ' . $loker->nama,
                    'waktu'     => now(),
                    'read_at'   => null,
                ]);


            $raw = $alumni->telp ?? $alumni->phone ?? null;
            if (!$raw) continue;

            $template = $templates[array_rand($templates)];

            $pesan = str_replace(
                ['{{nama}}','{{loker}}','{{lokasi}}','{{masa}}'],
                [
                    $alumni->nama,
                    $loker->nama,
                    $loker->lokasi ?? '-',
                    optional($loker->masa_aktif)->format('d-m-Y') ?? '-'
                ],
                $template
            );

            // $pesan .= "\n\nBalas *STOP* untuk berhenti menerima info.";

            // ⏱ Random delay 3–6 menit
            $delaySeconds = ($index * rand(180, 360));

            SendWaNotificationJob::dispatch($alumni, $pesan)
                ->delay(now()->addSeconds($delaySeconds));

            $index++;
        }

        return redirect()->route('loker.index')
            ->with('success', 'Loker berhasil ditambahkan & WA dijadwalkan aman.');
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

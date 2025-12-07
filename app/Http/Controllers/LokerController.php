<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokerController extends Controller
{
    /**
     * Menampilkan semua loker
     */
    public function index()
    {
        $query = Loker::with('alumni')->latest();

        if (request('filter') === 'mine' && auth::check() && auth::user()->alumni) {
            $query->where('id_alumni', Auth::user()->alumni->id);
        }

        $lokers = $query->get();

        return view('admin.loker.index', compact('lokers'));
    }


    /**
     * Form tambah loker
     */
    public function create()
    {
        $alumni = Alumni::all();
        return view('admin.loker.create', compact('alumni'));
    }

    /**
     * Simpan loker baru
     */
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

    //     // Upload foto
    //     if ($request->hasFile('foto')) {
    //         $data['foto'] = $request->file('foto')->store('loker', 'public');
    //     }

    //     Loker::create($data);

    //     return redirect()->route('loker.index')->with('success', 'Loker berhasil ditambahkan');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required',
            'lokasi'      => 'nullable',
            'deskripsi'   => 'nullable',
            'id_alumni'   => 'nullable|exists:alumnis,id',
            'masa_aktif'  => 'nullable|date',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama',
            'lokasi',
            'deskripsi',
            'id_alumni',
            'masa_aktif',
        ]);

        // Upload Foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('loker', 'public');
        }

        // Simpan Loker
        $loker = Loker::create($data);

        /* ============================================================
        KIRIM NOTIFIKASI KE SEMUA ALUMNI STATUS BELUM BEKERJA
        ============================================================ */

        $alumnis = \App\Models\Alumni::where('status_bekerja', 'belum_bekerja')->get();

        foreach ($alumnis as $alumni) {
            \App\Models\Notification::create([
                'user_id'   => $alumni->id_user,                // pastikan alumni punya user_id
                'aktivitas' => 'Lowongan baru: ' . $loker->nama,
                'waktu'     => now(),
                'read_at'   => null,
            ]);
        }

        return redirect()->route('loker.index')->with('success', 'Loker berhasil ditambahkan dan notifikasi telah dikirim');
    }


    /**
     * Detail loker
     */
    public function show($id)
    {
        $loker = Loker::with('alumni')->findOrFail($id);
        return view('admin.loker.show', compact('loker'));
    }

    /**
     * Form edit loker
     */
    public function edit($id)
    {
        $loker = Loker::findOrFail($id);
        $alumni = Alumni::all();

        return view('admin.loker.edit', compact('loker', 'alumni'));
    }

    /**
     * Update loker
     */
    public function update(Request $request, $id)
    {
        $loker = Loker::findOrFail($id);

        $request->validate([
            'nama'        => 'required',
            'lokasi'      => 'nullable',
            'deskripsi'   => 'nullable',
            'id_alumni'   => 'nullable|exists:alumnis,id',
            'masa_aktif'  => 'nullable|date',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama',
            'lokasi',
            'deskripsi',
            'id_alumni',
            'masa_aktif',
        ]);

        // Upload foto baru
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('loker', 'public');
        }

        $loker->update($data);

        return redirect()->route('loker.index')->with('success', 'Loker berhasil diperbarui');
    }

    /**
     * Hapus loker
     */
    public function destroy($id)
    {
        $loker = Loker::findOrFail($id);
        $loker->delete();

        return redirect()->route('loker.index')->with('success', 'Loker berhasil dihapus');
    }
}

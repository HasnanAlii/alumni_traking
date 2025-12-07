<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AlumniController extends Controller
{
    /**
     * Menampilkan semua alumni
     */
    public function index()
    {
        $alumni = Alumni::latest()->paginate(10);

        $total_alumni        = Alumni::count();
        $total_bekerja       = Alumni::where('status_bekerja', 'bekerja')->count();
        $total_belum_bekerja = Alumni::where('status_bekerja', 'belum_bekerja')->count();

        return view('admin.alumni.index', compact(
            'alumni',
            'total_alumni',
            'total_bekerja',
            'total_belum_bekerja',
        ));
    }

    /**
     * Form tambah alumni
     */
    public function create()
    {
        return view('admin.alumni.create');
    }

    /**
     * Simpan alumni baru + buat akun user alumni
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Alumni
            'nama'           => 'required|string|max:255',
            'tahun_lulus'    => 'nullable|digits:4',
            'telp'           => 'nullable|string|max:20',
            'status_bekerja' => 'nullable|in:bekerja,belum_bekerja,wirausaha',
            'jenis_kelamin'  => 'nullable|in:L,P',
            'tanggal_lahir'  => 'nullable|date',
            'alamat'         => 'nullable|string',

            // User
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        DB::transaction(function () use ($validated) {
            // 1. Buat User
            $user = User::create([
                'name'     => $validated['nama'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Beri role alumni (pastikan role sudah ada)
            if (method_exists($user, 'assignRole')) {
                $user->assignRole('alumni');
            }

            // 2. Buat Alumni
            Alumni::create([
                'nama'           => $validated['nama'],
                'tahun_lulus'    => $validated['tahun_lulus'] ?? null,
                'telp'           => $validated['telp'] ?? null,
                'status_bekerja' => $validated['status_bekerja'] ?? null,
                'jenis_kelamin'  => $validated['jenis_kelamin'] ?? null,
                'tanggal_lahir'  => $validated['tanggal_lahir'] ?? null,
                'alamat'         => $validated['alamat'] ?? null,
                'id_user'        => $user->id,
            ]);
        });

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Data alumni dan akun user berhasil ditambahkan.');
    }

    /**
     * Detail alumni
     */
    public function show($id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);
        return view('admin.alumni.show', compact('alumni'));
    }

    /**
     * Form edit alumni + user
     */
    public function edit($id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);
        return view('admin.alumni.edit', compact('alumni'));
    }

    /**
     * Update alumni + akun user alumni
     */
    public function update(Request $request, $id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);

        $validated = $request->validate([
            // Alumni
            'nama'           => 'required|string|max:255',
            'tahun_lulus'    => 'nullable|digits:4',
            'telp'           => 'nullable|string|max:20',
            'status_bekerja' => 'nullable|in:bekerja,belum_bekerja,wirausaha',
            'jenis_kelamin'  => 'nullable|in:L,P',
            'tanggal_lahir'  => 'nullable|date',
            'alamat'         => 'nullable|string',

            // User
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(optional($alumni->user)->id),
            ],
            'password' => 'nullable|string|min:6',
        ]);

        DB::transaction(function () use ($validated, $alumni) {

            // 1. Update / buat user
            if ($alumni->user) {
                // Update user yang sudah ada
                $user = $alumni->user;
                $user->name  = $validated['nama'];
                $user->email = $validated['email'];

                if (!empty($validated['password'])) {
                    $user->password = Hash::make($validated['password']);
                }

                $user->save();
            } else {
                // Kalau belum punya user, buat baru
                $user = User::create([
                    'name'     => $validated['nama'],
                    'email'    => $validated['email'],
                    'password' => !empty($validated['password'])
                        ? Hash::make($validated['password'])
                        : Hash::make('password123'), // default jika admin lupa isi
                ]);

                if (method_exists($user, 'assignRole')) {
                    $user->assignRole('alumni');
                }

                $alumni->id_user = $user->id;
            }

            // 2. Update Alumni
            $alumni->nama           = $validated['nama'];
            $alumni->tahun_lulus    = $validated['tahun_lulus'] ?? null;
            $alumni->telp           = $validated['telp'] ?? null;
            $alumni->status_bekerja = $validated['status_bekerja'] ?? null;
            $alumni->jenis_kelamin  = $validated['jenis_kelamin'] ?? null;
            $alumni->tanggal_lahir  = $validated['tanggal_lahir'] ?? null;
            $alumni->alamat         = $validated['alamat'] ?? null;

            $alumni->save();
        });

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Data alumni dan akun user berhasil diperbarui.');
    }

    /**
     * Hapus alumni (+ opsional hapus user)
     */
    public function destroy($id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);

        DB::transaction(function () use ($alumni) {
            // Jika ingin sekalian hapus user:
            // if ($alumni->user) {
            //     $alumni->user->delete();
            // }

            $alumni->delete();
        });

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil dihapus.');
    }
}

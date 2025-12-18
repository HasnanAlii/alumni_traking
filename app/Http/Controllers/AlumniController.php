<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Imports\AlumniImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;

class AlumniController extends Controller
{

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
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new AlumniImport, $request->file('file'));

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil diimport');
    }

 
    public function create()
    {
        return view('admin.alumni.create');
    }


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
            $user = User::create([
                'name'     => $validated['nama'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            if (method_exists($user, 'assignRole')) {
                $user->assignRole('alumni');
            }

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


    public function show($id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);
        return view('admin.alumni.show', compact('alumni'));
    }


    public function edit($id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);
        return view('admin.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);

        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'tahun_lulus'    => 'nullable|digits:4',
            'telp'           => 'nullable|string|max:20',
            'status_bekerja' => 'nullable|in:bekerja,belum_bekerja,wirausaha',
            'jenis_kelamin'  => 'nullable|in:L,P',
            'tanggal_lahir'  => 'nullable|date',
            'alamat'         => 'nullable|string',

            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(optional($alumni->user)->id),
            ],
            'password' => 'nullable|string|min:6',
        ]);

        DB::transaction(function () use ($validated, $alumni) {

            if ($alumni->user) {
                $user = $alumni->user;
                $user->name  = $validated['nama'];
                $user->email = $validated['email'];

                if (!empty($validated['password'])) {
                    $user->password = Hash::make($validated['password']);
                }

                $user->save();
            } else {
                $user = User::create([
                    'name'     => $validated['nama'],
                    'email'    => $validated['email'],
                    'password' => !empty($validated['password'])
                        ? Hash::make($validated['password'])
                        : Hash::make('password'), 
                ]);

                if (method_exists($user, 'assignRole')) {
                    $user->assignRole('alumni');
                }

                $alumni->id_user = $user->id;
            }

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

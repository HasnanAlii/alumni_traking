<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show edit profile page.
     */

    public function edit(Request $request): View
    {
        $user = Auth::user();        // user yang sedang login
        $alumni = $user->alumni;     // data alumni sesuai id_user

        return view('profile.edit', compact('user', 'alumni'));
    }


    /**
     * Update profile information (name, email, foto, password).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // === UPDATE NAMA & EMAIL ===
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika email berubah -> reset verifikasi
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // === UPDATE FOTO PROFILE ===
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto-profil', 'public');
            $user->foto = $path;
        }

        // === UPDATE PASSWORD (opsional) ===
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    public function updateAlumni(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'tahun_lulus'    => 'nullable|digits:4',
            'telp'           => 'nullable|string|max:20',
            'status_bekerja' => 'nullable|in:bekerja,belum_bekerja,wirausaha',
            'jenis_kelamin'  => 'nullable|in:L,P',
            'tanggal_lahir'  => 'nullable|date',
            'alamat'         => 'nullable|string',
        ]);

        $alumni = $request->user()->alumni;

        $alumni->update([
            'nama'           => $request->nama,
            'tahun_lulus'    => $request->tahun_lulus,
            'telp'           => $request->telp,
            'status_bekerja' => $request->status_bekerja,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
        ]);

        return back()->with('status', 'profile-updated');
    }

    /**
     * Delete user account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Loker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
 public function index()
{
    $user = Auth::user();

    // Jika Admin
      if ($user->hasRole('admin')) {

        $total_alumni   = Alumni::count();
        $total_loker    = Loker::count();
        $alumni_bekerja = Alumni::where('status_bekerja', 'bekerja')->count();

        $recent_alumni = Alumni::latest()->take(5)->get();

        return view('dashboard', compact(
            'total_alumni',
            'total_loker',
            'alumni_bekerja',
            'recent_alumni'
        ));
    }

    // Jika Alumni
      if ($user->hasRole('alumni')) {

        $alumni = $user->alumni; // relasi hasOne alumni di User

        $latest_loker = Loker::with('alumni')->latest()->take(3)->get();
        $total_loker = Loker::count();

        return view('dashboard_alumni', compact(
            'user',
            'alumni',
            'latest_loker',
            'total_loker'
        ));
    }

    // Jika role tidak dikenali
    abort(403, 'Akses tidak diizinkan');
}

}

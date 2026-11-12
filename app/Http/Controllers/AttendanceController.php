<?php

namespace App\Http\Controllers;

use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $today = Attendance::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->first();

        $riwayat = Attendance::where('user_id', $user->id)
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('dashboard', compact('today', 'riwayat'));
    }

    public function masuk()
    {
        $user = auth()->user();

        $sudah = Attendance::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->exists();

        if ($sudah) {
            return back()->with('error', 'Anda sudah absen masuk hari ini.');
        }

        $status = now()->format('H:i') > '08:00' ? 'terlambat' : 'hadir';

        Attendance::create([
            'user_id'   => $user->id,
            'tanggal'   => today(),
            'jam_masuk' => now()->format('H:i:s'),
            'status'    => $status,
        ]);

        return back()->with('success', 'Absen masuk berhasil (' . $status . ').');
    }

    public function pulang()
    {
        $absen = Attendance::where('user_id', auth()->id())
            ->whereDate('tanggal', today())
            ->first();

        if (!$absen) {
            return back()->with('error', 'Anda belum absen masuk hari ini.');
        }

        if ($absen->jam_pulang) {
            return back()->with('error', 'Anda sudah absen pulang.');
        }

        $absen->update(['jam_pulang' => now()->format('H:i:s')]);

        return back()->with('success', 'Absen pulang berhasil.');
    }
}
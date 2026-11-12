<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal', today()->toDateString());

        $data = Attendance::with('user')
            ->whereDate('tanggal', $tanggal)
            ->orderBy('jam_masuk')
            ->paginate(20)
            ->withQueryString();

        return view('admin.attendance', compact('data', 'tanggal'));
    }
}
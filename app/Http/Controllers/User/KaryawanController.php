<?php

namespace App\Http\Controllers\User;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KaryawanController extends Controller
{
    public function index() {
        return view('user.karyawan.index');
    }

    public function getDatakaryawan(Request $request) {
        $perPage = $request->input('per_page', 10); // Default 10 data per halaman
        $karyawan = Karyawan::paginate($perPage);
        return response()->json([
            'status' => true,
            'message' => 'Karyawan Berhasil diload',
            'data' => $karyawan
        ], 200);
    }
}

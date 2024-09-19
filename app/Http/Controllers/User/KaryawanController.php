<?php

namespace App\Http\Controllers\User;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KaryawanController extends Controller
{
    public function index()
    {
        return view('user.karyawan.index');
    }

    public function getDatakaryawan(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
    
        if ($request->ajax() || $request->isXmlHttpRequest()) {
            $karyawan = Karyawan::paginate($perPage);
    
            return response()->json($karyawan); 
        }
    
    }
}

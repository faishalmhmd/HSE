<?php

namespace App\Http\Controllers\User;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KaryawanController extends Controller
{   
    // this function return index page of karyawan
    // return : karyawan index page
    public function index()
    {
        return view('user.karyawan.index');
    }

    // this function to dipslay list karyawan data with pagination
    // return : data karyawan with pagination
    public function getDatakaryawan(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        if ($request->ajax() || $request->isXmlHttpRequest()) {
            $karyawan = Karyawan::paginate($perPage);
            return response()->json($karyawan); 
        }
    
    }

    // this function to display add data karyawan
    // return :  display page add karyawan
    public function add(){
        return view('user.karyawan.add');
    }
}

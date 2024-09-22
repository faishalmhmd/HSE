<?php

namespace App\Http\Controllers\User;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KaryawanController extends Controller
{   
    //======================================= WEB Karyawan

    // this function return index page of karyawan
    // return : karyawan index page
    public function index()
    {
        return view('user.karyawan.index');
    }
   
    // this function to display add data karyawan
    // return :  display page add karyawan
    public function add(){
        return view('user.karyawan.add');
    }

    //======================================= API Karyawan


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

    // this function store data karyawan into db
    // return :  response data
    public function insertDataKaryawan(Request $request) {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'      => 'required|email|unique:karyawan,email',
            'tgl_lahir'  => 'required|date',
            'tgl_masuk'  => 'required|date',
        ]);
        $karyawan = Karyawan::create([
            'nama' => $validatedData['nama_lengkap'],
            'email'      => $validatedData['email'],
            'tgl_lahir'  => $validatedData['tgl_lahir'],
            'tgl_masuk'  => $validatedData['tgl_masuk'],
        ]);

        return response()->json([
            'message' => 'Data karyawan berhasil disimpan',
            'data'    => $karyawan
        ], 201);
    }

    //======================================= Report API


    // this function 
    // return :  

}

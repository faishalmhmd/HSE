<?php

namespace App\Http\Controllers\User;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;


class KaryawanController extends Controller
{   
    //======================================= WEB Karyawan

    // this function return index page of karyawan
    // return : karyawan index page
    public function index(){
        return view('user.karyawan.index');
    }
   
    // this function to display add data karyawan
    // return :  display page add karyawan
    public function add(){
        return view('user.karyawan.add');
    }

    // this function edit karyawan
    // return :  display edit karyawan
    public function edit($id) {
        $karyawan = Karyawan::findOrfail($id);
        return view('user.karyawan.edit',compact('karyawan'));
    }


    //======================================= API Karyawan


    // this function to dipslay list karyawan data with pagination
    // return : data karyawan with pagination
    public function getDatakaryawan(Request $request)
    {
        $perPage = 10; 
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $searchQuery = $request->input('search', ''); 
    
        if ($request->ajax() || $request->isXmlHttpRequest()) {
            $query = Karyawan::query();
    
            // Apply search filter if there is a search query
            if (!empty($searchQuery)) {
                $query->where(function($query) use ($searchQuery) {
                    $query->where('nama', 'like', "%{$searchQuery}%")
                          ->orWhere('email', 'like', "%{$searchQuery}%");
                });
                // Fetch all matching results without pagination
                $karyawan = $query->orderBy($sortBy, $sortOrder)->get(); // Use get() instead of paginate()
                return response()->json([
                    'data' => $karyawan,
                    'pagination' => null // Clear pagination info
                ]);
            }
    
            // Fetch paginated results if there is no search query
            $karyawan = $query->orderBy($sortBy, $sortOrder)->paginate($perPage);
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

    // this function edit data karyawan 
    // return :  response data
    public function editDataKaryawan(Request $request) {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tgl_lahir' => 'required|date',
            'tgl_masuk' => 'required|date',
        ]);
    
        $karyawan = Karyawan::findOrFail($request->id);
        $karyawan->nama = $request->nama_lengkap;
        $karyawan->email = $request->email;
        $karyawan->tgl_lahir = $request->tgl_lahir;
        $karyawan->tgl_masuk = $request->tgl_masuk;
    
        $karyawan->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Data karyawan updated successfully.',
            'data' => $karyawan
        ],200);

    }

    // this function search karyawan
    // return :  data karyawan
    public function searchDataKaryawan(Request $request)
    {
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $searchQuery = $request->input('search', '');

        if ($request->ajax() || $request->isXmlHttpRequest()) {
            $query = Karyawan::query();

            // Apply search filter if there is a search query
            if (!empty($searchQuery)) {
                $query->where(function($query) use ($searchQuery) {
                    $query->where('nama', 'like', "%{$searchQuery}%")
                        ->orWhere('email', 'like', "%{$searchQuery}%");
                });
            }

            // Fetch all matching results without pagination
            $karyawan = $query->orderBy($sortBy, $sortOrder)->get();
            return response()->json([
                'data' => $karyawan,
                'pagination' => null // Clear pagination info
            ]);
        }
    }
    //======================================= Report API


    // this function report pdf
    // return :  file pdf
    public function exportDataKaryawan() {
        $karyawan = Karyawan::all();
        $pdf = Pdf::loadView('user.karyawan.pdf', compact('karyawan'));
        return $pdf->download('user.karyawan.pdf');
    }

}

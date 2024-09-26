<?php

namespace App\Http\Controllers\User;

use App\Models\Mandor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class MandorController extends Controller
{
    //======================================= WEB Mandor

    // this function return index page of Mandor
    // return : mandor index page
    public function index(){
        return view('user.mandor.index');
    }


    //======================================= API Karyawan


    // this function to dipslay list karyawan data with pagination
    // return : data karyawan with pagination
    public function getDataMandor(Request $request)
    {
        $perPage = 10; 
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $searchQuery = $request->input('search', ''); 
    
        if ($request->ajax() || $request->isXmlHttpRequest()) {
            $query = Mandor::query();
    
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
}

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


    //======================================= API mandor


    // this function to dipslay list mandor data with pagination
    // return : data mandor with pagination
    public function getDataMandor(Request $request)
    {
        $perPage = 10; 
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $searchQuery = $request->input('search', ''); 
        if ($request->ajax() || $request->isXmlHttpRequest()) {
            $query = Mandor::query();
            if (!empty($searchQuery)) {
                $query->where(function($query) use ($searchQuery) {
                    $query->where('nama', 'like', "%{$searchQuery}%")
                          ->orWhere('email', 'like', "%{$searchQuery}%");
                });
                $mandor = $query->orderBy($sortBy, $sortOrder)->get(); 
                return response()->json([
                    'data' => $mandor,
                    'pagination' => null 
                ]);
            }
            $mandor = $query->orderBy($sortBy, $sortOrder)->paginate($perPage);
            return response()->json($mandor); 
        }
    }

    // this function search mandor
    // return :  data mandor
    public function searchDataMandor(Request $request)
    {
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $searchQuery = $request->input('search', '');

        if ($request->ajax() || $request->isXmlHttpRequest()) {
            $query = mandor::query();
            if (!empty($searchQuery)) {
                $query->where(function($query) use ($searchQuery) {
                    $query->where('nama', 'like', "%{$searchQuery}%")
                        ->orWhere('email', 'like', "%{$searchQuery}%");
                });
            }
            $mandor = $query->orderBy($sortBy, $sortOrder)->get();
            return response()->json([
                'data' => $mandor,
                'pagination' => null 
            ]);
        }
    }

    //======================================= Report API


    // this function report pdf
    // return :  file pdf
    public function exportDataMandor() {
        $mandor = Mandor::all();
        $pdf = Pdf::loadView('user.mandor.pdf', compact('mandor'));
        return $pdf->download('user.mandor.pdf');
    }

}

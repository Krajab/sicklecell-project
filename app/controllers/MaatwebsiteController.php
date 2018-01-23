<?php

namespace App\Controllers;

use App\Requests;

use Illuminate\Http\Request;

use DB;

use Session;

use Excel;

class MaatwebsiteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    // public function importExport()
    // {
    //     return view('unhls_patient.index');
        public function downloadExcel()
    {
        $unhls_patients = Post::get()->toArray();
        return Excel::create('laravelcode', function($excel) use ($unhls_patients) {
            $excel->sheet('mySheet', function($sheet) use ($unhls_patients)
            {
                $sheet->fromArray($unhls_patients);
            });
        })->download(xlsx);

    }

        Session::put('success', 'Youe file successfully downloaded your file!!!');

        return back();
    }
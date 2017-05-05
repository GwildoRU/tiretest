<?php

namespace App\Http\Controllers;

use App\Services\PricelistService;
use Illuminate\Http\Request;

class PricelistController extends Controller
{

    public function uploadForm()
    {
        return view('uploadform');
    }


    public function doUpload(Request $request, PricelistService $pls)
    {
        $f = $request->file()['file'];
        $f->move(storage_path('upload'), $f->getClientOriginalName());
        $pls->upload($f->getClientOriginalName());
        return redirect('/');
    }

}

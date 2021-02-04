<?php

namespace App\Http\Controllers;

use App\Rak;
use App\SearchBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchBukuController extends Controller{

    public function searchbuku($keyword){

        $rak = Rak::where('judul','like','%'. $keyword.'%')->where('status','buku')->get();
        return response()->json($rak, 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\Rak;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller{

    public function searchjurnal($keyword){

        $rak = Rak::where('judul','like','%'. $keyword.'%')->where('status','jurnal')->get();
        return response()->json($rak, 200);
    }
}
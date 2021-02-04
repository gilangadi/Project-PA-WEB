<?php

namespace App\Http\Controllers;

use App\User;
use App\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KoleksiController extends Controller
{

    public function index(){
         $create = Koleksi::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $create
        ], 200);

    return response()->json($out, 200);
    // return response()->json(Jurnal::find($id));

    }

    // //create data yang sudah ada
    // public function dikoleksi(Request $request,$id){  
    //     $koleksi =([
    //         'id_user'=>$id,
    //         'id_rak'=>$request->$id_rak,
    //     ]);
    //     $iduser->update($koleksi);
    //     $dikoleksi = new Koleksi;
    //     $dikoleksi->judul = $request->judul;
    //     $dikoleksi->pengarang = $request->pengarang;
    //     $dikoleksi->tahun_terbit = $request->tahun_terbit;
    //     $dikoleksi->urlimages = $request->urlimages;
    //     $dikoleksi->urlpdf = $request->urlpdf;

    //     $dikoleksi->id_user=$iduser->id_rak;
    //     $dikoleksi->save();

    //     return response()->json($dikoleksi);
    // }


    public function showOneKoleksi($id)
    {
        return response()->json(Koleksi::find($id));
    }

    public function get($id){
        $data = Koleksi::where('id_user',$id)->get();
        foreach($data as $datas){
            $array[]=[
                "id_rak" => $datas->rak->id ?? 'null',
                "id"=>$datas->id ?? 'null',
                "judul"=>$datas->rak->judul ?? 'null',
                "pengarang"=>$datas->rak->pengarang ?? 'null',
                "tahun_terbit"=>$datas->rak->tahun_terbit ?? 'null',
                "urlimages"=>$datas->rak->urlimages ?? 'null',
                "urlpdf"=>$datas->rak->urlpdf ?? 'null',
            ];
        }
        return response()->json($array);
    }

    public function create(Request $request){
        $koleksi =[
            'id_user'=>$request->input('id_user'),
            'id_rak'=>$request->input('id_rak'),

        ];
        if(Koleksi::create($koleksi)){
            return ('Berhasil');

        }

      
    }

    public function update($id, Request $request)
    {
        $koleksi = Koleksi::findOrFail($id);
        $koleksi->update($request->all());

        return response()->json($koleksi, 200);
    }

    public function delete($id)
    {
        Koleksi::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
<?php

namespace App\Http\Controllers;
use App\User;
use App\KoleksiB;
use App\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KoleksiBController extends Controller
{

    public function index(){
         $create = KoleksiB::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Buku',
            'data' => $create
        ], 200);

    return response()->json($out, 200);
    }

    // //create data yang sudah ada
    // public function dikoleksib(Request $request,$id){  
    //     $koleksib =([
    //         'id_user'=>$id,
    //         'id_rak'=>$request->$id,
    //     ]);
    //     // $iduser->update($koleksib);
    //     $dikoleksib = new KoleksiB;
    //     $dikoleksib->judul = $request->judul;
    //     $dikoleksib->pengarang = $request->pengarang;
    //     $dikoleksib->tahun_terbit = $request->tahun_terbit;
    //     $dikoleksib->urlimages = $request->urlimages;
    //     $dikoleksi->urlpdf = $request->urlpdf;

    //     $dikoleksib->id_user=$iduser->id;
    //     $dikoleksib->save();

    //     return response()->json($dikoleksi);
    // }

    public function showOneKoleksiB($id)
    {
        return response()->json(KoleksiB::find($id));
    }

    public function get($id){
        $data = KoleksiB::where('id_user',$id)->get();
        $array=[];
        foreach($data as $datas){
            $array[]=[
                "id"=>$datas->id ?? 'null',
                "id_rak" => $datas->rak->id ?? 'null',
                "judul"=>$datas->rak->judul ?? 'null',
                "pengarang"=>$datas->rak->pengarang ?? 'null',
                "tahun_terbit"=>$datas->rak->tahun_terbit ?? 'null',
                "urlimages"=>$datas->rak->urlimages ?? 'null',
                "urlpdf"=>$datas->rak->urlpdf ?? 'null',
                "status_buku_jurnal"=>$datas->rak->status_buku_jurnal ?? 'null',
            ];
        }
        return response()->json($array);
    }

    public function create(Request $request){
        $koleksib =[
            'id_user'=>$request->input('id_user'),
            'id_rak'=>$request->input('id_rak'),

        ];
        if(KoleksiB::create($koleksib)){
            return ('Berhasil');

        }
    }

    public function update($id, Request $request)
    {
        $koleksib = KoleksiB::findOrFail($id);
        $koleksib->update($request->all());

        return response()->json($koleksib, 200);
    }

    public function delete($id)
    {
        KoleksiB::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\User;
use App\Pengembalian;
use App\Pinjam;
use App\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KembalianController extends Controller
{

    public function index(){
         $create = Pengembalian::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $create
        ], 200);

    return response()->json($out, 200);
    // return response()->json(Jurnal::find($id));

    }

    // // create data yang sudah ada
    // public function pengembalian(Request $request,$id){  
    //     $pengembalian =([
    //         'id_user'=>$id,
    //         'id_rak'=>$request->$id_rak,

    //     ]);
    //     $iduser->update($pengembalian);
        
    //     $pengembalian = new Pengembalian;
    //     $pengembalian->judul = $request->judul;
    //     $pengembalian->pengarang = $request->pengarang;
    //     $pengembalian->tahun_terbit = $request->tahun_terbit;
    //     $pengembalian->urlimages = $request->urlimages;
    //     $dikoleksi->urlpdf = $request->urlpdf;
    //     $peminjaman->status_buku_jurnal = $request->status_buku_jurnal;
        
    //     //user
    //     $peminjaman->nama = $request->nama;
    //     $peminjaman->nim = $request->nim;
    //     $peminjaman->prodi = $request->prodi;
    //     $peminjaman->status = $request->status;

    //     $pengembalian->id_user=$iduser->id;
    //     $pengembalian->save();

    //     return response()->json($pengembalian);
    // }


    public function showOnePinjam($id)
    {
        return response()->json(Pengembalian::find($id));
    }

    public function get($id){
        $data = Pengembalian::where('id_user',$id)->get();
        $array=[];
        foreach($data as $datas){
            $array[]=[
                "id"=>$datas->id ?? 'null',
                "id_rak" => $datas->rak->id ?? 'null',
                "id_user" => $datas->user->id ?? 'null',
                "judul"=>$datas->rak->judul ?? 'null',
                "pengarang"=>$datas->rak->pengarang ?? 'null',
                "tahun_terbit"=>$datas->rak->tahun_terbit ?? 'null',
                "urlimages"=>$datas->rak->urlimages ?? 'null',
                "urlpdf"=>$datas->rak->urlpdf ?? 'null',
                "nama"=>$datas->user->nama ?? 'null',
                "nim"=>$datas->user->nim ?? 'null',
                "prodi"=>$datas->user->prodi ?? 'null',
                "status"=>$datas->user->status ?? 'null',
                "status_buku_jurnal"=>$datas->rak->status_buku_jurnal ?? 'null',
                "created_at"=>$datas->created_at,
                "updated_at"=>$datas->updated_at, 
            ];
        }
        return response()->json($array);
    }

    public function getsemuapengembalian(){
        $data = Pengembalian::all();
        $array=[];
        foreach($data as $datas){
            $array[]=[
                "id"=>$datas->id ?? 'null',
                "id_rak" => $datas->rak->id ?? 'null',
                "id_user" => $datas->user->id ?? 'null',
                "judul"=>$datas->rak->judul ?? 'null',
                "pengarang"=>$datas->rak->pengarang ?? 'null',
                "tahun_terbit"=>$datas->rak->tahun_terbit ?? 'null',
                "urlimages"=>$datas->rak->urlimages ?? 'null',
                "urlpdf"=>$datas->rak->urlpdf ?? 'null',
                "nama"=>$datas->user->nama ?? 'null',
                "nim"=>$datas->user->nim ?? 'null',
                "prodi"=>$datas->user->prodi ?? 'null',
                "status"=>$datas->user->status ?? 'null',
                "status_buku_jurnal"=>$datas->rak->status_buku_jurnal ?? 'null',
                "created_at"=>$datas->created_at,
                "updated_at"=>$datas->updated_at,
            ];
        }
        return response()->json($array);
    }

    public function create(Request $request){
        $pengembalian =[
            'id_user'=>$request->input('id_user'),
            'id_rak'=>$request->input('id_rak'),

        ];
        if(Pengembalian::create($pengembalian)){
            // delete data saat input pengembalian
            $status_delete_pinjam = Pinjam::where('id_rak',$request->input('id_rak'))->where('id_user',$request->input('id_user'))->first();
            $status_delete_pinjam->delete();
            
            $status_kembali = Rak::findOrFail($request->input('id_rak'));
            $status_kembali->update(["status_buku_jurnal"=>"tersedia"]);
            return ('Berhasil');
        }   
    }

    public function update($id, Request $request)
    {
        $jurnal = Pengembailan::findOrFail($id);
        $jurnal->update($request->all());

        return response()->json($jurnal, 200);
    }

    public function delete($id)
    {
        Pengembalian::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
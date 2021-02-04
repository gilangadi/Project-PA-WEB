<?php

namespace App\Http\Controllers;
use App\User;
use App\Pinjam;
use App\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PinjamController extends Controller
{

    public function index(){
         $create = Pinjam::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $create
        ], 200);

    return response()->json($out, 200);
    // return response()->json(Jurnal::find($id));
    }


    // //create data yang sudah ada
    // public function peminjaman(Request $request,$id){  
    //     $pinjam =([
    //         'id_user'=>$id,
    //         'id_rak'=>$request->$id_rak,
    //     ]);
    //     $iduser->update($pinjam);
    //     $peminjaman = new Pinjam;
    //     $peminjaman->judul = $request->judul;
    //     $peminjaman->pengarang = $request->pengarang;
    //     $peminjaman->tahun_terbit = $request->tahun_terbit;
    //     $peminjaman->urlimages = $request->urlimages;
    //     $peminjaman->status_buku_jurnal = $request->status_buku_jurnal;

    //     //user
    //     $peminjaman->nama = $request->nama;
    //     $peminjaman->nim = $request->nim;
    //     $peminjaman->prodi = $request->prodi;
    //     $peminjaman->status = $request->status;

    //     $peminjaman->id_user = $iduser->id;
    //     // $peminjaman->id_rak = $id_rak->id_rak;
    //     $peminjaman->save();

    //     return response()->json($peminjaman);
    // }

    // public function showOnePinjam($id)
    // {
    //     return response()->json(Pinjam::find($id));
    // }

    public function get($id){
        $data = Pinjam::where('id_user',$id)->get();
        $array=[];
        foreach($data as $datas){
            $array[]=[
                "id"=>$datas->id ?? 'null',
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

    //NAMPILKAN SEMUA DATA
    public function getsemuapinjam(){
        $data = Pinjam::all();
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
        $pinjam =[
            'id_user'=>$request->input('id_user'),
            'id_rak'=>$request->input('id_rak'),
        ];
        if(Pinjam::create($pinjam)){
            // update status pinjam
            $status_pinjam = Rak::findOrFail($request->input('id_rak'));
            $status_pinjam->update(["status_buku_jurnal"=>"dipinjam"]);
            return ('Berhasil');
        }    
    }

    public function delete($id)
    {
        Jurnal::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
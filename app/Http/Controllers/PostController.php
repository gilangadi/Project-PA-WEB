<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function indexdipinjam(){
        $create = Post::latest()->where('status_buku_jurnal','dipinjam')->get();
       return response([
           'success' => true,
           'message' => 'List Semua Jurnal',
           'data' => $create
       ], 200);

   return response()->json($out, 200);
   }

   public function indextersedia(){
    $create =Post::latest()->where('status_buku_jurnal','tersedia')->get();
   return response([
       'success' => true,
       'message' => 'List Semua Jurnal',
       'data' => $create
   ], 200);

return response()->json($out, 200);
}

//
    public function indexjurnal(){
         $create = Post::latest()->where('status','jurnal')->get();
        return response([
            'success' => true,
            'message' => 'List Semua Jurnal',
            'data' => $create
        ], 200);

    return response()->json($out, 200);
    }

    public function indexbuku(){
        $create = Post::latest()->where('status','buku')->get();
       return response([
           'success' => true,
           'message' => 'List Semua Buku',
           'data' => $create
       ], 200);

   return response()->json($out, 200);
   }

    public function showAllJurnal()
    {        
        return response()->json(Post::all());
    }

    public function showOneJurnal($id)
    {
        return response()->json(Post::find($id));
    }

    public function get(){
        $data = Post::get();
        return response()->json($data);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'judul'   => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'status' => 'required',
            'status_buku_jurnal' => 'required',
            // 'urlimages' => 'required|urlimages',
            // 'urlpdf' => 'required|urlpdf',

        ]);

        // if($request-> file('urlimages','urlpdf')){

            // $name = time().$request->file ('urlimages')-> getClientOriginalName();
            // $nameurl = time().$request->file ('urlpdf')-> getClientOriginalName();

            // $request ->file('urlimages')->move('uploads',$name);
            // $request ->file('urlpdf')->move('pdf',$nameurl);
            // $judul = $request->judul;
            // $pengarang = $request->pengarang;
            // $tahun_terbit = $request->tahun_terbit;
            // $status_buku_jurnal = $request->status_buku_jurnal;
            // // $urlimages = url('uploads','$name');
            // // $urlpdf = url('pdf','$nameurl');
            // $status = $request->status;
        }
        // else{
            // $judul = $request->judul;
            // $pengarang = $request->pengarang;
            // $tahun_terbit = $request->tahun_terbit;
            // $status_buku_jurnal = $request->status_buku_jurnal;
            // // $urlimages = 'defauld.png';
            // // $urlpdf = 'defauld.pdf';
            // $status = $request->$status;
        }

        $create = Post::create([
            'judul' => $judul,
            'pengarang' => $pengarang,
            'tahun_terbit' => $tahun_terbit,
            'status_buku_jurnal' => $status_buku_jurnal,
            // 'urlimages' => $name,
            // 'urlpdf' => $nameurl,
            'status' => $status,
        ]);
        
        if ($create){
            return response()->json([
                'status' => "berhasil tambah data",
                'data' => $create
            ]);
        }else{
            return response()->json([
                'status' => "gagal tambah data",
                'data' => null
            ]);
        }
    // }

    // public function update($id, Request $request)
    // {
    //     $id = Rak::findOrFail($id);
    //     $id->update($request->all());
    //     return response()->json($id, 200);
    // }

    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'judul' => 'required',
    //         'pengarang' => 'required',
    //         'tahun_terbit' => 'required',
    //         'urlimages' => 'required',
    //         'urlpdf' => 'required',
    //         'status' => 'required',
    //         'status_buku_jurnal' => 'required',
    //     ]);

    //     $judul = $request->judul;
    //     $pengarang = $request->pengarang;
    //     $tahun_terbit = $request->tahun_terbit;
    //     $urlimages = $request->urlimages;
    //     $urlpdf = $request->urlpdf;
    //     $status = $request->status;
    //     $status_buku_jurnal = $request->status_buku_jurnal;

    //     $rak = Rak::find($id);

    //     $add = $rak->update ([
    //         'judul' => $judul,
    //         'pengarang' => $pengarang,
    //         'tahun_terbit' => $tahun_terbit,
    //         'urlimages' => $urlimages,
    //         'urlpdf' => $urlpdf,
    //         'status' => $status,
    //         'status_buku_jurnal' => $status_buku_jurnal,
    //     ]);

    //     if ($add){
    //         return response()->json([
    //             'status' => "Bserhasil ubah data",
    //             'data' => $add
    //         ]);
    //     }else{
    //         return response()->json([
    //             'status' => "Gagal ubah data",
    //             'data' => null
    //         ]);
    //     }

    // }

    // public function delete($id)
    // {
    //     Rak::findOrFail($id)->delete();
    //     return response('Deleted Successfully',200);
    // }
  
// }
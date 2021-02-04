<?php

namespace App\Http\Controllers;
use App\Pengguna;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function register(Request $request)
    {
        $hasher = app('hash');
        $username = $request->input('username');
        $nim = $request->input('nim');
        $password = $hasher->make($request->input('password'));

        $register = pengguna::create([
            'username' => $username,
            'nim' => $nim,
            'password' => $password,
        ]);
        if($register){
            $res["seccess"] = true;
            $res["result"] = 'Success Register';

            return response($res);
        }else{
            $res["gagal"] = false;
            $res["gagal"] = 'Gagal Register';

            return response($res);
        }
    }

    //
}

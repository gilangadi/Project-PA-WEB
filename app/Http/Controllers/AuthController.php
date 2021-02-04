<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function indexuser(Request $request){
        $create = User::latest()->where('status','user')->get();
       return response([
           'success' => true,
           'message' => 'List Semua User',
           'data' => $create
       ], 200);

   return response()->json($out, 200);
   }

public function register(Request $request)
    {
        $hasher = app('hash');
        $nama = $request->input('nama');
        $nim = $request->input('nim');
        $prodi = $request->input('prodi');
        $status = $request->input('status');

        $password = $hasher->make($request->input('password'));

        $register = User::create([
            'nama' => $nama,
            'nim' => $nim,
            'prodi' => $prodi,
            'password' => $password,
            'status' => $status,

        ]);
        if($register){
            $res["seccess"] = true;
            $res["result"] = 'Register Berhasil!';
            $res['data'] = $register;

            return response($res);
        }else{
            $res["success"] = false;
            $res["result"] = 'Gagal Register';

            return response($res);
        }
    }


public function login(Request $request)
{

//     $nim=$request->input('nim');
//     $password=$request->input('password');
//     $logins= User::where('nim', $nim)->orWhere('nim', $nim)->first();
    
//     if(Hash::check($password,$logins->password)){
  
//         $result["success"] = "1";
//         $result["message"] = "Login Berhasil";

//         //untuk memanggil data sesi Login
//         $result["id"] = $logins->id;
//         $result["nama"] = $logins->nama;
//         $result["nim"] = $logins->nim;
//         $result["prodi"] = $logins->prodi;
//         $result["password"] = $logins->password;
//         $result["status"] = $logins->status;

//       return response()->json($result);
//     }else{

//        $result["success"] = "0";
//        $result["message"] = "error";
//        return response()->json($result);
//    }

    $hashar = app()->make('hash');
    $nim = $request->input('nim');
    $password = $request->input('password');
    $status = $request->input('status');
    // $status = $request->status;
 
    // $user = User::where('nim',$nim)>orWhere('nim', $nim)->first();
    $user = User::where('nim',$nim)->first();
    if(!$user){
        $res['success'] = false;
        $res['massage'] = 'nim salah';
        return response($res);

    }else{
        if($hashar->check($password, $user->password)){
            $api_token = sha1(time());
            $create_token = User::where('id', $user->id)->update(['api_token' =>$api_token]);
            if($create_token){
                $res['success'] = true;
                $res['api_token'] = $api_token;
                $res['loginberhasil'] = 'login berhasil';
                $res['massage'] = $user;
                 return response($res);
            }
        }else{
            $res['success'] = false;
        $res['massage'] = 'password salah';
        return response($res);
        }

    }
}

public function getUser($id)
{
    $user = User::where('id', $id)->first();

    $array[]=[
        'id' => $user->id,
        'nama' => $user->nama,
        'nim' => $user->nim,
        'prodi' => $user->prodi,
        'status' => $user->status
    ]; 

    return response()->json($array);
    if($user){
        $res['success'] = true;
        $res['result'] = $user;
        return response($res);
    }else{
        $res['success'] = true;
        $res['result'] = 'Connot Find User!';
        return response($res);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistController extends Controller
{
    public function index()
    {
    	return view('register');
    }

    public function regist_save(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $pass = bcrypt($request->input('password'));
        $rules = [
            'name' => 'required|filled|max:50',
            'email' => 'required|email|filled|max:60',
            'password' => 'required|filled|min:8|max:50',
        ];
        $this->validate($request, $rules);

        $check = \App\User::where('email',$email)->first();

        if(empty($check)){
            \App\User::create([
                'name' => $name,
                'email' => $email,
                'password' => $pass,
            ]);

            return redirect()->action('Auth\LoginController@index')->with('success','Anda berhasil membuat akun baru');
        }else{
            return redirect()->action('Auth\LoginController@index')->with('error','Anda sudah terdaftar!');
        }
    }

    public function admregist()
    {
    	return view('admregister');
    }

    public function admregist_save(Request $request)
    {
    	
    	$rules = [
    		'name' => 'required|filled|max:50',
    		'email' => 'required|email|filled|max:60',
    		'password' => 'required|filled|min:8|max:50',
    	];
    	$this->validate($request, $rules);

    	$nama = $request->input('name');
    	$email = $request->input('email');
    	$password = bcrypt($request->input('password'));

    	$check = \App\Admin::where('is_admin',1)->first();

    	if(empty($check)){
    		\App\Admin::create([
    			'name' => $nama,
    			'email' => $email,
    			'password' => $password,
    			'is_admin' => 1,
    		]);

    		return redirect()->action('Auth\LoginController@index')->with('success','Berhasil');
    	}else{
    		return redirect()->action('Auth\LoginController@index')->with('error','Kekeliruan');
    	}
    }
}

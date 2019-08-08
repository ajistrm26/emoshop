<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data['result'] = \App\Barang::all();
    	return view('admin/index')->with($data);
    }

    public function merk()
    {
    	$data['result'] = \App\Merk::all();
    	return view('admin/merk/index')->with($data);
    }

    public function merk_add()
    {
    	return view('admin/merk/form');
    }

    public function merk_save(Request $request)
    {
    	$rules=[
    		'id_merk' => 'required|filled|min:4|max:4',
    		'nama_merk' => 'required|filled|max:150',
    	];

    	$this->validate($request, $rules);

    	\App\Merk::create([
    		'id_merk' => $request->input('id_merk'),
    		'nama_merk' => $request->input('nama_merk'),
    	]);

    	return redirect()->action('AdminController@merk')->with('success', 'Data merk berhasil ditambah');
    }

    public function merk_edit($id)
    {
    	$data['result'] = \App\Merk::where('id_merk',$id)->first();
    	return view('admin/merk/form')->with($data);
    }

    public function merk_update(Request $request, $id)
    {
    	$rules=[
    		'id_merk' => 'required|filled|min:4|max:4',
    		'nama_merk' => 'required|filled|max:150',
    	];

    	$this->validate($request, $rules);
    	$input = $request->all();
    	\App\Merk::where('id_merk',$id)->first()->update($input);

    	return redirect()->action('AdminController@merk')->with('success', 'Data merk berhasil diubah');
    }

    public function merk_destroy(Request $request, $id)
    {
    	$result = \App\Merk::where('id_merk', $id)->first()->delete();
    	return redirect()->action('AdminController@merk')->with('success','Data berhasil terhapus');
    }

    public function barang()
    {
    	$data['result'] = \App\Barang::all();
    	return view('admin/barang/index')->with($data);
    }

    public function barang_add()
    {
    	$check = \App\Merk::first();
    	if(empty($check)){
    		return redirect()->action('AdminController@merk')->with('error','Data merk kosong, perlu diisi terlebih dahulu');
    	}else{
    		return view('admin/barang/form');
    	}
    }

    public function barang_save(Request $request)
    {
    	$rules=[
    		'nama_barang' => 'required|filled|max:150',
    		'jumlah_barang' => 'required|filled|gte:0',
    		'harga' => 'required|filled|gte:0',
    		'id_merk' => 'required',
    	];

    	$this->validate($request, $rules);

    	$check = \App\Barang::where('id_barang','like','%'.$request->input('id_merk').'%')->orderBy('id_barang','desc')->first();
		$idm = $request->input('id_merk');

    	if(empty($check)){
    		$var = $idm.'0000';
    	}else{
    		$var = $check->id_barang;
    	}

    	$substr = substr($var,4);
    	$plusone = $substr+1;
    	$len = strlen($var)-strlen($plusone);
    	$id = substr($var,0,$len).$plusone;

    	\App\Barang::create([
    		'id_barang' => $id,
    		'nama_barang' => $request->input('nama_barang'),
    		'jumlah_barang' => $request->input('jumlah_barang'),
    		'harga' => $request->input('harga'),
    		'id_merk' => $request->input('id_merk'),
    	]);

    	return redirect()->action('AdminController@barang')->with('success', 'Data barang berhasil ditambah');
    }

    public function barang_edit($id)
    {
    	$data['result'] = \App\Barang::where('id_barang',$id)->first();
    	return view('admin/barang/form')->with($data);
    }

    public function barang_update(Request $request, $id)
    {
    	$rules=[
    		'nama_barang' => 'required|filled|max:150',
    		'jumlah_barang' => 'required|filled|gte:0',
    		'harga' => 'required|filled|gte:0',
    	];
    	$this->validate($request, $rules);

    	$input = $request->all();
    	\App\Barang::where('id_barang',$id)->first()->update($input);

    	return redirect()->action('AdminController@barang')->with('success', 'Data barang berhasil diubah');	
    }

    public function barang_destroy(Request $request, $id)
    {
    	$result = \App\Barang::where('id_barang', $id)->first()->delete();
    	return redirect()->action('AdminController@barang')->with('success','Data berhasil terhapus');
    }

    public function penjualan()
    {
        $data['result'] = \App\Jual::all();
        return view('admin/penjualan/index')->with($data);
    }

    public function penjualan_detail($id)
    {
        $jual = \App\Jual::where('id_jual',$id)->first();

        $data['result'] = \App\DJual::where('id_jual',$id)->get();

        return view('admin/penjualan/detail')->with($data)->with(compact('jual'));
    }

    public function cari(Request $request)
    {
        $nb = $request->input('cari');

        $data['result'] = \App\Barang::where('nama_barang','like','%'.$nb.'%')->get();

        return view('admin/barang/index')->with($data);    
    }
}

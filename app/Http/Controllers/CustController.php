<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class CustController extends Controller
{
    public function one()
    {
    	$data['result'] = \App\Barang::orderBy('harga','desc')->get();
    	return view('index')->with($data);
    }

    public function checkbuy()
    {
        return redirect()->action('Auth\LoginController@index')->with('error','Anda harus log in terlebih dahulu');
    }

    public function index()
    {
        $data['result'] = \App\Barang::orderBy('harga','desc')->get();
        return view('customer/index')->with($data);    
    }

    public function cart()
    {
        $check = \App\Cart::where('id_user',Auth::user()->id)->first();

        if(empty($check)){
            return redirect()->action('CustController@beli_form')->with('warning','Belum ada barang pada keranjang');
        }else{
            return redirect()->action('CustController@beli_form');
        }
    }

    public function beli_form()
    {
        $id = Auth::user()->id;

        $data['result'] = \App\Barang::all();
        $data2['result2'] = \App\Cart::where('id_user',$id)->get();

        return view('customer/form')->with($data)->with($data2);
    }

    public function beli_save(Request $request)
    {
        switch($request->input('submit')){
            case 'add';
                $rules = [
                    'pilih_barang' => 'required|filled',
                    'jumlah_beli' => 'required|filled|gt:0',
                ];

                $this->validate($request,$rules);

                $idb = $request->input('pilih_barang');
                $jb = $request->input('jumlah_beli');

                $barang = \App\Barang::where('id_barang',$idb)->first();

                $check = \App\Cart::where('id_barang',$idb)->where('id_user',Auth::user()->id)->first();

                if(empty($check)){
                    \App\Cart::create([
                        'id_barang' => $idb,
                        'jumlah_cart' => $jb,
                        'harga_cart' => $barang->harga*$jb,
                        'id_user' => Auth::user()->id,
                    ]);

                    return redirect()->action('CustController@beli_form')->with('success','Berhasil menambahkan keranjang');
                }else{
                    return redirect()->action('CustController@beli_form')->with('warning','Barang sudah ada pada keranjang');
                }
            break;

            case 'save';
            $check = \App\Cart::where('id_user',Auth::user()->id)->get();

            if($check->isEmpty()){
                return redirect()->action('CustController@beli_form')->with('warning','Belum ada barang pada keranjang');
            }else{
                $cart = \App\Cart::select(DB::raw('sum(harga_cart) as hc'))->where('id_user', Auth::user()->id)->first();

                $jual = \App\Jual::where('id_user', Auth::user()->id)->orderBy('tgl_jual','desc')->first();

                if(empty($jual)){
                    $var = 'J'.date('Ydm').'000000';
                }else{
                    $var = $jual->id_jual;
                }

                $substr = substr($var,8);
                $plusone = $substr+1;
                $len = strlen($var)-strlen($plusone);
                $id = substr($var,0,$len).$plusone;

                \App\Jual::create([
                    'id_jual' => $id,
                    'tgl_jual' => date('Y-m-d H:i:s'),
                    'harga_total' => $cart->hc,
                    'id_user' => Auth::user()->id,
                ]);

                $allcart = \App\Cart::where('id_user',Auth::user()->id)->get();

                foreach($allcart as $row){
                    \App\DJual::create([
                        'id_jual' => $id,
                        'id_barang' => $row->id_barang,
                        'jumlah_jual' => $row->jumlah_cart,
                        'harga_jual' => $row->harga_cart,
                    ]);

                    $barang = \App\Barang::where('id_barang',$row->id_barang)->first();

                    $jb = $barang->jumlah_barang - $row->jumlah_cart;

                    $barang->update([
                        'jumlah_barang' => $jb,
                    ]);
                }

                \App\Cart::where('id_user',Auth::user()->id)->delete();

                return redirect()->action('CustController@index')->with('success','Pesanan '.$id.' Berhasil Dibuat');
            }
            break;
        }
    }

    public function beli_destroy($id)
    {
        $result = \App\Cart::where('id_cart', $id)->first()->delete();
        return redirect()->action('CustController@beli_form')->with('success','Data pada keranjang berhasil terhapus');
    }

    public function pembelian()
    {
        $check = \App\Jual::where('id_user',Auth::user()->id)->first();

        if(empty($check)){
            return redirect()->action('CustController@index')->with('warning','Belum ada pembelian');
        }else{
            $data['result'] = \App\Jual::where('id_user',Auth::user()->id)->get();
            return view('customer/pembelian/index')->with($data);
        }
    }

    public function detail_pembelian($id)
    {
        $beli = \App\Jual::where('id_jual',$id)->first();

        $data['result'] = \App\DJual::where('id_jual',$id)->get();

        return view('customer/pembelian/detail')->with($data)->with(compact('beli'));
    }

    public function cari(Request $request)
    {
        $nb = $request->input('cari');

        $data['result'] = \App\Barang::where('nama_barang','like','%'.$nb.'%')->get();

        return view('customer/index')->with($data);    
    }
}

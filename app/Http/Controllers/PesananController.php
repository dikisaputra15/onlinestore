<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Detailpesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function index(Request $request)
    {
    	$id = auth()->user()->id;
    	$pesanans = Pesanan::where('id_user', $id) 
				    ->orderBy('created_at', 'desc')
				    ->take(20)
				    ->get();
    	 return view('pages.pesanan.index', compact('pesanans'));
    }

    public function checkout()
    {

    	$id = auth()->user()->id;
    	$keranjangs = DB::table('keranjangs')
    	->join('produks', 'produks.id', '=', 'keranjangs.id_produk')
    	->select('keranjangs.*', 'produks.nama_produk')
    	->where('keranjangs.id_user', $id)
    	->orderBy('keranjangs.id', 'desc')->get();

    	$total = DB::table('keranjangs')
    	->where('keranjangs.id_user', $id)
    	->sum('sub_total');
    	return view('pages.pesanan.checkout', compact('keranjangs','total'));
    }

    public function storepesanan(Request $request)
    {
    	$tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        $id_user = auth()->user()->id;

        $pesan = Pesanan::create([
            'id_user' => $id_user,
            'tgl_pemesanan' => $tgl_now,
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat_lengkap,
            'total_bayar' => $request->total_bayar,
            'status' => 'Unpaid',
            'keterangan' => 'diproses'
        ]);

        if($pesan){
        	$last_id = Pesanan::latest()->first();
            $pesan_id = $last_id->id;
            $keranjangs = DB::table('keranjangs')
                        ->where('id_user', $id_user)
                        ->get();
            foreach ($keranjangs as $keranjang) {
                Detailpesanan::create([
                    'id_pesanan' => $pesan_id,
                    'id_user' => $id_user,
                    'id_produk' => $keranjang->id_produk,
                    'qty' => $keranjang->qty,
                    'harga_bayar' => $keranjang->harga,
                    'sub_total' => $keranjang->sub_total
                ]);

                DB::table('produks')
			    ->where('id', $keranjang->id_produk)
			    ->decrement('stok', $keranjang->qty);
            }

            DB::table('keranjangs')->where('id_user',$id_user)->delete();

        }

         return redirect("/pesanan");

    }

    public function lihatinvoice($id)
    {
    	
    	$pesanan = \App\Models\Pesanan::findOrFail($id);
    	
    	$details = DB::table('detailpesanans')
		    	->join('produks', 'produks.id', '=', 'detailpesanans.id_produk')
		    	->select('detailpesanans.*', 'produks.nama_produk', 'produks.path_gambar')
		    	->where('detailpesanans.id_pesanan', $id)
		    	->orderBy('detailpesanans.id', 'desc')->get();
    	return view('pages.pesanan.invoice', compact('pesanan','details'));
    }

    public function bayar($id)
    {
    	$id = auth()->user()->id;
    	$pesanan = \App\Models\Pesanan::findOrFail($id);
    	$details = DB::table('detailpesanans')
		    	->join('produks', 'produks.id', '=', 'detailpesanans.id_produk')
		    	->select('detailpesanans.*', 'produks.nama_produk', 'produks.path_gambar')
		    	->where('detailpesanans.id_user', $id)
		    	->orderBy('detailpesanans.id', 'desc')->get();


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $pesanan->id,
                'gross_amount' => $pesanan->total_bayar,
            ),
            'customer_details' => array(
                'name' => $pesanan->nama_penerima,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

    	return view('pages.pesanan.bayar', compact('snapToken','pesanan','details'));
    }

     public function formpo($id)
    {
    	$produk = \App\Models\Produk::findOrFail($id);
    	return view('pages.pesanan.formpo', compact('produk'));
    }

     public function storepo(Request $request)
    {
    	$tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        $id_user = auth()->user()->id;
        $total_bayar = $request->harga * $request->qty;
        $id_produk = $request->id_produk;

        $pesan = Pesanan::create([
            'id_user' => $id_user,
            'tgl_pemesanan' => $tgl_now,
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat_lengkap,
            'total_bayar' => $total_bayar,
            'status' => 'Unpaid',
            'keterangan' => 'po'
        ]);

        if($pesan){
        	$last_id = Pesanan::latest()->first();
            $pesan_id = $last_id->id;
           
                Detailpesanan::create([
                    'id_pesanan' => $pesan_id,
                    'id_user' => $id_user,
                    'id_produk' => $id_produk,
                    'qty' => $request->qty,
                    'harga_bayar' => $request->harga,
                    'sub_total' => $total_bayar
                ]);

        }
        return redirect("/pesanan");
    }
}

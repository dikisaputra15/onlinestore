<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    	$produks = Produk::orderBy('created_at', 'desc')->take(3)->get();
    	$items = Produk::orderBy('id', 'desc')->get();
        return view('pages.front.index', compact('produks','items'));
    }

     public function contact()
    {
    	return view('pages.front.contact');
    }

    public function dashboard()
    {
        $pesananmasuk = Pesanan::where('status', 'Paid')->where('keterangan', 'diproses')->count();
        $pomasuk = Pesanan::where('status', 'Paid')->where('keterangan', 'po')->count();
        return view('pages.dashboard', compact('pesananmasuk','pomasuk'));
    }

    public function admintransaksi()
    {
         $pesanans = DB::table('pesanans')
            ->when($request->input('name'), function($query, $name){
                return $query->where('nama_penerima', 'like', '%'.$name.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.pesanan.transaksi', compact('pesanans'));
    }
}

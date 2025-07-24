<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{

	public function index(Request $request)
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
        return view('pages.front.allkeranjang', compact('keranjangs','total'));
    }

    public function storekeranjang(Request $request)
    {
        $id_user = auth()->user()->id;
        $subtotal = $request->harga * $request->qty;

        Keranjang::create([
            'id_user' => $id_user,
            'id_produk' => $request->id_produk,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'sub_total' => $subtotal 
        ]);

        return redirect("/");

    }

    public function storekeranjangnew(Request $request)
    {
        $id_user = auth()->user()->id;
        $subtotal = $request->harga * $request->qty;

        Keranjang::create([
            'id_user' => $id_user,
            'id_produk' => $request->id_produk,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'sub_total' => $subtotal
        ]);

        return redirect("/");

    }


    public function destroykeranjang($id)
    {
        DB::table('keranjangs')->where('id',$id)->delete();
        return redirect("/allkeranjang");
    }
}

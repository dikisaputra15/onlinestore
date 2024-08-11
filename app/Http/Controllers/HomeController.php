<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

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

    public function owner()
    {
        return view('pages.owner');
    }

    public function admintransaksi(Request $request)
    {
         $pesanans = DB::table('pesanans')
            ->when($request->input('name'), function($query, $name){
                return $query->where('nama_penerima', 'like', '%'.$name.'%');
            })
            ->where('status', 'Paid')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.pesanan.transaksi', compact('pesanans'));
    }

    public function adminpengiriman(Request $request)
    {
         $pesanans = DB::table('pesanans')
            ->when($request->input('name'), function($query, $name){
                return $query->where('nama_penerima', 'like', '%'.$name.'%');
            })
            ->where('keterangan', 'dikirim')
            ->orWhere('keterangan', 'diterima')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.pesanan.pengiriman', compact('pesanans'));
    }

    public function formlappenjualan()
    {
        $kategoris = DB::table('kategoris')->get();
        return view('pages.pesanan.formlappenjualan', compact('kategoris'));
    }

    public function formlappenjualanowner()
    {
        $kategoris = DB::table('kategoris')->get();
        return view('pages.pesanan.formlappenjualanowner', compact('kategoris'));
    }

    public function lihatpdf(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $kategori = $request->kategori;

        if($kategori == 0){
            $pesanans = DB::table('detailpesanans')
                ->join('pesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                ->join('produks', 'produks.id', '=', 'detailpesanans.id_produk')
                ->join('users', 'users.id', '=', 'detailpesanans.id_user')
                ->select('detailpesanans.*', 'pesanans.*', 'produks.nama_produk', 'users.name')
                ->whereBetween('pesanans.tgl_pemesanan', [$start_date, $end_date])
                ->where('pesanans.status', 'Paid')
                ->get();
            $total = DB::table('detailpesanans')
                ->join('pesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                ->join('produks', 'produks.id', '=', 'detailpesanans.id_produk')
                ->join('users', 'users.id', '=', 'detailpesanans.id_user')
                ->select('detailpesanans.*', 'pesanans.*', 'produks.nama_produk', 'users.name')
                ->whereBetween('pesanans.tgl_pemesanan', [$start_date, $end_date])
                ->where('pesanans.status', 'Paid')
                ->sum('pesanans.total_bayar');
        }else{
            $pesanans = DB::table('detailpesanans')
                ->join('pesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                ->join('users', 'users.id', '=', 'detailpesanans.id_user')
                ->join('produks', 'produks.id', '=', 'detailpesanans.id_produk')
                ->join('kategoris', 'kategoris.id', '=', 'produks.id_kategori')
                ->select('detailpesanans.*', 'pesanans.*', 'produks.nama_produk', 'produks.id_kategori', 'users.name')
                ->whereBetween('pesanans.tgl_pemesanan', [$start_date, $end_date])
                ->where('pesanans.status', 'Paid')
                ->where('produks.id_kategori', $kategori)
                ->get();
            $total = DB::table('detailpesanans')
                ->join('pesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                ->join('users', 'users.id', '=', 'detailpesanans.id_user')
                ->join('produks', 'produks.id', '=', 'detailpesanans.id_produk')
                ->join('kategoris', 'kategoris.id', '=', 'produks.id_kategori')
                ->select('detailpesanans.*', 'pesanans.*', 'produks.nama_produk', 'produks.id_kategori', 'users.name')
                ->whereBetween('pesanans.tgl_pemesanan', [$start_date, $end_date])
                ->where('pesanans.status', 'Paid')
                ->where('produks.id_kategori', $kategori)
                ->sum('pesanans.total_bayar');
        }

        $pdf = PDF::loadView('lappenjualanpdf', compact('pesanans','total'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('lappenjualanpdf.pdf');
    }

    public function pesananmasuk(Request $request)
    {
        $pesananmasuks = DB::table('pesanans')
            ->when($request->input('name'), function($query, $name){
                return $query->where('nama_penerima', 'like', '%'.$name.'%');
            })
            ->where('status', 'Paid')
            ->where('keterangan', 'diproses')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.pesanan.pesananmasuk', compact('pesananmasuks'));
    }

    public function pomasuk(Request $request)
    {
        $pomasuks = DB::table('pesanans')
            ->when($request->input('name'), function($query, $name){
                return $query->where('nama_penerima', 'like', '%'.$name.'%');
            })
            ->where('status', 'Paid')
            ->where('keterangan', 'po')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.pesanan.pomasuk', compact('pomasuks'));
    }

    public function updatepesananmasuk($id)
    {
         DB::table('pesanans')->where('id',$id)->update([
            'keterangan' => 'dikirim'
        ]);

        return redirect("/pesananmasuk")->with('success', 'Status Pesanan Update');
    }

     public function updatepomasuk($id)
    {
         DB::table('pesanans')->where('id',$id)->update([
            'keterangan' => 'dikirim'
        ]);

        return redirect("/pomasuk")->with('success', 'Status Pesanan Update');
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement'){
                $order = Pesanan::find($request->order_id);
                $order->update(['status' => 'Paid']);
            }
        }
    }

    public function updatekonfirmasi($id)
    {
         DB::table('pesanans')->where('id',$id)->update([
            'keterangan' => 'diterima'
        ]);

        return redirect("/pesanan")->with('success', 'Status Pesanan Update');
    }
}

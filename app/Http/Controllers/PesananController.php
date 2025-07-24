<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teknisi;
use App\Models\Orderteknisi;
use App\Models\Pembayaran;
use App\Models\Trackingorder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class PesananController extends Controller
{
     public function pesan($id)
    {
         $teknisi = \App\Models\Teknisi::findOrFail($id);
         $jenis = DB::table('jeniskerusakans')->orderBy('id', 'desc')->get();
         $tarif = DB::table('tarifs')->orderBy('id', 'desc')->get();
         return view('pages.pesanan.pesan', compact('teknisi','jenis','tarif'));
    }

     public function prosespesan(Request $request)
    {
         $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');

         Orderteknisi::create([
            'teknisi_id' => $request->teknisi_id,
            'user_id' => auth()->user()->id,
            'tarif_id' => $request->tarif_id,
            'jenis_kerusakan_id' => $request->jenis_kerusakan_id,
            'tgl_order' => $tgl_now,
            'nama_pelanggan' => $request->nama_pemesan,
            'alamat_pelanggan' => $request->alamat,
            'pelanggan_latitude' => $request->pelanggan_latitude,
            'pelanggan_longitude' => $request->pelanggan_longitude,
            'no_hp' => $request->no_hp,
            'deskripsi' => $request->deskripsi,
            'total_biaya' => $request->total_biaya,
            'status_order' => 'unpaid',
        ]);

         return redirect('myorder')->with('alert-primary','Data Berhasil dikirim');
    }

    public function formbayar($id)
    {
         $order = \App\Models\Orderteknisi::findOrFail($id);
          return view('pages.pesanan.formbayar', compact('order'));
    }

     public function prosesbayar(Request $request)
    {   $orderid = $request->order_id;
        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        $pay_id = 'ORDER-' . time();
         if($request->metode_pembayaran == 'Cash'){
               $bayar =  Pembayaran::create([
                    'order_id' => $orderid,
                    'pay_id' => $pay_id,
                    'tgl_pembayaran' => $tgl_now,
                    'total_bayar' => $request->total_bayar,
                    'status' => 'paid',
                    'snap_token' => NULL,
                    'metode_pembayaran' => $request->metode_pembayaran,
                 ]);

                 if($bayar){
                    DB::table('orderteknisis')
                        ->where('id', $orderid)
                        ->update(['status_order' => 'paid']);

                     Trackingorder::create([
                        'order_teknisi_id' => $orderid,
                        'status' => 'menunggu teknisi',
                    ]);
                 }
         }else{
            echo "qris";
         }

         return redirect('myorder')->with('alert-primary','Data Berhasil dikirim');
    }

     public function pesananmasuk(Request $request)
    {
        $data = DB::table('orderteknisis')
            ->join('trackingorders', 'trackingorders.order_teknisi_id', '=', 'orderteknisis.id')
            ->join('teknisis', 'teknisis.id', '=', 'orderteknisis.teknisi_id')
            ->join('users', 'users.id', '=', 'orderteknisis.user_id')
            ->join('jeniskerusakans', 'jeniskerusakans.id', '=', 'orderteknisis.jenis_kerusakan_id')
            ->join('tarifs', 'tarifs.id', '=', 'orderteknisis.tarif_id')
            ->select('trackingorders.id','orderteknisis.nama_pelanggan', 'orderteknisis.alamat_pelanggan', 'orderteknisis.total_biaya', 'teknisis.name', 'tarifs.nama_jasa', 'tarifs.tarif_antar', 'jeniskerusakans.jenis_kerusakan', 'jeniskerusakans.biaya', 'trackingorders.status')
            ->get();

         return view('pages.pesanan.pesananmasuk', compact('data'));
    }

     public function formupdatestatus($id)
    {
         $order = \App\Models\Trackingorder::findOrFail($id);
          return view('pages.pesanan.formupdatestatus', compact('order'));
    }

     public function prosesstatus(Request $request)
    {
         DB::table('trackingorders')
                        ->where('id', $request->id_track)
                        ->update(['status' => $request->status]);
         return redirect('pesananmasuk')->with('alert-primary','Data Berhasil dikirim');
    }

     public function dataservice(Request $request)
    {
        $data = DB::table('orderteknisis')
            ->join('trackingorders', 'trackingorders.order_teknisi_id', '=', 'orderteknisis.id')
            ->join('teknisis', 'teknisis.id', '=', 'orderteknisis.teknisi_id')
            ->join('users', 'users.id', '=', 'orderteknisis.user_id')
            ->join('jeniskerusakans', 'jeniskerusakans.id', '=', 'orderteknisis.jenis_kerusakan_id')
            ->join('tarifs', 'tarifs.id', '=', 'orderteknisis.tarif_id')
            ->select('trackingorders.id','orderteknisis.nama_pelanggan', 'orderteknisis.alamat_pelanggan', 'orderteknisis.total_biaya', 'teknisis.name', 'tarifs.nama_jasa', 'tarifs.tarif_antar', 'jeniskerusakans.jenis_kerusakan', 'jeniskerusakans.biaya', 'trackingorders.status')
            ->where('trackingorders.status', 'selesai')
            ->get();

         return view('pages.pesanan.dataservice', compact('data'));
    }

     public function invoice($id)
    {
        $dat = DB::table('orderteknisis')
            ->join('trackingorders', 'trackingorders.order_teknisi_id', '=', 'orderteknisis.id')
            ->join('teknisis', 'teknisis.id', '=', 'orderteknisis.teknisi_id')
            ->join('users', 'users.id', '=', 'orderteknisis.user_id')
            ->join('jeniskerusakans', 'jeniskerusakans.id', '=', 'orderteknisis.jenis_kerusakan_id')
            ->join('tarifs', 'tarifs.id', '=', 'orderteknisis.tarif_id')
            ->select('trackingorders.id','orderteknisis.nama_pelanggan', 'orderteknisis.alamat_pelanggan', 'orderteknisis.total_biaya', 'teknisis.name', 'tarifs.nama_jasa', 'tarifs.tarif_antar', 'jeniskerusakans.jenis_kerusakan', 'jeniskerusakans.biaya', 'trackingorders.status')
            ->where('trackingorders.id', $id)
            ->first();

        return view('pages.pesanan.invoice', compact('dat'));
    }

     public function formlapor(Request $request)
    {
          return view('pages.pesanan.formlapor');
    }

     public function lihatpdf(Request $request)
    {
         $start_date = $request->start_date;
        $end_date = $request->end_date;

         $pesanans = DB::table('orderteknisis')
            ->join('trackingorders', 'trackingorders.order_teknisi_id', '=', 'orderteknisis.id')
            ->join('teknisis', 'teknisis.id', '=', 'orderteknisis.teknisi_id')
            ->join('users', 'users.id', '=', 'orderteknisis.user_id')
            ->join('jeniskerusakans', 'jeniskerusakans.id', '=', 'orderteknisis.jenis_kerusakan_id')
            ->join('tarifs', 'tarifs.id', '=', 'orderteknisis.tarif_id')
            ->select('trackingorders.id', 'orderteknisis.tgl_order', 'orderteknisis.nama_pelanggan', 'orderteknisis.alamat_pelanggan', 'orderteknisis.total_biaya', 'orderteknisis.status_order', 'teknisis.name', 'tarifs.nama_jasa', 'tarifs.tarif_antar', 'jeniskerusakans.jenis_kerusakan', 'jeniskerusakans.biaya', 'trackingorders.status')
            ->where('orderteknisis.status_order', 'paid')
            ->whereBetween('orderteknisis.tgl_order', [$start_date, $end_date])
            ->get();

         $pdf = PDF::loadView('lappenjualanpdf', compact('pesanans'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('lappenjualanpdf.pdf');
    }
}

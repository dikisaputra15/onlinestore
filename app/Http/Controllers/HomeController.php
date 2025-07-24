<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use App\Models\Orderteknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.front.index');
    }

    public function dashboard()
    {
         $tempatservice = Teknisi::count();
         $paid = Orderteknisi::where('status_order', 'paid')->count();
         $unpaid = Orderteknisi::where('status_order', '!=', 'paid')->count();

        return view('pages.dashboard', compact('tempatservice','paid','unpaid'));
    }

    public function itservice(Request $request)
    {
         return view('pages.service.index');
    }

    public function tracking(Request $request)
    {
         $id = auth()->user()->id;

         $data = DB::table('orderteknisis')
            ->join('trackingorders', 'trackingorders.order_teknisi_id', '=', 'orderteknisis.id')
            ->join('teknisis', 'teknisis.id', '=', 'orderteknisis.teknisi_id')
            ->join('users', 'users.id', '=', 'orderteknisis.user_id')
            ->select('orderteknisis.*', 'teknisis.name', 'trackingorders.status')
            ->where('users.id', $id)
            ->get();

        return view('pages.tracking.index', compact('data'));
    }

    public function myorder(Request $request)
    {
        $id = auth()->user()->id;

         $data = DB::table('orderteknisis')
            ->join('teknisis', 'teknisis.id', '=', 'orderteknisis.teknisi_id')
            ->join('tarifs', 'tarifs.id', '=', 'orderteknisis.tarif_id')
            ->join('users', 'users.id', '=', 'orderteknisis.user_id')
            ->join('jeniskerusakans', 'jeniskerusakans.id', '=', 'orderteknisis.jenis_kerusakan_id')
            ->select('orderteknisis.*', 'teknisis.name', 'tarifs.nama_jasa', 'tarifs.tarif_antar', 'jeniskerusakans.jenis_kerusakan', 'jeniskerusakans.biaya')
            ->where('users.id', $id)
            ->get();

        return view('pages.pesanan.index', compact('data'));
    }

    public function getTeknisi(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;
        $radius = $request->radius ?? 10;

        if ($lat && $lng) {
            return DB::table('teknisis')
                ->select("*", DB::raw("ROUND(6371 * acos(
                    cos(radians($lat)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians($lng)) +
                    sin(radians($lat)) *
                    sin(radians(latitude))
                ), 2) AS distance"))
                ->having('distance', '<', $radius)
                ->orderBy('distance')
                ->get();
        }

        return Teknisi::all();
    }

     public function welcome()
    {
        return view('welcome');
    }

}

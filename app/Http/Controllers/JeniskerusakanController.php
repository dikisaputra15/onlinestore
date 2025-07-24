<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jeniskerusakan;

class JeniskerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = DB::table('jeniskerusakans')->orderBy('id', 'desc')->get();
        return view('pages.jenis.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         Jeniskerusakan::create([
            'jenis_kerusakan' => $request->jenis_kerusakan,
            'biaya' => $request->biaya,
        ]);

        return redirect()->route('jeniskerusakan.index')->with('alert-primary','Data Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jenis = \App\Models\Jeniskerusakan::findOrFail($id);
        return view('pages.jenis.edit', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jenis = Jeniskerusakan::findOrFail($id);

        // Update nilai dasar
        $jenis->jenis_kerusakan = $request->jenis_kerusakan;
        $jenis->biaya = $request->biaya;
         $jenis->save();

        return redirect()->route('jeniskerusakan.index')->with('alert-primary', 'Data lokasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         DB::table('jeniskerusakans')->where('id', $id)->delete();
        return redirect()->route('jeniskerusakan.index')->with('alert-danger','Data Berhasil dihapus');
    }
}

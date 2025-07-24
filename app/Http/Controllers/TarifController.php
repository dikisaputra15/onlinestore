<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tarif;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarif = DB::table('tarifs')->orderBy('id', 'desc')->get();
        return view('pages.tarif.index', compact('tarif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tarif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tarif::create([
            'tarif_antar' => $request->tarif,
        ]);

        return redirect()->route('tarif.index')->with('alert-primary','Data Berhasil ditambah');
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

        $tarif = \App\Models\Tarif::findOrFail($id);
        return view('pages.tarif.edit', compact('tarif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $tarif = Tarif::findOrFail($id);

        // Update nilai dasar
        $tarif->tarif_antar = $request->tarif;
         $tarif->save();

        return redirect()->route('tarif.index')->with('alert-primary', 'Data lokasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('tarifs')->where('id', $id)->delete();
        return redirect()->route('tarif.index')->with('alert-danger','Data Berhasil dihapus');
    }
}

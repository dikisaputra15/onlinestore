<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Teknisi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LokasiteknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = DB::table('teknisis')->orderBy('id', 'desc')->get();
        return view('pages.lokasi.index', compact('lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file1 = $request->file('image');
            $filename1 = uniqid() . '.' . $file1->getClientOriginalExtension();
            $filePath = $file1->storeAs('filefoto', $filename1, 'public');
        }else {
            return back()->with('error', 'File tidak ditemukan');
        }

        Teknisi::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $filePath,
        ]);

        return redirect()->route('lokasi.index')->with('alert-primary','Data Berhasil ditambah');
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
        $lokasi = \App\Models\Teknisi::findOrFail($id);
        return view('pages.lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lokasi = Teknisi::findOrFail($id);

        // Update nilai dasar
        $lokasi->name = $request->name;
        $lokasi->phone = $request->phone;
        $lokasi->alamat = $request->alamat;
        $lokasi->latitude = $request->latitude;
        $lokasi->longitude = $request->longitude;

        // Proses upload gambar jika ada file
        if ($request->hasFile('image')) {
            // Hapus gambar lama (jika ada)
            if ($lokasi->image && Storage::disk('public')->exists($lokasi->image)) {
                Storage::disk('public')->delete($lokasi->image);
            }

            $file = $request->file('image');
            $filename =  uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('filefoto', $filename, 'public');
            $lokasi->image = $filePath;
        }

        $lokasi->save();

        return redirect()->route('lokasi.index')->with('alert-primary', 'Data lokasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('teknisis')->where('id', $id)->delete();
        return redirect()->route('lokasi.index')->with('alert-danger','Data Berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        //$users = \App\Models\User::paginate(10);
        $kategoris = DB::table('kategoris')
            ->when($request->input('name'), function($query, $name){
                return $query->where('nama_kategori', 'like', '%'.$name.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('pages.kategoris.create');
    }

    public function store(Request $request)
    {
        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori successfully created');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori successfully deleted');
    }

    public function edit($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        return view('pages.kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        DB::table('kategoris')->where('id',$id)->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori successfully updated');
    }

}

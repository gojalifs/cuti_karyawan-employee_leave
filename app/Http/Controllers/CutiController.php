<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = Cuti::get();

        return view('pages.cuti.index', with(['cuti' => $cuti]));
    }

    public function store(Request $request)
    {
        $cuti = new Cuti();
        $cuti->nama_cuti = $request->name;
        $cuti->jumlah = $request->jumlah;
        $cuti->satuan = 'hari';

        $cuti->save();

        return redirect()->route('cuti.index')->with(['success' => 'Berhasil Menambah Master Cuti']);
    }

    public function editIndex($id)
    {
        $cuti = Cuti::find($id);

        return view('pages.cuti.edit', ['cuti' => $cuti]);

    }

    public function update(Request $request) {
        $cuti = Cuti::find($request->id);
        $cuti->nama_cuti = $request->name;
        $cuti->jumlah = $request->jumlah;
        $cuti->save();

        return redirect()->route('cuti.index')->with(['success'=> 'Berhasil Mengubah Data Cuti']);
    }
}

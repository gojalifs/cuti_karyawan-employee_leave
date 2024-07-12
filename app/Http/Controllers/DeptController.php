<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use Illuminate\Http\Request;

class DeptController extends Controller
{
    public function index()
    {
        $dept = Dept::get();

        return view('pages.dept.index', with(['dept' => $dept]));
    }

    public function store(Request $request)
    {
        $dept = new Dept();
        $dept->nama_dept = $request->name;

        $dept->save();

        return redirect()->route('dept.index')->with(['success' => 'Berhasil Menambah Master Dept']);
    }

    public function editIndex($id)
    {
        $dept = Dept::find($id);

        return view('pages.dept.edit', ['dept' => $dept]);

    }

    public function update(Request $request)
    {
        $dept = Dept::find($request->id);
        $dept->nama_dept = $request->name;
        $dept->save();

        return redirect()->route('dept.index')->with(['success' => 'Berhasil Mengubah Data Dept']);
    }
}

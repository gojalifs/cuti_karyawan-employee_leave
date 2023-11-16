<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use DB;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = DB::table('users')
            ->join('karyawan', 'users.id', '=', 'karyawan.user_id')
            ->select('users.name', 'users.email', 'karyawan.id', 'karyawan.alamat', 'karyawan.no_telpon', 'karyawan.jumlah_cuti')
            ->get();

        return view('pages.Karyawan.index', ['karyawan' => $karyawan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = DB::table('users')
            ->join('karyawan', 'users.id', '=', 'karyawan.user_id')
            ->select('users.name', 'users.email', 'karyawan.id', 'karyawan.alamat', 'karyawan.no_telpon', 'karyawan.jumlah_cuti')
            ->where('karyawan.id', $id)
            ->get();

        return view('pages.karyawan.FormEdit', ['karyawan' => $karyawan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

        DB::table('karyawan')
            ->where('id', $request->id)
            ->update([
                'user_id' => $request->id,
                'alamat' => $request->alamat,
                'no_telpon' => $request->no_telpon,
                'jumlah_cuti' => $request->jumlah_cuti
            ]);
        return redirect()->route('karyawan.index')->with(['success' => 'Data Karyawan Berhasil Diupdate!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

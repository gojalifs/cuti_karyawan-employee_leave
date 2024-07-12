<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use DB;


class KaryawanController extends Controller
{
    public function index()
    {
        // ->where('user_id', Auth::user()->id)
        $karyawan = DB::table('users')
            ->where('role', 'karyawan')
            ->join('dept', 'users.dept', '=', 'dept.id')
            ->get();

        $dept = Dept::get();

        return view('pages.karyawan.index', [
            'karyawan' => $karyawan,
            'dept' => $dept,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $status = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'dept' => 'required',
            'jumlah_cuti' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        if (!$status) {
            return back()->with('error', 'Error validate');
        }

        $user = new User();
        $user->name = $request->name;
        $user->dept = $request->dept;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->jumlah_cuti = $request->jumlah_cuti;
        $user->role = 'karyawan';
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('karyawan.index')->with(['success' => 'Berhasil Menambah Karyawan']);
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
     */
    public function edit($id)
    {
        $karyawan = DB::table('users')
            ->where('id', $id)
            ->get();

        $dept = Dept::get();

        return view('pages.karyawan.FormEdit', [
            'karyawan' => $karyawan,
            'dept' => $dept
        ]);
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
                'dept' => $request->dept,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'jumlah_cuti' => $request->jumlah_cuti
            ]);

        if ($request->password) {
            DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'passsword' => Hash::make($request->password)
                ]);
        }

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

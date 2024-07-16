<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\DataCuti;
use App\Models\Dept;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use DB;
use Log;


class KaryawanController extends Controller
{
    public function index()
    {
        // ->where('user_id', Auth::user()->id)
        $karyawan = DB::table('users')
            ->where('role', 'karyawan')
            ->where('is_active', '1')
            ->join('dept', 'users.dept', '=', 'dept.id')
            ->select(['*', 'users.id as user_id'])
            ->get();

        $dept = Dept::get();
        $jenisCuti = Cuti::all();

        foreach ($karyawan as $k) {

            $dataCuti = DataCuti::where('user_id', '=', $k->user_id)
                ->join('cuti', 'data_cuti.cuti_id', '=', 'cuti.id')
                ->get();

            if (!empty($dataCuti)) {
                $cuti = [];
                foreach ($dataCuti as $c) {
                    array_push($cuti, $c->nama_cuti);
                }
                $k->cuti = $cuti;
            }
        }

        return view('pages.karyawan.index', [
            'karyawan' => $karyawan,
            'dept' => $dept,
            'jenis_cuti' => $jenisCuti,
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        if (!$status) {
            Log::debug($status);
            return back()->with('error', 'Error validate');
        }

        $user = new User();
        $user->name = $request->name;
        $user->dept = $request->dept;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'karyawan';
        $user->password = Hash::make($request->password);

        $result = $user->save();
        Log::debug($result);
        foreach ($request->cuti as $c) {
            $cuti = new DataCuti();

            $masterCuti = Cuti::find($c);

            $cuti->user_id = $user->id;
            $cuti->cuti_id = $c;
            $cuti->sisa = $masterCuti->jumlah;
            $status = $cuti->save();
            Log::debug($status);
        }

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
        $cuties = Cuti::get();

        return view('pages.karyawan.FormEdit', [
            'karyawan' => $karyawan,
            'dept' => $dept,
            'cuties' => $cuties
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
        $cuti = $request->cuti;

        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'dept' => $request->dept,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

        // DataCuti::where($request->id)->delete();

        // foreach ($request->cuti as $value) {
        //     $dataCuti = new DataCuti();
        //     $dataCuti->user_id = $request->id;
        //     $dataCuti->cuti_id = $value;

        //     $dataCuti->save();
        // }


        DB::table('data_cuti')->where('user_id', '=', $request->id)->delete();

        foreach ($cuti as $c) {
            $masterCuti = Cuti::find($c);
            DB::table('data_cuti')
                ->where('user_id', '=', $request->id)
                ->updateOrInsert([
                    'user_id' => $request->id,
                    'cuti_id' => $c,
                    'sisa' => $masterCuti->jumlah
                ]);
        }

        if ($request->password) {
            DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'passsword' => Hash::make($request->password)
                ]);
        }

        return redirect()->route('karyawan.index')->with(['success' => 'Data Karyawan Berhasil Diupdate!']);

    }

    public function destroy(Request $request)
    {
        $user = User::find($request->user_id);
        $user->is_active = 0;
        $user->save();
        return redirect()
            ->route('karyawan.index')
            ->with(['success' => "Berhasil menghapus karyawan {$user->name} ({$user->id})"]);
    }
}

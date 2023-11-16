<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Permohonan_Cuti;


class DashboardController extends Controller
{
    public function index()
    {

        $permohonan = DB::table('users')
            ->join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->select('users.name', 'permohonan_cuti.id', 'permohonan_cuti.alasan_cuti', 'permohonan_cuti.tgl_mulai', 'permohonan_cuti.tgl_akhir', 'permohonan_cuti.status')
            ->where('permohonan_cuti.status', 'pending')
            ->limit(5)
            ->get();
        $jmlPermohonan = Permohonan_Cuti::where('status', 'pending')->get()->count();
        $jmlPermohonanDisetujui = Permohonan_Cuti::where('status', 'disetujui')->get()->count();
        $jmlPermohonanDitolak = Permohonan_Cuti::where('status', 'ditolak')->get()->count();


        return view('pages.Dashboard.DashboardAdmin', ["permohonan" => $permohonan, "jmlPermohonan" => $jmlPermohonan, 'jmlPermohonanDisetujui' => $jmlPermohonanDisetujui, 'jmlPermohonanDitolak' => $jmlPermohonanDitolak]);
    }
    public function show()
    {
        $id = Auth::user()->id;
        $permohonan = DB::table('users')
            ->join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->select('users.name', 'permohonan_cuti.alasan_cuti', 'permohonan_cuti.tgl_mulai', 'permohonan_cuti.tgl_akhir', 'permohonan_cuti.status')
            ->where('users.id', $id)
            ->limit(5)
            ->get();
        $sisaCuti = DB::table('users')->select('jumlah_cuti')->where('id', $id)->first();
        $jmlPermohonanDisetujui = Permohonan_Cuti::Where('status', 'disetujui')->where('user_id', $id)->get()->count();
        $jmlPermohonanDitolak = Permohonan_Cuti::where('status', 'ditolak')->where('user_id', $id)->get()->count();

        return view('pages.Dashboard.DashboardKaryawan', ["permohonan" => $permohonan, 'sisa_cuti' => $sisaCuti->jumlah_cuti, 'jmlPermohonanDisetujui' => $jmlPermohonanDisetujui, 'jmlPermohonanDitolak' => $jmlPermohonanDitolak]);
    }
}

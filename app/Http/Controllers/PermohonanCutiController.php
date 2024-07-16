<?php

namespace App\Http\Controllers;

use App\Mail\LeaveMail;
use App\Models\Cuti;
use App\Models\DataCuti;
use App\Models\Permohonan_Cuti;
use App\Models\User;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;



class PermohonanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permohonan = DB::table('users')
            ->join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->select('permohonan_cuti.id', 'users.name', 'permohonan_cuti.alasan_cuti', 'permohonan_cuti.tgl_mulai', 'permohonan_cuti.tgl_akhir', 'permohonan_cuti.status')
            ->where('permohonan_cuti.status', 'pending')
            ->get();
        return view('pages.permohonanCuti.index', ['permohonan' => $permohonan]);

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

    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $jenis = $request->jenis;
        // $data = DB::table('users')->select('jumlah_cuti')->where('id', $id)->get();

        $sisaCuti = DataCuti::where('user_id', '=', $id)
            ->where('cuti_id', '=', $jenis)
            ->first();
        // $sisaCuti = $data[0]->jumlah_cuti;
        // dd(json_encode($sisaCuti));
        $tglMulai = date_create($request->tgl_mulai);
        $tglAkhir = date_create($request->tgl_akhir);
        $durasi = date_diff($tglMulai, $tglAkhir);

        $jumlahCuti = $sisaCuti->sisa - $durasi->days;

        if ($jumlahCuti < 0) {
            return redirect()->route('karyawan.permohonan')->with(['error' => 'Maaf anda tidak bisa mengajukan cuti karena sisa cuti anda sudah habis']);
        } else {

            DB::table('permohonan_cuti')->insert([
                'user_id' => Auth::id(),
                'jenis_cuti' => $jenis,
                'alasan_cuti' => $request->alasan_cuti,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_akhir' => $request->tgl_akhir,
                'status' => 'pending'
            ]);
            return redirect()->route('karyawan.permohonan')->with(['success' => 'Berhasil Mengajukan Permohonan Cuti']);
        }



    }


    public function show()
    {
        //
        $id = Auth::user()->id;
        $permohonan = DB::table('users')
            ->join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->select('permohonan_cuti.id', 'users.name', 'permohonan_cuti.alasan_cuti', 'permohonan_cuti.tgl_mulai', 'permohonan_cuti.tgl_akhir', 'permohonan_cuti.status')
            ->where('permohonan_cuti.status', 'pending')
            ->where('permohonan_cuti.user_id', $id)
            ->get();

        $cuti = User::join('data_cuti', 'users.id', '=', 'data_cuti.user_id')
            ->join('cuti', 'data_cuti.cuti_id', '=', 'cuti.id')
            ->where('user_id', '=', $id)
            ->get();

        return view('pages.permohonanCuti.karyawan', ['permohonan' => $permohonan, 'jenis_cuti' => $cuti]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('pages.permohonanCuti.disetujui');
    }


    public function setuju(Request $request)
    {
        $cuti = Permohonan_Cuti::findOrFail($request->id);
        $userId = $request->user_id;

        $user = User::findOrFail($userId);

        $cuti->status = 'disetujui';
        $tgl_mulai = $cuti->tgl_mulai;
        $tgl_akhir = $cuti->tgl_akhir;

        $jenisCuti = $request->jenis_cuti;
        $data_cuti = DataCuti::where('cuti_id', '=', $jenisCuti)
            ->where('user_id', '=', $userId)
            ->join('cuti', 'data_cuti.cuti_id', '=', 'cuti.id')
            ->get()
            ->first();

        // dd(json_encode($data_cuti));
        // $jumlah_cuti = $user->jumlah_cuti;

        $tglMulai = date_create($tgl_mulai);
        $tglAkhir = date_create($tgl_akhir);

        // Penghitungan jumlah cuti
        $interval = new DateInterval('P1D'); // 1 day interval

        $workdays = 0;
        $durasi = new DatePeriod($tglMulai, $interval, $tglAkhir->modify('+1 day'));
        foreach ($durasi as $date) {
            $dayOfWeek = $date->format('N'); // Get day of the week (1 - Monday, 7 - Sunday)

            if ($dayOfWeek < 6) { // Check if it's not Saturday (6) or Sunday (7)
                $workdays++;
            }
        }

        // $data_cuti->sisa = $data_cuti->sisa - $workdays;
        DataCuti::where('user_id', '=', $userId)
            ->where('cuti_id', '=', $jenisCuti)
            ->update([
                'sisa' => $data_cuti->sisa - $workdays,
            ]);
        // $data_cuti->save();
        $cuti->updated_at = date("Y-m-d H:i:s");
        $cuti->save();
        $user->updated_at = date("Y-m-d H:i:s");
        $user->save();

        $permohonan = ([
            'name' => $user->name,
            'start_date' => $tgl_mulai,
            'end_date' => $tgl_akhir,
            'status' => $cuti->status,
            'total' => $workdays,
            'remaining' => $data_cuti->sisa,
            'note' => strtolower($cuti->alasan_cuti),
        ]);

        Mail::to($user->email)->send(new LeaveMail($permohonan));

        return redirect()->route('permohonan.disetujui')->with(['success' => 'Permohonan Cuti Berhasil Disetujui']);
    }
    public function tolak($id)
    {
        $cuti = Permohonan_Cuti::findOrFail($id);
        $userId = $cuti->user_id;

        $user = User::findOrFail($userId);

        $tgl_mulai = $cuti->tgl_mulai;
        $tgl_akhir = $cuti->tgl_akhir;

        $cuti->status = "ditolak";
        $cuti->updated_at = date("Y-m-d H:i:s");
        $cuti->save();
        $user->updated_at = date("Y-m-d H:i:s");
        $user->save();

        // Penghitungan jumlah cuti

        $tglMulai = date_create($tgl_mulai);
        $tglAkhir = date_create($tgl_akhir);
        $interval = new DateInterval('P1D'); // 1 day interval
        $durasi = new DatePeriod($tglMulai, $interval, $tglAkhir->modify('+1 day'));
        $workdays = 0;

        foreach ($durasi as $date) {
            $dayOfWeek = $date->format('N'); // Get day of the week (1 - Monday, 7 - Sunday)

            if ($dayOfWeek < 6) { // Check if it's not Saturday (6) or Sunday (7)
                $workdays++;
            }
        }

        $permohonan = ([
            'name' => $user->name,
            'start_date' => $tgl_mulai,
            'end_date' => $tgl_akhir,
            'status' => strtolower("ditolak"),
            'total' => $workdays,
            'remaining' => $user->jumlah_cuti,
            'note' => $cuti->alasan_cuti,
        ]);

        Mail::to($user->email)->send(new LeaveMail($permohonan));



        return redirect()->route('permohonan.ditolak')->with(['success' => 'Permohonan Cuti Berhasi Ditolak!']);
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

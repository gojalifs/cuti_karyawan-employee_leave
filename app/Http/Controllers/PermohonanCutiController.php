<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use DateTime;



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
            ->join('permohonan_cuti','users.id','=','permohonan_cuti.user_id')
            ->select('permohonan_cuti.id','users.name','permohonan_cuti.alasan_cuti','permohonan_cuti.tgl_mulai','permohonan_cuti.tgl_akhir','permohonan_cuti.status')
            ->where('permohonan_cuti.status','pending')
            ->get();
        return view('pages.permohonanCuti.index',['permohonan' => $permohonan]);
        
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
        $id=Auth::user()->id;
        $permohonan = DB::table('karyawan')
            ->join('permohonan_cuti','karyawan.id','=','permohonan_cuti.user_id')
            ->select('karyawan.jumlah_cuti')
            ->where('karyawan.user_id','id')
            ->get();
        $data = DB::table('karyawan')->select('jumlah_cuti')->where('user_id',$id)->get();
        
        $sisaCuti =$data[0]->jumlah_cuti; 
        
        $tglMulai = date_create($request->tgl_mulai);
        $tglAkhir = date_create($request->tgl_akhir);
        $durasi = date_diff($tglMulai,$tglAkhir);
        
        $jumlahCuti = $sisaCuti - $durasi->days;

        if($jumlahCuti < 0){
            return redirect()->route('karyawan.permohonan')->with(['error' => 'Maaf anda tidak bisa mengajukan cuti karena sisa cuti anda sudah habis']);
        }else{
            
            DB::table('permohonan_cuti')->insert([
                'user_id' => Auth::id(),
                'alasan_cuti' => $request->alasan_cuti,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_akhir' => $request->tgl_akhir,
                'status' => 'pending'
            ]);
            return redirect()->route('karyawan.permohonan')->with(['success' => 'Berhasil Mengajukan Permohonan Cuti']);
        }



    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $id=Auth::user()->id;
        $permohonan = DB::table('users')
            ->join('permohonan_cuti','users.id','=','permohonan_cuti.user_id')
            ->select('permohonan_cuti.id','users.name','permohonan_cuti.alasan_cuti','permohonan_cuti.tgl_mulai','permohonan_cuti.tgl_akhir','permohonan_cuti.status')
            ->where('permohonan_cuti.status','pending')
            ->where('permohonan_cuti.user_id',$id)
            ->get();

        return view('pages.permohonanCuti.karyawan',['permohonan' => $permohonan]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setuju($id)
    {
        $data = DB::table('users')
        ->join('karyawan','users.id','=','karyawan.user_id')
        ->join('permohonan_cuti','users.id','=','permohonan_cuti.user_id')
        ->select('permohonan_cuti.id','permohonan_cuti.user_id','users.name',
                  'permohonan_cuti.alasan_cuti','permohonan_cuti.tgl_mulai',
                  'permohonan_cuti.tgl_akhir','permohonan_cuti.status',
                  'karyawan.id','karyawan.alamat','karyawan.no_telpon',
                  'karyawan.jumlah_cuti'
                )
        ->where('permohonan_cuti.id',$id)
        ->get();
        $user_id='';
        $alasan_cuti='';
        $tgl_mulai='';
        $tgl_akhir='';
        $status='';
        $alamat='';
        $no_telpon='';
        $jumlah_cuti='';

        foreach ($data as $key => $value) {
            $user_id = $value->user_id ;
            $alasan_cuti = $value->alasan_cuti ;
            $tgl_mulai = $value->tgl_mulai;
            $tgl_akhir = $value->tgl_akhir;
            $status = $value->status;
            $alamat = $value->alamat;
            $no_telpon = $value->no_telpon;
            $jumlah_cuti = $value->jumlah_cuti;
        }
        $tglMulai = date_create($tgl_mulai);
        $tglAkhir = date_create($tgl_akhir);
        $durasi = date_diff($tglMulai,$tglAkhir);
        
        $jmlCuti=$jumlah_cuti - $durasi->days;

        DB::table('karyawan')->where('user_id',$user_id)->update([
            'user_id' => $user_id,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon,
            'jumlah_cuti' => $jmlCuti,
        ]);
        
        DB::table('permohonan_cuti')->where('id',$id)->update([
            'user_id' => $user_id,
            'alasan_cuti' => $alasan_cuti,
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir,
            'status' => "disetujui"
        ]);
        
        
        return redirect()->route('permohonan.disetujui')->with(['success' => 'Permohonan Cuti Berhasil Disetujui']);
    }
    public function tolak($id)
    {
        $data = DB::table('users')
        ->join('permohonan_cuti','users.id','=','permohonan_cuti.user_id')
        ->select('permohonan_cuti.id','permohonan_cuti.user_id','users.name',
                  'permohonan_cuti.alasan_cuti','permohonan_cuti.tgl_mulai',
                  'permohonan_cuti.tgl_akhir','permohonan_cuti.status'
                )
        ->where('permohonan_cuti.id',$id)
        ->get();
        $user_id='';
        $alasan_cuti='';
        $tgl_mulai='';
        $tgl_akhir='';
        $status='';

        foreach ($data as $key => $value) {
            $user_id = $value->user_id ;
            $alasan_cuti = $value->alasan_cuti ;
            $tgl_mulai = $value->tgl_mulai;
            $tgl_akhir = $value->tgl_akhir;
            $status = $value->status;
        }
        
        DB::table('permohonan_cuti')->where('id',$id)->update([
            'user_id' => $user_id,
            'alasan_cuti' => $alasan_cuti,
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir,
            'status' => "ditolak"
        ]);
        
        
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

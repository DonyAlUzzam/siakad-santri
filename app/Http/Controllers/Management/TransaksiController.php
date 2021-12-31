<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use DB;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi.index');
    }

    public function detail()
    {
        return view('transaksi.detail');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim_bayar' => 'required',
            // 'periode' => 'required',
            'kelas' => 'required',
            'tahun_ajaran'=>'required',
            // 'email' => 'required|email|unique:users,email',
            // 'pembayaran_1' => 'required',
            // 'pembayaran_2' => 'required',
            // 'pembayaran_3' => 'required',
        ]);
        $array = $request->only([
            'nim_bayar', 'periode','tahun_ajaran', 'tanggal_bayar', 'pembayaran_1', 'pembayaran_2', 'pembayaran_3', 'kelas', 'tanggal_bayar',
            'daftar_ulang', 'raport', 'uas_ganjil', 'uas_genap', 'lain_lain'
        ]);
        // $array['password'] = bcrypt($array['password']);
        $trx = TransaksiModel::create($array);
        return redirect()->back()
            ->with('success_message', 'Berhasil menambah Pembayaran baru');
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
        $trx = TransaksiModel::find($id);
        if (!$trx) return redirect()->back()
            ->with('error_message', 'Pembayaran dengan id'.$id.' tidak ditemukan');
        return view('transaksi.edit', [
            'user' => $trx
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($request);
        $request->validate([
            'nim_bayar' => 'required',
            'periode' => 'required',
            // 'email' => 'required|email|unique:users,email',
            // 'pembayaran_1' => 'required',
            // 'pembayaran_2' => 'required',
            // 'pembayaran_3' => 'required',
        ]);
        $trx = TransaksiModel::find($id);
        $trx->nim_bayar = $request->nim_bayar;
        $trx->periode = $request->periode;
        $trx->pembayaran_1 = $request->pembayaran_1;
        $trx->pembayaran_2 = $request->pembayaran_2;
        $trx->pembayaran_3 = $request->pembayaran_3;
        // if ($request->password) $user->password = bcrypt($request->password);
        // dd($user);
        $trx->save();
        return redirect()->back()
            ->with('success_message', 'Berhasil mengubah Pembayaran');
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

    public function getDataPembayaran(Request $request){

        $kelas = $request->kelas;
        $tahun_ajaran= $request->tahun_ajaran;

        $sWhere = "";

        if($kelas != 'all'){
            $sWhere .= " and kelas = '".$kelas."' ";
        }

        if($tahun_ajaran != 'all'){
            $sWhere .= " and tahun_ajaran = '".$tahun_ajaran."' ";
        }


        $query ="select nim,fullname, b.* from santri a left join 
        (select nim_bayar,kelas, sum(pembayaran_1) pembayaran_1, sum(pembayaran_2) pembayaran_2, sum(pembayaran_3) pembayaran_3,
        sum(daftar_ulang) daftar_ulang,
		sum(raport) raport,
		sum(uas_ganjil) uas_ganjil,
		sum(uas_genap) uas_genap,
		sum(lain_lain) lain_lain from pembayaran
        where 1=1 ".$sWhere." 
        group by nim_bayar,tahun_ajaran,kelas ) b on a.nim = b.nim_bayar where 1=1 ".$sWhere ;
        // dd($query);

        $data = DB::select(
            DB::raw($query)
        );

        // dd($data);

        $array=[
            "data"=>$data,
            ];

        return response()->json($array);
        
    }

    public function getDataDetailPembayaran(Request $request, $nim){
        // dd($nim);

        $kelas = $request->kelas;
        $tahun_ajaran= $request->tahun_ajaran;
        // dd($nim);

        $sWhere = "";

        if($kelas != 'all'){
            $sWhere .= " and kelas = '".$kelas."' ";
        }

        if($tahun_ajaran != 'all'){
            $sWhere .= " and tahun_ajaran = '".$tahun_ajaran."' ";
        }


        $query ="select * from pembayaran a
        left join (select nim,fullname,kelas from santri ) b on a.nim_bayar = b.nim
        where nim_bayar= ".$nim." ".$sWhere ;
        // dd($query);

        $data = DB::select(
            DB::raw($query)
        );

        // dd($data);

        $array=[
            "data"=>$data,
            ];

        return response()->json($array);
        
    }

    public function getDataTotalPembayaran(Request $request){

        // dd($periode);

        $kelas = $request->kelas;
        $tahun_ajaran= $request->tahun_ajaran;

        $sWhere = "";

        if($kelas != 'all'){
            $sWhere .= " and kelas = '".$kelas."' ";
        }

        if($tahun_ajaran != 'all'){
            $sWhere .= " and tahun_ajaran = '".$tahun_ajaran."' ";
        }

        $query ="select sum(x.pembayaran_1) as pembayaran_1, sum(x.pembayaran_2) as pembayaran_2, sum(x.pembayaran_3) as pembayaran_3,
            sum(daftar_ulang) daftar_ulang,
            sum(raport) raport,
            sum(uas_ganjil) uas_ganjil,
            sum(uas_genap) uas_genap,
            sum(lain_lain) lain_lain from (
            select nim, b.* from santri a left join 
            (select nim_bayar, periode, sum(pembayaran_1) pembayaran_1, sum(pembayaran_2) pembayaran_2, sum(pembayaran_3) pembayaran_3,
            sum(daftar_ulang) daftar_ulang,
            sum(raport) raport,
            sum(uas_ganjil) uas_ganjil,
            sum(uas_genap) uas_genap,
            sum(lain_lain) lain_lain from pembayaran 
            where 1=1 ".$sWhere."
            group by nim_bayar, periode ) b on a.nim = b.nim_bayar)x";
        // dd($query);

        $data = DB::select(
            DB::raw($query)
        );

        // dd($data);

        $array=[
            "data"=>$data,
            ];

        return response()->json($array);
        
    }

    public function getDataTotalDetailPembayaran(Request $request, $nim){

        // dd($periode);

        $kelas = $request->kelas;
        $tahun_ajaran= $request->tahun_ajaran;

        $sWhere = "";

        if($kelas != 'all'){
            $sWhere .= " and kelas = '".$kelas."' ";
        }

        if($tahun_ajaran != 'all'){
            $sWhere .= " and tahun_ajaran = '".$tahun_ajaran."' ";
        }

        $query ="select sum(x.pembayaran_1) as pembayaran_1, sum(x.pembayaran_2) as pembayaran_2, sum(x.pembayaran_3) as pembayaran_3 from (
            select nim, b.* from santri a left join 
            (select nim_bayar, sum(pembayaran_1) pembayaran_1, sum(pembayaran_2) pembayaran_2, sum(pembayaran_3) pembayaran_3 from pembayaran 
            where 1=1 ".$sWhere."
            group by nim_bayar ) b on a.nim = b.nim_bayar)x where nim_bayar = ".$nim." ";
        // dd($query);

        $data = DB::select(
            DB::raw($query)
        );

        // dd($data);

        $array=[
            "data"=>$data,
            ];

        return response()->json($array);
        
    }
}

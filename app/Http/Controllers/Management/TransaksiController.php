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
            'periode' => 'required',
            // 'email' => 'required|email|unique:users,email',
            // 'pembayaran_1' => 'required',
            // 'pembayaran_2' => 'required',
            // 'pembayaran_3' => 'required',
        ]);
        $array = $request->only([
            'nim_bayar', 'periode', 'tanggal_bayar', 'pembayaran_1', 'pembayaran_2', 'pembayaran_3'
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

        // dd($request);

        $sWhere = "";

        if($request->periode != "all"){
            $sWhere .= "where periode = '".$request->periode."' ";
        }

        $query ="select * from pembayaran ".$sWhere;
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

    public function getDataTotalPembayaran($periode){

        // dd($periode);

        $sWhere = "";

        if($periode != "all"){
            $sWhere .= " where periode = '".$periode."' ";
        }

        $query ="select sum(pembayaran_1) as pembayaran_1, sum(pembayaran_2) as pembayaran_2, sum(pembayaran_3) as pembayaran_3 from pembayaran".$sWhere;
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

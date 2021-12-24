<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getDataPembayaranAll(Request $request){

        // dd($request);
        $sWhere = "";

        if($request->tipe == "p1"){
            $sWhere .= " and y.pembayaran_1 is not null ";
        }else if($request->tipe == "p2"){
            $sWhere .= " and y.pembayaran_2 is not null ";
        }else if($request->tipe == "p3"){
            $sWhere .= " and y.pembayaran_3 is not null ";
        }

        if($request->periode != "all"){
            $sWhere .= " and periode = '".$request->periode."' ";
        }

        $query ="select x.*, y.pembayaran_1, y.pembayaran_2, y.pembayaran_3, y.periode  from (select image,nim,fullname from santri
                union select image,nim,fullname from santri_ma) x
                left join pembayaran y on x.nim = y.nim_bayar where 1=1 ".$sWhere;
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

    public function getDataRekapPembayaranAll(Request $request){

        // dd($request);
        $sWhere = "";

        if($request->tipe == "p1"){
            $sWhere .= " and y.pembayaran_1 is not null ";
        }else if($request->tipe == "p2"){
            $sWhere .= " and y.pembayaran_2 is not null ";
        }else if($request->tipe == "p3"){
            $sWhere .= " and y.pembayaran_3 is not null ";
        }

        if($request->periode != "all"){
            $sWhere .= " and periode = '".$request->periode."' ";
        }

        $query ="select x.*, y.pembayaran_1, y.pembayaran_2, y.pembayaran_3, y.periode 
             from (select image,nim,fullname from santri
                union select image,nim,fullname from santri_ma) x
                left join pembayaran y on x.nim = y.nim_bayar where 1=1 ".$sWhere;
        // dd($query);

        $totalCount = "select sum(pembayaran_1) as pembayaran_1, sum(pembayaran_2) as pembayaran_2, 
                        sum(pembayaran_3) as pembayaran_3 from (".$query.")z ";

                        // dd($totalCount);

        $total = DB::select(
            DB::raw($totalCount)
        );

        // dd($data);

        $array=[
            "data"=>$total,
            ];

        return response()->json($array);
        
    }

   
}

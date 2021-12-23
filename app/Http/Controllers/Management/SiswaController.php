<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiswaModel;
use DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $query = "select * from santri where kelas = 'II B' ";
        // $data = DB::select(
        //     DB::raw($query)
        // );
        // dd($data);
        return view('siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('santri.create');
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
            'nim' => 'required',
            'fullname' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required'
        ]);
        $array = $request->only([
            'nim', 'fullname', 'email', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'kelas'
        ]);
        // $array['password'] = bcrypt($array['password']);
        $user = SiswaModel::create($array);
        return redirect()->back()
            ->with('success_message', 'Berhasil menambah user baru');
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
        $user = SiswaModel::find($id);
        if (!$user) return redirect()->back()
            ->with('error_message', 'User dengan id'.$id.' tidak ditemukan');
        return view('santri.edit', [
            'user' => $user
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
            // 'nim' => 'required',
            'fullname' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required'
        ]);
        $user = SiswaModel::find($id);
        $user->nim = $request->nim;
        $user->fullname = $request->fullname;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->email = $request->email;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->alamat = $request->alamat;
        $user->kelas = $request->kelas;
        // if ($request->password) $user->password = bcrypt($request->password);
        // dd($user);
        $user->save();
        return redirect()->back()
            ->with('success_message', 'Berhasil mengubah user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = SiswaModel::find($id);

        // dd($user);
        // if ($id == $request->user()->id) return redirect()->route('users.index')
        //     ->with('error_message', 'Anda tidak dapat menghapus diri sendiri.');
        if ($user){
            $user->delete();
            return redirect()->back()
            ->with('success_message', 'Berhasil menghapus user');
        } else{
            return redirect()->back()
            ->with('error_message', 'User dengan id'.$id.' tidak ditemukan');
        }
        
    }

    public function getDataSiswa(Request $request){

        if ($request->data == 'santri-mts-one') {
            $query = "select * from santri where kelas = 'I' ";
        }else if ($request->data == 'santri-mts-two'){
            $query = "select * from santri where kelas = 'II' ";
        }else if ($request->data == 'santri-mts-three'){
            $query = "select * from santri where kelas = 'III' ";
        }else if ($request->data == 'santri-ma-one'){
            $query = "select * from santri_ma where kelas = 'I' ";
        }else if ($request->data == 'santri-ma-two'){
            $query = "select * from santri_ma where kelas = 'II' ";
        }else if ($request->data == 'santri-ma-three'){
            $query = "select * from santri_ma where kelas = 'III' ";
        }

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

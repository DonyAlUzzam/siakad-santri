<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SantriModel;
use DB;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = SantriModel::all();

        // $query = "select nim,fullname,email,tempat_lahir,tanggal_lahir,alamat,kelas from santri
        // union select nim,fullname,email,tempat_lahir,tanggal_lahir,alamat,kelas from santri_ma";

        // $data = DB::select(
        //     DB::raw($query)
        // );

        // dd($users);
        return view('santri.index');
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
        $user = SantriModel::create($array);
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
        $user = SantriModel::find($id);
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
        $user = SantriModel::find($id);
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
        $user = SantriModel::find($id);

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

    public function getDataSiswa(){
        $query = "select * from santri";
        $data = DB::select(
            DB::raw($query)
        );
        return response()->json($data);	
    }

    public function getDataSiswaAll()
    {
        // $users = SantriModel::all();

        $query = "select nim,fullname,email,tempat_lahir,tanggal_lahir,alamat,kelas from santri
        union select nim,fullname,email,tempat_lahir,tanggal_lahir,alamat,kelas from santri_ma";

        $data = DB::select(
            DB::raw($query)
        );
        $array=[
            "data"=>$data,
            ];
        // dd($users);
        return response()->json($array);	
    }
}

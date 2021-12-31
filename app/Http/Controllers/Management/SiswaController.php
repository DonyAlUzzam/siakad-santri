<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiswaModel;
use DB;
use Illuminate\Support\Facades\Storage;


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
        return view('siswa.create');
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
            'tahun_ajaran' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
            'tahun_ajaran' => 'required'
        ]);
        // $array = $request->only([
        //     'nim', 'fullname', 'email', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'kelas'
        // ]);

        $data = [
            "nim" => $request->get('nim'),
            "fullname" => $request->get('fullname'),
            "email" => $request->get('email'),
            "alamat" => $request->get('alamat'),
            "tempat_lahir" => $request->get('tempat_lahir'),
            "tanggal_lahir" => $request->get('tanggal_lahir'),
            "kelas" => $request->get('kelas'),
            "tahun_ajaran" => $request->get('tahun_ajaran'),
            "status" => $request->get('status'),
            // "image" => $request->image->hashName()
        ];

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png, jpg' // Only allow .jpg, .bmp and .png file types.
            ]);

            // $request->file('image')->move(public_path('images'), $filename);

            $request->image->store('Image', 'public');

            $data["image"] = $request->image->hashName();

        }
        // $array['password'] = bcrypt($array['password']);
        $user = SiswaModel::create($data);
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
            ->with('error_message', 'Siswa dengan id'.$id.' tidak ditemukan');
        return view('siswa.edit', [
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
            'nim' => 'required',
            'fullname' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
            'tahun_ajaran' => 'required'
        ]);
        $user = SiswaModel::find($id);
        $user->nim = $request->nim;
        $user->fullname = $request->fullname;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->email = $request->email;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->alamat = $request->alamat;
        $user->kelas = $request->kelas;
        $user->image = $user->image;
        $user->tahun_ajaran = $request->tahun_ajaran;

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png, jpg' // Only allow .jpg, .bmp and .png file types.
            ]);

            // $request->file('image')->move(public_path('images'), $filename);
            // Storage::delete('storage/app/public/Image'.$user->image);
            // File::delete($user->image);
            Storage::disk('public')->delete('Image/'.$user->image);
            $request->image->store('Image', 'public');

            $user->image = $request->image->hashName();
        }

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
        $kelas = $request->kelas;
        $tahun_ajaran= $request->tahun_ajaran;

        $sWhere = "";

        if($kelas != 'all'){
            $sWhere .= " and kelas = '".$kelas."' ";
        }

        if($tahun_ajaran != 'all'){
            $sWhere .= " and tahun_ajaran = '".$tahun_ajaran."' ";
        }

        $query = "select * from santri_ma where 1=1 ".$sWhere;
        $data = DB::select(
            DB::raw($query)
        );

        $array=[
            "data"=>$data,
            ];
        return response()->json($array);	
    }
}

@extends('adminlte::page')

@section('title', 'Tambah Siswa')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Siswa SMPS</h1>
@stop

@section('content')
    <form action="{{route('santri.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                <div class="form-group">
                        <label for="exampleInputName">Nisn</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nisn" name="nim" value="{{$user->nim ?? old('nim')}}">
                        @error('nim') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Nama Lengkap</label>
                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="fullname" value="{{$user->fullname ?? old('fullname')}}">
                        @error('fullname') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group d-none">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Masukkan Email" name="email" value="{{old('email')}}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Tempat Lahir</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="exampleInputName" placeholder="Tempat Lahir" name="tempat_lahir" value="{{old('tempat_lahir')}}">
                        @error('tempat_lahir') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="exampleInputName" placeholder="Tanggal Lahir" name="tanggal_lahir" value="{{old('tanggal_lahir')}}">
                        @error('tanggal_lahir') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="exampleInputName" placeholder="Alamat" name="alamat" value="{{old('alamat')}}">
                        @error('alamat') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Kelas</label>
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="exampleInputName" placeholder="Kelas" name="kelas" value="{{old('kelas')}}">
                        @error('kelas') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Tahun Ajaran</label>
                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="exampleInputName" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{old('tahun_ajaran')}}">
                        @error('tahun_ajaran') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Status</label>
                        <input type="text" class="form-control @error('status') is-invalid @enderror" id="exampleInputName" placeholder="Status" name="status" value="{{old('status')}}">
                        @error('status') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Foto</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="exampleInputName" placeholder="Image" name="image" value="{{old('image')}}">
                        @error('image') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="javascript:history.go(-1)" class="btn btn-default">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
@include('layouts.footer')
@stop
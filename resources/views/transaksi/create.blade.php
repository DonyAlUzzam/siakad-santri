@extends('adminlte::page')

@section('title', 'Tambah Pembayaran')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Pembayaran SMPS</h1>
@stop

@section('content')
    <form action="{{route('transaksi-mts.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                <div class="form-group">
                        <label for="exampleInputName">Nisn</label>
                        <input type="text" class="form-control @error('nim_bayar') is-invalid @enderror" id="exampleInputName" placeholder="Nisn" name="nim_bayar" value="{{old('nim_bayar')}}">
                        @error('nim_bayar') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                   
                    <div class="form-group d-none">
                        <label for="exampleInputName">Periode</label>
                        <input type="month"  class="form-control @error('periode') is-invalid @enderror" id="exampleInputName" placeholder="Periode" name="periode" >
                        @error('periode') <span class="text-danger">{{$message}}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail">SPP</label>
                        <input type="number" class="form-control @error('pembayaran_1') is-invalid @enderror" id="exampleInputEmail" placeholder="SPP" name="pembayaran_1" value="{{old('pembayaran_1')}}">
                        @error('pembayaran_1') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Kitab</label>
                        <input type="number" class="form-control @error('pembayaran_2') is-invalid @enderror" id="exampleInputName" placeholder="Kitab" name="pembayaran_2" value="{{old('pembayaran_2')}}">
                        @error('pembayaran_2') <span class="text-danger">{{$message}}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">LKS</label>
                        <input type="number" class="form-control @error('pembayaran_3') is-invalid @enderror" id="exampleInputName" placeholder="LKS" name="pembayaran_3" value="{{old('pembayaran_3')}}">
                        @error('pembayaran_3') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Daftar Ulang</label>
                        <input type="number" class="form-control @error('daftar_ulang') is-invalid @enderror" id="exampleInputName" placeholder="Daftar Ulang" name="daftar_ulang" value="{{old('daftar_ulang')}}">
                        @error('daftar_ulang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Raport</label>
                        <input type="number" class="form-control @error('raport') is-invalid @enderror" id="exampleInputName" placeholder="Raport" name="raport" value="{{old('raport')}}">
                        @error('raport') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Uas Ganjil</label>
                        <input type="number" class="form-control @error('raport') is-invalid @enderror" id="exampleInputName" placeholder="Uas Ganjil" name="uas_ganjil" value="{{old('uas_ganjil')}}">
                        @error('uas_ganjil') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Uas Genap</label>
                        <input type="number" class="form-control @error('raport') is-invalid @enderror" id="exampleInputName" placeholder="Uas Genap" name="uas_genap" value="{{old('uas_genap')}}">
                        @error('uas_genap') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Lain-Lain</label>
                        <input type="number" class="form-control @error('lain_lain') is-invalid @enderror" id="exampleInputName" placeholder="Lain-Lain" name="lain_lain" value="{{old('lain_lain')}}">
                        @error('lain_lain') <span class="text-danger">{{$message}}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">Tanggal Bayar</label>
                        <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="exampleInputName" placeholder="Tanggal Bayar" name="tanggal_bayar" value="{{old('tanggal_bayar')}}">
                        @error('tanggal_bayar') <span class="text-danger">{{$message}}</span> @enderror
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


                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="javascript:history.go(-1)" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
@include('layouts.footer')
@stop
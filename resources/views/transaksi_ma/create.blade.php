@extends('adminlte::page')

@section('title', 'Tambah Pembayaran')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Pembayaran</h1>
@stop

@section('content')
    <form action="{{route('transaksi-ma.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                <div class="form-group">
                        <label for="exampleInputName">Nim</label>
                        <input type="text" class="form-control @error('nim_bayar') is-invalid @enderror" id="exampleInputName" placeholder="Nim" name="nim_bayar" value="{{old('nim_bayar')}}">
                        @error('nim_bayar') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                   
                    <div class="form-group d-none">
                        <label for="exampleInputName">Periode</label>
                        <input type="month"  class="form-control @error('periode') is-invalid @enderror" id="exampleInputName" placeholder="Periode" name="periode" >
                        @error('periode') <span class="text-danger">{{$message}}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail">Pembayaran 1</label>
                        <input type="number" class="form-control @error('pembayaran_1') is-invalid @enderror" id="exampleInputEmail" placeholder="Pembayaran 1" name="pembayaran_1" value="{{old('pembayaran_1')}}">
                        @error('pembayaran_1') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Pembayaran 2</label>
                        <input type="number" class="form-control @error('pembayaran_2') is-invalid @enderror" id="exampleInputName" placeholder="Pembayaran 2" name="pembayaran_2" value="{{old('pembayaran_2')}}">
                        @error('pembayaran_2') <span class="text-danger">{{$message}}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">Pembayaran 3</label>
                        <input type="number" class="form-control @error('pembayaran_3') is-invalid @enderror" id="exampleInputName" placeholder="Pembayaran 3" name="pembayaran_3" value="{{old('pembayaran_3')}}">
                        @error('pembayaran_3') <span class="text-danger">{{$message}}</span> @enderror
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
@extends('adminlte::page')

@section('title', 'Edit Pembayaran')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Pembayaran</h1>
@stop

@section('content')
    <form action="{{route('transaksi.update', $user)}}" method="post">
    @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                <div class="form-group">
                        <label for="exampleInputName">Nisn</label>
                        <input type="text" class="form-control @error('nim_bayar') is-invalid @enderror" id="exampleInputName" placeholder="Nim" name="nim_bayar" value="{{$user->nim_bayar ?? old('nim_bayar')}}">
                        @error('nim_bayar') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                   
                    <div class="form-group d-none">
                        <label for="exampleInputName">Periode</label>
                        <input type="month" class="form-control @error('periode') is-invalid @enderror" id="exampleInputName" placeholder="Periode" name="periode" value="{{$user->periode ?? old('periode')}}">
                        @error('periode') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">SPP</label>
                        <input type="number" class="form-control @error('pembayaran_1') is-invalid @enderror" id="exampleInputEmail" placeholder="Pembayaran 1" name="pembayaran_1" value="{{$user->pembayaran_1 ?? old('pembayaran_1')}}">
                        @error('pembayaran_1') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Kitab</label>
                        <input type="number" class="form-control @error('pembayaran_2') is-invalid @enderror" id="exampleInputName" placeholder="Pembayaran 2" name="pembayaran_2" value="{{$user->pembayaran_2 ?? old('pembayaran_2')}}">
                        @error('pembayaran_2') <span class="text-danger">{{$message}}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">LKS</label>
                        <input type="number" class="form-control @error('pembayaran_3') is-invalid @enderror" id="exampleInputName" placeholder="Pembayaran 3" name="pembayaran_3" value="{{$user->pembayaran_3 ?? old('pembayaran_3')}}">
                        @error('pembayaran_3') <span class="text-danger">{{$message}}</span> @enderror
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
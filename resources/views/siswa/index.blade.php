@extends('adminlte::page')

@section('title', 'List Siswa')

@section('content_header')
    <h1 class="m-0 text-dark" id="title"></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-start align-items-center" >
                        <div class="col-5">
                        <label>Pilih Tahun Ajaran</label>

                                <select name="tahun_ajaran"
                                        id="tahun_ajaran"
                                        onchange="updateTahunAjaran(this);"
                                        class="form-control form-control-sm col-lg-3 col-sm-12">
                                        <option value="all">All</option>
                                        <option value="2021/2022">2021/2022</option>
                                        <option value="2020/2021">2020/2021</option>
                                        <option value="2019/2020">2019/2020</option>
                                        <option value="2018/2019">2018/2019</option>
                                </select>
                        </div>
                        <div class="col-4">
                            <label>Pilih Kelas</label>
                                <select name="kelas"
                                        id="kelas"
                                        onchange="updateKelas(this);"
                                        class="form-control form-control-sm col-lg-4 col-sm-12">
                                        <option value="all">All</option>
                                        <option value="1">Kelas 1</option>
                                        <option value="2">Kelas 2</option>
                                        <option value="3">Kelas 3</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <a href="{{route('siswa.create')}}" class="btn btn-primary mb-2">
                        Tambah Siswa
                    </a>

                    <table class="table table-hover table-bordered table-stripped display responsive " id="siswa" width="100%">
                       
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
@include('layouts.footer')
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>

    <script src="{{asset('js/ma.js')}}"></script>
@endpush
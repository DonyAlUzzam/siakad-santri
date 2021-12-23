@extends('adminlte::page')

@section('title', 'List Siswa')

@section('content_header')
    <h1 class="m-0 text-dark">List Siswa</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="addSiswa">
                    
                    </div>
                    <table class="table table-hover table-bordered table-stripped display responsive" id="siswa" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nim</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <!-- <th>Kelas</th> -->
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop


@push('js')
<form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>



<script src="{{asset('js/kelas_1.js')}}"></script>


@endpush
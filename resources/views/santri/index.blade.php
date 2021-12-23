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

                    <!-- <a href="{{route('santri.create')}}" class="btn btn-primary mb-2">
                        Tambah Siswa
                    </a> -->

                    <table class="table table-hover table-bordered table-stripped display responsive " id="example2" width="100%">
                       
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

    <script src="{{asset('js/all_siswa.js')}}"></script>
@endpush
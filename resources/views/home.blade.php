@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard Pondok Pesantren Al-Ustmaniyah Batam</h1>
    <link href="{{ asset ('css/style.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
              
                <div class="card-body">

                <img src="ponpes.jpg" width="100%"/>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
@include('layouts.footer')
@stop

@push('js')

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    <script src="{{asset('js/all_payment.js')}}"></script>
@endpush
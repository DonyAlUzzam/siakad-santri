@extends('adminlte::page')

@section('title', 'List Pembayaran')

@section('content_header')
    <h1 class="m-0 text-dark">List Pembayaran</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-start align-items-center" >
                        <div class="col-7" id="addTransaksi">

                        </div>
                        <div class="col-1">
                            <label>Pilih Bulan</label>
                        </div>
                        <div class="col-4">
                                <select name="periode"
                                        id="periode"
                                        onchange="updatePeriode(this);"
                                        class="form-control form-control-sm col-lg-3 col-sm-12">
                                        <option value="all">All</option>
                                        <option value="2021-01">Januari</option>
                                        <option value="2021-02">Februari</option>
                                        <option value="2021-03">Maret</option>
                                        <option value="2021-04">April</option>
                                        <option value="2021-05">Mei</option>
                                        <option value="2021-06">Juni</option>
                                        <option value="2021-07">Juli</option>
                                        <option value="2021-08">Agustus</option>
                                        <option value="2021-09">September</option>
                                        <option value="2021-10">Oktober</option>
                                        <option value="2021-11">November</option>
                                        <option value="2021-12">Desember</option>
                                </select>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered table-stripped display responsive" id="pembayaran" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nim</th>
                            <th>Periode</th>
                            <th>Pembayaran 1</th>
                            <th>Pembayaran 2</th>
                            <th>Pembayaran 3</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                                <tr class="text-primary">
                                    <th colspan="3">Total Pembayaran : </th>
                                    <th style="text-align: right;"></th>
                                    <th style="text-align: right;"></th>
                                    <th style="text-align: right;"></th>
                                    <th style="text-align: right;"></th>
                                </tr>
                            </tfoot>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>



<script src="{{asset('js/transaksi.js')}}"></script>


@endpush
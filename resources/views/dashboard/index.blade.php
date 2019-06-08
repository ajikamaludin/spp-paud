@extends('layouts.app')

@section('page-name','Dashboard')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            Dashboard
        </h1>
    </div>
    <div class="row">
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">IDR {{ format_idr($total_uang) }}</div>
                <div class="text-muted mb-4">Total Uang</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">IDR {{ format_idr($total_uang_masuk) }}</div>
                <div class="text-muted mb-4">Total Uang Masuk</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">IDR {{ format_idr($total_uang_keluar) }}</div>
                <div class="text-muted mb-4">Total Uang Keluar</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">IDR {{ format_idr($total_uang_spp) }}</div>
                <div class="text-muted mb-4">Total Uang SPP</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-3">
            <div class="card">
                <div class="card-body p-3 text-center">
                <div class="h1 m-0">IDR {{ format_idr($total_uang_tabungan) }}</div>
                <div class="text-muted mb-4">Total Uang Tabungan</div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Harian : {{ now()->format('d-m-Y') }}</h3>
                    <div class="card-options">
                        <input class="form-control mr-2" type="text" name="dates" style="max-width: 200px" data-toggle="datepicker" autocomplete="off" value="{{ now()->format('d-m-Y') }}">
                        <button id="btn-cetak-spp" class="btn btn-primary mr-1" value="#">Cetak</button>
                        <a href="#!" target="_blank" class="btn btn-primary">Export</a>
                    </div>
                </div>
                <div class="card-body">
                    report harian
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        require(['jquery', 'selectize','datepicker'], function ($, selectize) {
        $(document).ready(function () {
                $('[data-toggle="datepicker"]').datepicker({
                    format: 'dd-MM-yyyy'
                });
            });
        });
    </script>
@endsection
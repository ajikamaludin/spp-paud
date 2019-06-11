@extends('layouts.app')

@section('page-name','Kuitansi')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            Kuitansi
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card" id="print">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2>{{ $sitename }}</h2> 
                            <p>Invoice: <span id="invoice">{{ $kuitansi->invoice }}</span></p>
                        </div>
                        <div class="col-3">
                            <div class="d-flex">
                                <p class="ml-auto"> 
                                    Tanggal : {{  $kuitansi->created_at->format('d-m-Y') }}<br>
                                    Nama : {{ Auth::user()->name }}
                                </p>
                            </div>
                        </div>
                        <hr class="bg-color">
                        <table class="table card-table table-hover table-vcenter text-wrap title" id="print">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td style="width: 60%">
                                        <input type="text" class="form-control" value="{{ $item->nama }}">
                                    </td>
                                    <td><input type="text" class="form-control" id="jumlah-0" value="{{ $item->jumlah }}"></td>
                                    <td><input type="text" class="form-control harga" data-id="0" value="{{ $item->harga }}"></td>
                                </tr>
                                @endforeach
                                <tr id="newrow"></tr>
                            </tbody>
                        </table>
                        <div class="btn btn-outline-primary col-12 btn-sm" title="tambah baris" id="tambah">
                            <span class="fe fe-plus"></span>
                        </div> 
                        <table class="table card-table table-vcenter text-wrap title">
                            {{-- <tr>
                                <td style="width: 60%"></td>
                                <td style="width: 20%;text-align: right;"><b>DISKON</b></td>
                                <td style="width: 20%"><input type="text" class="form-control" id="diskon"></td>
                            </tr> --}}
                            <tr>
                                <td style="width: 60%"></td>
                                <td style="width: 20%;text-align: right;"><b>TOTAL</b></td>
                                <td style="width: 20%;">IDR. <span id="total">{{ $kuitansi->total }}</span></td>
                            </tr>
                            <tr>
                                <td style="width: 60%"></td>
                                <td style="width: 20%;text-align: left;">
                                    <b>Tanda Terima</b>
                                    <br>
                                    <br>
                                    <p>............................</p>
                                </td>
                                <td style="width: 20%;text-align: left;">
                                    <b>Hormat Kami</b>
                                    <br>
                                    <br>
                                    <p>............................</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary ml-auto" id="cetak">Cetak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        require(['jquery'], function ($) {
            $(document).ready(function () {

            $('#cetak').hide()
            $('.page-title').hide()
            $('#tambah').hide()
            $('.hapus').hide()
            $('#histori').toggle()
            
            window.print()

            window.onafterprint = function(){
                    window.close()
            }
        });
        });
    </script>
@endsection
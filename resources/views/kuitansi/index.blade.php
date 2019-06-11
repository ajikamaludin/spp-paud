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
                            <p>Invoice: <span id="invoice">{{ now()->format('YmdHis') }}</span></p>
                        </div>
                        <div class="col-3">
                            <div class="d-flex">
                                <p class="ml-auto"> 
                                    Tanggal : {{ now()->format('d-m-Y') }}<br>
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
                                {{-- <tr>
                                    <td style="width: 60%">
                                        <input type="text" class="form-control">
                                    </td>
                                    <td><input type="text" class="form-control" id="jumlah-0"></td>
                                    <td><input type="text" class="form-control harga" data-id="0"></td>
                                </tr> --}}
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
                                <td style="width: 20%;">IDR. <span id="total">0</span></td>
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
                        <button type="submit" class="btn btn-secondary ml-2" id="baru">Baru</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12" id="histori">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Histori</p>
                </div>
                <div class="card-body">
                    <table class="table card-table table-hover table-vcenter text-nowrap title" id="print">
                        <tr>
                            <th>Tanggal</th>
                            <th>Invoice</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        @foreach ($kuitansi as $item)
                            <tr>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>{{ $item->invoice }}</td>
                                <td>IDR. {{ format_idr($item->total) }}</td>
                                <td><a href="{{ route('kuitansi.print', $item->id) }}" target="_blank">Cetak</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        require(['jquery'], function ($) {
            $(document).ready(function () {
                $('#cetak').on('click',function(){
                    $(this).hide()
                    $('.page-title').hide()
                    $('#tambah').hide()
                    $('.hapus').hide()
                    $('#histori').toggle()
                    $('#baru').toggle()
                    
                    window.print()

                    var string = [];
                    var index = 0;
                    $('input').each(function(){
                        if(this.name == 'nama'){
                            index += 1
                        }
                        string.push({
                            num: index,
                            key: this.name,
                            value: this.value
                        })
                    })

                    $.ajax({
                        type: "POST",
                        url: "{{ route('kuitansi.store') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            invoice: $('#invoice').text(),
                            data: string,
                            total: seluruh
                        },
                        success: function(data){
                            console.log(data)
                        }
                    })
                })
            });
            window.onafterprint = function(){
                    $('#cetak').show()
                    $('#histori').toggle()
                    $('.page-title').show()
                    $('#tambah').show()
                    $('.hapus').show()
                    $('#baru').toggle()
            }
            var index = 0
            $('#tambah').on('click', function(){
                index = index+1
                $('#newrow').before('<tr id="baris-' + index +'">' +
                                    '<td style="width:60%;">'+
                                        '<div class="row">' +
                                            '<div class="col-11">' +
                                                '<input type="text" class="form-control" name="nama">' +
                                            '</div>' +
                                            '<div class="col-1">' +
                                                '<button class="btn btn-secondary hapus" title="hapus item" type="button" value="'+ index +'"><i class="fe fe-trash"></i></button>'+
                                            '</div>'+
                                        '</div>'+ 
                                    '</td>' +
                                    '<td><input type="number" min=0 class="form-control" name="jumlah" id="jumlah-'+ index +'"></td>' +
                                    '<td><input type="number" min=0 class="form-control harga" name="harga" data-id="'+ index +'"></td>' +
                                "</tr>")
            })
            var seluruh = 0;
            $(document).on('keyup','.harga', function(){
                seluruh = 0;
                $('.harga').each(function() {
                    if(this.value != ''){
                        id = $(this).attr('data-id')
                        jumlah = $('#jumlah-' + id).val()
                        if(jumlah != ''){
                            jumlah = parseInt(jumlah, 10)
                            sol = parseInt((this.value * jumlah), 10)
                        }else{
                            sol = this.value
                        }
                        seluruh += parseInt(sol, 10)
                    }
                });
                $('#total').text(seluruh);
            })
            $('#baru').on('click', function(){
                window.location.reload()
            })
            $(document).on('click','.hapus', function(){
                id = this.value
                console.log(id)
                $('#baris-'+id).remove()
                // $(this).remove()
            })
        });
    </script>
@endsection
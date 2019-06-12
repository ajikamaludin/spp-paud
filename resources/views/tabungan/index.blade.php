@extends('layouts.app')

@section('page-name','Tabungan')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('page-name')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaksi</h3>
                </div>
                @if(session()->has('msg'))
                <div class="card-alert alert alert-{{ session()->get('type') }}" id="message" style="border-radius: 0px !important">
                    @if(session()->get('type') == 'success')
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    @else
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
                    @endif
                        {{ session()->get('msg') }}
                </div>
                @endif
                <div class="card-body">
                    {{-- <form action="{{ route('tabungan.store') }}" method="post"> --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Keperluan</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                        <input type="radio" name="keperluan" value="in" class="selectgroup-input">
                                        <span class="selectgroup-button">Menabung</span>
                                        </label>
                                        <label class="selectgroup-item">
                                        <input type="radio" name="keperluan" value="out" class="selectgroup-input">
                                        <span class="selectgroup-button">Penarikan</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none" id="form-siswa">
                                    <label class="form-label">Siswa</label>
                                    <select id="siswa" class="form-control" name="siswa_id">
                                        <option value="#">[-- Pilih Siswa --]</option>
                                        @foreach($siswa as $item)
                                            <option value="{{ $item->id }}"> {{ $item->nama.' - '.$item->kelas->nama.' - ' }} </option>
                                        @endforeach
                                    </select><br>
                                    Saldo: IDR. <span id="saldo">0</span>
                                </div>
                                <div class="form-group" style="display:none" id="form-jumlah">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" min='100' placeholder="masukan jumlah tanpa tanda titik atau koma">
                                </div>
                                <div class="form-group" style="display:none" id="form-keterangan">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keperluan" id="keterangan" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex" style="display:none !important" id="form-submit">
                            <button id="submit" class="btn btn-primary ml-auto">Simpan</button>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mutasi tabungan</h3>
                    <div class="card-options">
                        <a href="{{ route('tabungan.export') }}" class="btn btn-primary btn-sm ml-2" download="true">Export</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-hover table-vcenter text-wrap">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>KD</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Cetak</th> 
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tabungan as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('siswa.show', $item->siswa->id) }}" target="_blank">
                                        {{ $item->siswa->nama }} -
                                        {{ $item->siswa->kelas->nama }} -
                                        {{ isset($item->siswa->kelas->periode) ? $item->siswa->kelas->periode->nama : '' }}
                                    </a>
                                </td>
                                <td>
                                    @if($item->tipe == 'in')
                                        Menabung
                                    @elseif($item->tipe == 'out')
                                        Penarikan
                                    @endif
                                </td>
                                <td style="max-width:150px;">{{ $item->keperluan }}</td>
                                <td>IDR. {{ format_idr($item->jumlah) }}</td>
                                <td> 
                                    <a class="btn btn-outline-primary btn-sm" target="_blank" href="{{ route('tabungan.transaksicetak', $item->id)}}">
                                        Cetak
                                    </a> 
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            {{ $tabungan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: black;
        }
        .select2{
            width: 100% !important;
        }
    </style>
@endsection
@section('js')
<script>
    require(['jquery', 'sweetalert','select2'], function ($, sweetalert, select2) {
        $(document).ready(function () {
            $('#siswa').select2({
                placeholder: "Pilih Siswa",
            });
            
            var saldo = 0;
            var keperluan = 'in';
            var siswa_id = 0;
            var jumlah = 0;
            //keperluan
            $('.selectgroup-input').change(function(){
                keperluan = this.value
                console.log(this.value)
                $('#form-siswa').show()
            })
            // memilih siswa
            $('#siswa').on('change',function(){
                if(this.value == '#'){
                    $('#saldo').text('0')
                    $('#form-jumlah').hide()
                    $('#form-keterangan').hide()
                    $('#submit').hide()
                    return;
                }else{
                    siswa_id = this.value
                }
                $.ajax({url: "{{ route('api.getsaldo') }}/" + this.value, success: function(result){
                    $('#saldo').text(result.sal)
                    saldo = result.saldo
                    $('#form-jumlah').show()
                    $('#form-keterangan').show()
                    $('#submit').show()
                }, beforeSend: function(){ 
                    $('#form-jumlah').hide()
                    $('#form-keterangan').hide()
                    $('#submit').hide()
                    $('#saldo').text('tunggu, sedang mengambil saldo.....') 
                }
                });
            })
            
            $('#jumlah').keyup(function(){
                if(this.value <= 0){
                    this.value = ''
                }else{
                    jumlah = this.value
                }
                $('#form-submit').show()
            })
            $('#submit').on('click',function(){
                if((saldo <= 0 && keperluan == 'out')|| (saldo < jumlah && keperluan == 'out')){
                    swal({
                        title: 'tidak dapat melakukan penarikan, saldo ' + saldo + ', dengan jumlah ' + jumlah,
                        dangerMode: true,
                    })
                }else if(jumlah <= 99 && keperluan == 'in' || jumlah == undefined || $('#jumlah').val() <= 99){
                    swal({
                        title: 'jumlah belum diisi',
                        dangerMode: true,
                    })
                }else{
                    $('#submit').addClass("btn-loading")
                    $.ajax({
                    type: "POST",
                    url: "{{ route('api.menabung') }}/"+siswa_id,
                    data: {
                        tipe : keperluan,
                        siswa_id : siswa_id,
                        jumlah : jumlah,
                        keperluan : $('#keterangan').val()
                    },
                    success: function(data){
                        swal({title: data.msg})
                        setTimeout(function(){
                            window.location.reload()
                        }, 2000)
                    },
                    error: function(data){
                        console.log('Error......')
                        console.log(data)
                    }
                    });
                }

            })
            
            $(document).on('click','.btn-delete', function(){
                formid = $(this).attr('data-id');
                swal({
                    title: 'Anda yakin ingin menghapus?',
                    text: 'mutasi yang dihapus tidak dapat dikembalikan',
                    dangerMode: true,
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                }).then((result) => {
                    if (result) {
                        $('#form-' + formid).submit();
                    }
                })
            })

        });
    });
</script>
@endsection
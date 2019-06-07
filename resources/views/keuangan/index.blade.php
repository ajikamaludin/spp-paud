@extends('layouts.app')

@section('page-name','Keuangan')

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
                    <form action="{{ route('keuangan.store') }}" method="post">
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
                                        <span class="selectgroup-button">Catat Pemasukan</span>
                                        </label>
                                        <label class="selectgroup-item">
                                        <input type="radio" name="keperluan" value="out" class="selectgroup-input">
                                        <span class="selectgroup-button">Catat Pengeluaran</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none" id="form-jumlah">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" min='100' required>
                                </div>
                                <div class="form-group" style="display:none" id="form-keterangan">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button id="submit" class="btn btn-primary ml-auto" style="display:none">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mutasi Keuangan</h3>
                    <div class="card-options">
                        <a href="{{ route('keuangan.export') }}" class="btn btn-primary btn-sm ml-2" download="true">Export</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-hover table-vcenter text-wrap">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Tanggal</th>
                            <th>KD</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($keuangan as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>
                                    @if($item->tipe == 'in')
                                        Uang Masuk
                                    @elseif($item->tipe == 'out')
                                        Uang Keluar
                                    @endif
                                </td>
                                <td style="max-width:150px;">{{ $item->keterangan }}</td>
                                <td>IDR. {{ format_idr($item->jumlah) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            {{ $keuangan->links() }}
                        </div>
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
            var keperluan = 'in';
            //keperluan
            $('.selectgroup-input').change(function(){
                keperluan = this.value
                $('#form-jumlah').show()
                $('#form-keterangan').show()
                $('#submit').show()
            })

        });
    });
</script>
@endsection
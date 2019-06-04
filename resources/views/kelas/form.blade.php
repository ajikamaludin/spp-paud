@extends('layouts.app')

@section('site-name','Sistem Informasi SPP')
@section('page-name', (isset($kelas) ? 'Ubah Kelas' : 'Kelas Baru'))

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ (isset($kelas) ? route('kelas.update', $kelas->id) : route('kelas.create')) }}" method="post" class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                </div>
                <div class="card-body">
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
                                <label class="form-label">Periode</label>
                                <select class="form-control" name="periode_id">
                                    @foreach($periode as $item)
                                        <option value=""></option>
                                        <option value="{{ $item->id }}" {{ isset($kelas) ? ($item->id == $kelas->id ? 'selected' : '') : '' }}>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ isset($kelas) ? $kelas->nama : old('nama') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-link">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
<script>
    require(['jquery', 'selectize'], function ($, selectize) {
        $(document).ready(function () {
            $('#select-beast').selectize({});
        });
    });
</script>
@endsection
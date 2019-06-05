@extends('layouts.app')

@section('site-name','Sistem Informasi SPP')
@section('page-name', (isset($siswa) ? 'Ubah Siswa' : 'Siswa Baru'))

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ (isset($siswa) ? route('siswa.update', $siswa->id) : route('siswa.create')) }}" method="post" class="card">
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
                                <label class="form-label">Kelas</label>
                                <select id="select-beast" class="form-control custom-select" name="kelas_id">
                                    @foreach($kelas as $item)
                                        <option value="{{ $item->id }}" {{ isset($siswa) ? ($item->id == $siswa->kelas_id ? 'selected' : '') : '' }}>{{ $item->nama }} - {{ isset($item->periode) ? $item->periode->nama : '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="{{ isset($siswa) ? $siswa->nama : old('nama') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tempat, Tanggal Lahir</label>
                                <div class="row gutters-xs">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ isset($siswa) ? $siswa->tempat_lahir : old('tempat_lahir') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" data-toggle="datepicker" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ isset($siswa) ? $siswa->tanggal_lahir : old('tanggal_lahir') }}">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <select id="select-beast" class="form-control custom-select" name="jenis_kelamin">
                                    <option value="L" {{ isset($siswa) ? ($siswa->jenis_kelamin == 'L' ? 'selected' : '') : '' }}>Laki - Laki</option>
                                    <option value="P" {{ isset($siswa) ? ($siswa->jenis_kelamin == 'P' ? 'selected' : '') : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat">{{ isset($siswa) ? $siswa->alamat : old('alamat') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Wali</label>
                                <input type="text" class="form-control" name="nama_wali" placeholder="Nama Lengkap" value="{{ isset($siswa) ? $siswa->nama_wali : old('nama_wali') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Telp. Wali</label>
                                <input type="text" class="form-control" name="telp_wali" placeholder="Nomor Telp. Lengkap" value="{{ isset($siswa) ? $siswa->telp_wali : old('telp_wali') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pekerjaan Wali</label>
                                <input type="text" class="form-control" name="pekerjaan_wali" placeholder="Pekerjaan Wali" value="{{ isset($siswa) ? $siswa->pekerjaan_wali : old('pekerjaan_wali') }}">
                            </div>
                            <div class="form-group">
                                <div class="form-label">Status</div>
                                <label class="custom-switch">
                                <input type="checkbox" name="is_yatim" value="1" class="custom-switch-input" {{ isset($siswa) ? ($siswa->is_yatim ? 'checked' : '') : '' }}>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Anak Yatim Piatu</span>
                                </label>
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
    require(['jquery', 'selectize','datepicker'], function ($, selectize) {
        $(document).ready(function () {

            $('.custom-select').selectize({});
            $('[data-toggle="datepicker"]').datepicker({
                format: 'yyyy-MM-dd'
            });
        });
    });
</script>
@endsection
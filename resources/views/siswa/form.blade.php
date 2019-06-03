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
                    <div class="row">
                        <div class="col-12">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Kelas</label>
                                <select class="form-control" name="kelas_id">
                                    <option value="1">TKA</option>
                                    <option value="2">TKB</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tempat, Tanggal Lahir</label>
                                <div class="row gutters-xs">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" data-toggle="datepicker" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <select id="select-beast" class="form-control custom-select" name="jenis_kelamin">
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Wali</label>
                                <input type="text" class="form-control" name="nama_wali" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Telp. Wali</label>
                                <input type="text" class="form-control" name="telp_wali" placeholder="Nomor Telp. Lengkap">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pekerjaan Wali</label>
                                <input type="text" class="form-control" name="pekerjaan_wali" placeholder="Pekerjaan Wali">
                            </div>
                            <div class="form-group">
                                <div class="form-label">Status</div>
                                <label class="custom-switch">
                                <input type="checkbox" name="is_yatim" class="custom-switch-input">
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

            $('#select-beast').selectize({});
            $('[data-toggle="datepicker"]').datepicker({
                format: 'dd/MM/yyyy'
            });
        });
    });
</script>
@endsection
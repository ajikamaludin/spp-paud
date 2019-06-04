@extends('layouts.app')

@section('site-name','Sistem Informasi SPP')
@section('page-name','Import Siswa'))

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ route('siswa.import') }}" method="post" class="card" enctype="multipart/form-data">
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
                                <div class="form-label">File (Excel, xls, xlsx)</div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, *.csv">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <small class="mt-4">unduh contoh file <a href="{{ asset('siswa.xlsx') }}" download>disini</a> </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-link">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
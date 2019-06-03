@extends('layouts.app')

@section('site-name','Sistem Informasi SPP')
@section('page-name','Periode')

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
                    <h3 class="card-title">@yield('page-name')</h3>
                    <a href="{{ route('periode.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah Periode</a>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Nama</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aktif</th>
                            <th></th> 
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($periode as $item)
                            <tr>
                                <td><span class="text-muted">{{ $item->id }}</span></td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    {{ $item->tgl_mulai }}
                                </td>
                                <td>
                                    {{ $item->tgl_selesai }}
                                </td>
                                <td>
                                    {{ $item->is_active }}
                                </td>
                                <td>
                                    <a class="icon" href="javascript:void(0)" title="edit item">
                                        <i class="fe fe-edit"></i>
                                    </a>
                                    <a class="icon" href="javascript:void(0)" title="delete item">
                                        <i class="fe fe-trash"></i>
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
                            {{ $periode->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
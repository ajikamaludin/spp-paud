@extends('layouts.app')

@section('site-name','Sistem Informasi SPP')
@section('page-name','Siswa')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('page-name')
        </h1>
        <div class="page-options d-flex">
            <div class="input-icon ml-2">
                <span class="input-icon-addon">
                    <i class="fe fe-search"></i>
                </span>
                <input type="text" class="form-control w-10" placeholder="Cari Siswa">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                    <a href="{{ route('siswa.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah Siswa</a>
                    <div class="card-options">
                        <a href="#" class="btn btn-primary btn-sm">Import</a>
                        <a href="#" class="btn btn-secondary btn-sm ml-2">Export</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Nama</th>
                            <th>Wali</th>
                            <th>Telp. Wali</th>
                            <th>Yatim</th>
                            <th></th> 
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($siswa as $item)
                            <tr>
                                <td><span class="text-muted">{{ $item->id }}</span></td>
                                <td>
                                    <a href="" class="link-unmuted">
                                        {{ $item->nama }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->nama_wali }}
                                </td>
                                <td>
                                    {{ $item->telp_wali }}
                                </td>
                                <td>
                                    {{ $item->is_yatim }}
                                </td>
                                <td>
                                    <a class="icon" href="javascript:void(0)" title="lihat detail">
                                        <i class="fe fe-eye"></i>
                                    </a>
                                    <a class="icon" href="javascript:void(0)" title="edit item">
                                        <i class="fe fe-edit"></i>
                                    </a>
                                    <a class="icon btn-delete" href="#!" data-id="{{ $item->id }}" title="delete item">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                    <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" id="form-{{ $item->id }}">
                                        @csrf 
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            {{ $siswa->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    require(['jquery', 'sweetalert'], function ($, sweetalert) {
        $(document).ready(function () {

            $(document).on('click','.btn-delete', function(){
                formid = $(this).attr('data-id');
                swal({
                    title: 'Are you sure to delete?',
                    text: 'items that have been deleted cannot be returned',
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

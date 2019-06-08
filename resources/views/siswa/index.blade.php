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
                
                <form action="" method="GET">
                    <span class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </span>
                    <input type="text" class="form-control w-10" placeholder="Cari Siswa, masukan nama" name="q">
                </form>
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
                        <a href="{{ route('siswa.showimport') }}" class="btn btn-primary btn-sm">Import</a>
                        <a href="{{ route('siswa.export') }}" class="btn btn-secondary btn-sm ml-2" download="true">Export</a>
                    </div>
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
                <div class="table-responsive">
                    <table class="table card-table table-hover table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Wali</th>
                            <th>Telp. Wali</th>
                            <th>Yatim</th>
                            <th></th> 
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($siswa as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td> {{ $item->kelas->nama }}{{ isset($item->kelas->periode) ? "(".$item->kelas->periode->nama.")" : ''}}</td>
                                <td>
                                    <a href="{{ route('siswa.show', $item->id) }}" class="link-unmuted">
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
                                    @if($item->is_yatim)
                                        <span class="tag tag-green">Yatim</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="icon" href="{{ route('siswa.show', $item->id) }}" title="lihat detail">
                                        <i class="fe fe-eye"></i> 
                                    </a>
                                    <a class="icon" href="{{ route('siswa.edit', $item->id) }}" title="edit item">
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

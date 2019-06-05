@extends('layouts.app')

@section('site-name','Sistem Informasi SPP')
@section('page-name','Kelas')

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
                    <a href="{{ route('kelas.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah Kelas</a>
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
                            <th>Periode</th>
                            <th>Nama</th>
                            <th></th> 
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($kelas as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>{{ isset($item->periode) ? $item->periode->nama : '-' }}</td>
                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td class="text-center">
                                    <a class="icon" href="{{ route('kelas.edit', $item->id) }}" title="edit item">
                                        <i class="fe fe-edit"></i>
                                    </a>
                                    <a class="icon btn-delete" href="#!" data-id="{{ $item->id }}" title="delete item">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                    <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" id="form-{{ $item->id }}">
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
                            {{ $kelas->links() }}
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
                    title: 'Anda yakin ingin menghapus?',
                    text: 'kelas yang dihapus tidak dapat dikembalikan',
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
@extends('layouts.app')

@section('page-name','Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <iframe src="{{ asset('manualbook.pdf') }}" frameborder="0" class="col-12" style="min-height: 800px"></iframe>
        </div>
    </div>
@endsection
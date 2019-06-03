@extends('layouts.app')

@section('site-name','Sistem Informasi SPP')
@section('page-name','PAUD')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            Dashboard
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Invoices</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Invoice Subject</th>
                        <th>Client</th>
                        <th>VAT No.</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span class="text-muted">001401</span></td>
                        <td><a href="invoice.html" class="text-inherit">Design Works</a></td>
                        <td>
                        Carlson Limited
                        </td>
                        <td>
                        87956621
                        </td>
                        <td>
                        15 Dec 2017
                        </td>
                        <td>
                        <span class="status-icon bg-success"></span> Paid
                        </td>
                        <td>$887</td>
                        <td class="text-right">
                        <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                        </div>
                        </td>
                        <td>
                        <a class="icon" href="javascript:void(0)">
                            <i class="fe fe-edit"></i>
                        </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection
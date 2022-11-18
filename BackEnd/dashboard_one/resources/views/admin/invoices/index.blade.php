@extends('admin.master')

@section('title', 'All Invoices | ' . env('APP_NAME'))

@section('styles')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <style>
        .table th,
        .table td {
            vertical-align: middle
        }
    </style>

@stop

@section('content')
    <!-- Page Heading -->


    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">All Invoices</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-primary">Invoices</h4>
                    <a href="" class="btn btn-sm btn-primary">
                        Add New Invoices
                    </a>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Number</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-primary">
                                       print
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    {{-- {{ $posts->appends(['search' => request()->search, 'count' => request()->count])->links() }} --}}
{{--    {{ $posts->appends($_GET)->links() }}--}}
@stop

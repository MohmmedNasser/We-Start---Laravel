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
        <div class="card">
            <div class="card-header">
                All User
            </div>

            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Data of Birth</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>  {{ $user->id }}  </td>
                            <td>  {{  $user->name }}  </td>
                            <td>  {{  $user->email  }} </td>
                            <td>  {{  $user->profile->image  }} </td>
                            <td> {{  $user->profile->date_of_birth  }} </td>

{{--                            <td> {{ $user->profile ? $user->profile->image : "" }} </td>--}}
{{--                            <td> {{ $user->profile->image ?? "" }} </td>--}}
{{--                            <td> {{ $user->profile ? $user->profile->date_of_birth : "" }} </td>--}}
{{--                            <td> {{ $user->profile->date_of_birth ?? "" }} </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>


@stop


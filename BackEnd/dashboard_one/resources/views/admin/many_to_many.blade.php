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
        <div class="card mb-4">
            <div class="card-header">
                Welcome {{ $std->name }}
            </div>

{{--            @dump($std->courses->find(1))--}}

            <div class="card-body">

                <form action="{{ route('admin.many_to_many') }}" method="post">
                    @csrf

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Hours</th>
                            <th>Mark</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>
                                    <input @checked($std->courses->find( $course->id )) type="checkbox" name="courses[]" value=" {{ $course->id }} ">
                                    {{ $course->id }}
                                </td>
                                <td> {{ $course->name }} </td>
                                <td> {{ $course->hours }} </td>
                                <td>
                                    <input  type="text" class="form-control" name="marks[{{ $course->id }}][mark]" placeholder="Mark">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-5">
                        <button class="btn btn-success">
                            Register
                        </button>
                    </div>

                </form>

            </div>

        </div>



    </div>



@stop

@section('scripts')

@endsection


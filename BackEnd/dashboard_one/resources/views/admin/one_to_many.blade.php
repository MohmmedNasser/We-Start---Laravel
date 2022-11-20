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
                All Posts
            </div>

            <div class="card-body">

                <h2>{{ $post->title }}</h2>
                <p>
                    {{ $post->content }}
                </p>
                <hr>
{{--                <span class="d-flex pb-2">Post Comments ({{ $post->comments->count() }}):</span>--}}
                <span class="d-flex pb-2">Post Comments ({{ $post->comments_count }}):</span>
                <div class="px-4 border-left">
                    @foreach($post->comments as $comment)
                        <div class="mb-2">
                            <small>
                                {{  $comment->user->name }} | {{ $comment->created_at->diffForHumans() }}
                            </small>
                            <h6>
                                {{  $comment->content  }}
                            </h6>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

        <div class="card">
            <div class="card-body">
                <form action="">

                </form>
            </div>
        </div>

    </div>



@stop


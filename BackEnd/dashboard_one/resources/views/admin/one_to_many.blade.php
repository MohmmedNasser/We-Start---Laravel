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
                <div class="px-4 border-left" id="comment_box">
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
                <form id="post_comment" action=" {{ route('admin.add_comment') }} " method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div>
                        <textarea name="content" class="form-control" rows="4"></textarea>
                        <button class="btn btn-primary mt-4">
                            Save
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>



@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

    <script>
        let form = document.querySelector('#post_comment');
        let comment_box = document.querySelector('#comment_box');

        form.onsubmit = function (e) {
            e.preventDefault();

            const data = new FormData(this);
            const url = form.action;
            axios.post(url, data)
                .then(res => {
                    let template = `
                       <div class="mb-2">
                            <small>
                                ${res.data.user.name} | ${res.data.created_at}
                            </small>
                            <h6>
                              ${res.data.content}
                            </h6>
                        </div>`;


                    comment_box.innerHTML += template;

                })

            form.reset();

        }
    </script>
@endsection


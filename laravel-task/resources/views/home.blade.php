@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">
                        {{ __('Add New Post') }}
                    </div>

                    <div class="card-body">
                        @include('addPost')
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        {{ __('All Posts') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($posts as $post)
                            <div class="card mb-3" style="width:100%">
                                <div class="row g-0">
                                    @if ($post->image)
                                        <div class="col-md-4">
                                            <img src="{{ asset('assets/posts/images/' . $post->image) }}"
                                                class="img-fluid rounded-start" alt="...">
                                        </div>
                                    @endif
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $post->title }}</h5>
                                            </h5>
                                            <p class="card-text">{{ $post->content }}</p>
                                            <p class="card-text"><small
                                                    class="text-muted">{{ $post->created_at }}</small></p>
                                            <a class="text-success" href="{{url('/post/edit/'.$post->id )}}"> <i class="bi bi-pencil-square"></i> Edit</a>
                                            <a class="text-danger" href="{{url('/post/delete/'.$post->id )}}"> <i class="bi bi-trash3-fill"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

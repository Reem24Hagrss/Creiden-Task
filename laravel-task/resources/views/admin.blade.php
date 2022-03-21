@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

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
                                            <h5 class="card-title text-primary"><small> by {{ $post->name }}</small>
                                            </h5>
                                            <p class="card-text">{{ $post->content }}</p>
                                            <p class="card-text"><small
                                                    class="text-muted">{{ $post->created_at }}</small></p>
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

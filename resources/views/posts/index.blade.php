@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @foreach($posts as $post)
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">{{ $post->category->category_name }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">{{ $post->user->name }}</h6>
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細を見る</a>
          </div>
        </div>
    @endforeach
@endsection

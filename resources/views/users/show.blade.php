@extends('layouts.app')

@section('content')
<div class="card-header">{{ $user->name }}の投稿</div>

<div class="card-body">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        @foreach($user->posts as $post)
              <div class="card-body">
                <h3 class="card-title">{{ $post->title }}</h3>
                <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at }}</h6>
                <h6 class="card-subtitle mb-2 text-muted">
                    <a href="{{ route('posts.index', ['category_id' => $post->category_id]) }}">
                        {{ $post->category->category_name }}
                    </a>
                </h6>
                <h6 class="card-subtitle mb-2 text-muted">
                    <a href="{{ route('users.show', $post->user_id) }}">
                        {{ $post->user->name }}
                    </a>
                </h6>
                <p class="card-text">{{ $post->content }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細を見る</a>
              </div>
        @endforeach
    </div>
</div>

@endsection

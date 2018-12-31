@extends('layouts.app')

@section('content')
<div class="card-header">board</div>

<div class="card-body">
    @isset($search_result)
        <h5 class="card-title">{{ $search_result }}</h5>
    @endisset

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
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
        </div>
    </div>
    
    <div class="p-3">
        <h3 class="card-title">コメント一覧</h3>
        @foreach($post->comments as $comment)
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $comment->comment }}</p>
                    <p class="card-text">
                        投稿者:
                        <a href="{{ route('users.show', $comment->user->id) }}">
                            {{ $comment->user->name }}
                        </a>
                    </p>
                </div>
            </div>
        @endforeach
        <a href="{{ route('comments.create', ['post_id' => $post->id]) }}" class="btn btn-primary">コメントする</a>
    </div>
</div>
@endsection

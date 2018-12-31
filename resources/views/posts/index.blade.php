@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-title">search field</h5>
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <form action="{{ route('posts.search') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" class="form-control input-lg" placeholder="search" name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-info " type="submit" style="position: relative;top: -37px;right: -179px;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
        @foreach($posts as $post)
              <div class="card-body">
                <h3 class="card-title">{{ $post->title }}</h3>
                <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at }}</h6>
                <h6 class="card-subtitle mb-2 text-muted">
                    カテゴリー:
                    <a href="{{ route('posts.index', ['category_id' => $post->category_id]) }}">
                        {{ $post->category->category_name }}
                    </a>
                </h6>
                <h6 class="card-subtitle mb-2 text-muted">
                    投稿者:
                    <a href="{{ route('users.show', $post->user_id) }}">
                        {{ $post->user->name }}
                    </a>
                </h6>
                <p class="card-text">{{ $post->content }}</p>
                <a href="{{ route('comments.create') }}" class="btn btn-primary">詳細を見る</a>
              </div>
        @endforeach
    </div>

    @if(isset($search_result))
        @if(isset($search_flag) && $search_flag == true)
            {{ $posts->appends(['category_id' => $posts[0]->category_id])->links() }}
        @else
            {{ $posts->appends(['category_id' => $posts[0]->category_id])->links() }}
        @endif

    @elseif(isset($search_result) && $search_flag == false)
        {{ $posts->links() }}
    @else
        {{ $posts->links() }}
    @endif
</div>

@endsection

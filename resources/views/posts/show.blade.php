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
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ $post->content }}</p>

      </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')

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
@endsection

@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    <div class="d-flex justify-content-center">
      <div class="col-8">
        @include('users.user')
        @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])
      </div>
    </div>
    @foreach($articles as $article)
      @include('articles.card')
    @endforeach
 
  </div>
@endsection

@extends('layouts.base')
@section('header')
<header class="border-bottom lh-1 py-3">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 ps-4">
      <a class="text-body-emphasis text-decoration-none fs-3" href="{{ route('blog') }}">{{ env('APP_NAME')}}</a>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-end pt-2">
      @auth('web')
      <a class="btn btn-sm btn-outline-secondary mx-3" href="{{ route('dashboard') }}">Таблица</a>
      <a class="btn btn-sm btn-outline-secondary mx-3" href="{{ route('logout') }}">Выйти</a>
      @endauth
      @guest('web')
      <a class="btn btn-sm btn-outline-secondary mx-3" href="{{ route('login') }}">Войти</a>
      <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">Зарегистрироваться</a>
      @endguest
    </div>
  </div>
</header>
@endsection

@section('main')

<main>
<div class="container-fluid p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
  <div class="row">
    <div class="col-10 mx-auto">
      <a href="{{ route('blog', ['id' => ($post[0]['supplier_id'] * 1024)]) }}">Обратно</a>
      <h3 class="mb-3">{{'Автор: '. $post[0]['supplier_name'] ?? ''}}</h3>
      <h1>{{$post[0]['title'] ?? 'Пост не найден....'}}</h1>
      <p>{{$post[0]['content'] ?? ''}}</p>
    </div>
  </div>
</div>
@endsection 

@section('footer')
<footer class="py-5 text-center text-body-secondary bg-body-tertiary border">
<p>© {{ year_now() }}, {{ env('APP_NAME') }}</p>
</footer>
@endsection
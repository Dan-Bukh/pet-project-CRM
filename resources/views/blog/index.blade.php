@extends('layouts.base')
@section('header')
<div class="container-fluid">
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
<main class="container">
<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
  <div class="row">
    <div class="col-lg-8 px-0">
      <h1 class="display-4 fst-italic">{{ !$user_name ? 'Сайт ведения учета своих клиентов' : $user_name->value('name') }}</h1>
      <p class="lead my-3">{{ !$user_name ? 'Управляйте своими клиентами быстро и качественно' : $user_name->value('status')}}</p>
    </div>
    @if($user_name)
    <div class="col-lg-4 mt-5">
      <a href="{{ route('blog.order', $user_name->value('id')) }}" type="button" class="btn btn-primary btn-lg d-flex justify-content-center">Записаться на прием</a>
    </div>
    @endif
  </div>

</div>

<div class="row mb-2">
  @if($user_name)
    {{-- @for($i=1;$i<2;$i++)
      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-lg h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0 mt-2">Что делать, если выпала пломба из зуба? </h3>
            <div class="mb-1 text-body-secondary">Nov 1{{$i}}</div>
            <a href="{{ route('blog.show', 123) }}" class="icon-link gap-1 icon-link-hover stretched-link">
            Continue reading
            </a>
          </div>
        </div>
      </div>
    @endfor --}}

      <div class="row">
        <div class="col-sm-10 col-md-6">
          @foreach($posts as $post)

              @if(($user['id'] ?? null) == $user_name->value('id'))
                <a href="{{ route('blog.edit', $post->id) }}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg>
                </a>
              @endif

              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-lg h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <h3 class="mb-0 mt-2">{{$post->title}}</h3>
                  <div class="my-2 text-body-secondary">{{$post->created_at->diffForHumans()}}</div>
                  <a href="{{ route('blog.show', $post->id) }}" class="icon-link gap-1 icon-link-hover stretched-link">
                  Продолжить Читать
                  </a>
                </div>
              </div>
          @endforeach
        </div>

        @if(($user['id'] ?? null) == $user_name->value('id'))
          <div class="col-4 d-flex justify-content-start">
            <a href="{{ route('blog.create') }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
              </svg>
            </a>
          </div>
        @endif
      </div>

  @endif
</div>
@endsection 

@section('footer')
<footer class="py-5 text-center text-body-secondary bg-body-tertiary border">
<p>© {{ year_now() }}, {{ env('APP_NAME') }}</p>
</footer>
@endsection
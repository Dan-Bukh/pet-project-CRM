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
        <form action="{{ route('blog.store') }}" method="POST">
          @method('POST')
          @csrf
            @error('success')
              <div class="alert alert-success fs-5" role="alert">
                  {{ $message }}
              </div>
            @enderror
          <a href="{{ route('blog', ['id' => ($user['id'] * 1024)]) }}">Обратно</a>
          <h3 class="mb-3">{{'Автор: '. $user['name'] ?? ''}}</h3>
          <input name="id" type="hidden" class="form-control" value="{{ $user['id'] }}">
          <input name="name" type="hidden" class="form-control" value="{{ $user['name'] }}">
          <div class="form-floating mb-3">
            <input name="title" class="form-control" id="floatingInput">
            <label for="floatingInput">Заголовок</label>
          </div>

          <div class="form-floating mb-3">
            <textarea name="content" class="form-control" id="floatingTextarea2" style="height: 220px"></textarea>
            <label for="floatingTextarea2">Контент</label>
          </div>

          <button class="btn btn-primary w-30 mt-2 py-2" type="submit">Создать</button>
          <p class="my-3 text-body-secondary">&copy; 2017–{{ year_now() }}</p>
      </form>
    </div>
  </div>
</div>
@endsection 

@section('footer')
<footer class="py-5 text-center text-body-secondary bg-body-tertiary border">
<p>© {{ year_now() }}, {{ env('APP_NAME') }}</p>
</footer>
@endsection
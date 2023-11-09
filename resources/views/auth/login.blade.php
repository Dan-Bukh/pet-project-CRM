@extends('layouts.base')
@section('main')
<div class="container">
    <main class="form-signin w-100 m-auto">
        <div class="d-flex justify-content-center row">
            <div class="col-lg-4 col-md-4 col-sm-9">
                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    <h1 class="h3 mt-5 mb-3 fw-normal">Пожалуйста Идентифицируйтесь</h1>

                      @error('email')
                      <p class="text-danger m-0">{{ $message }}</p>
                      @enderror
                    <div class="form-floating mb-3">
                      <input name="email" type="email" class="form-control @error('email') bg-danger-subtle @enderror" id="floatingInput" placeholder="name@example.com">
                      <label for="floatingInput">Почта</label>
                    </div>

                    <div class="form-floating">
                      <input name="password" type="password" class="form-control @error('email') bg-danger-subtle @enderror" id="floatingPassword" placeholder="Password">
                      <label for="floatingPassword">Пароль</label>
                    </div>

                    <button class="btn btn-primary w-100 mt-2 py-2" type="submit">Войти</button>
                    <p class="my-3 text-body-secondary">&copy; 2017–2023</p>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection
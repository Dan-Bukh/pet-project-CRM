@extends('layouts.base')
@section('main')

<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">{{ env('APP_NAME') }}</a>
  
    <div id="navbarSearch" class="navbar-search w-100 collapse">
      <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div>
  </header>
  
  <div class="container-fluid">
    <div class="row">
      <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">{{ env('APP_NAME') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 active" href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                    </svg>
                  Клиенты
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 active" href="{{ route('blog', ['id' => ($customer[0]['supplier_id'] * 1024)] ) }}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-heading" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                  </svg>
                  Блог
                </a>
              </li>
            </ul>
            <ul class="nav flex-column mb-auto">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ route('logout') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-closed" viewBox="0 0 16 16">
                        <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
                        <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
                    </svg>
                  Выйти
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
  
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2>Клиенты: {{$customer[0]['supplier_name'] ?? ''}}</h2>
        <div class="table-responsive small">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Имя Поставшика</th>
                <th scope="col">Специальность</th>
                <th scope="col">Имя Клиента</th>
                <th scope="col">Почта</th>
                <th scope="col">Номер</th>
                <th scope="col">Комментарий</th>
                <th scope="col">Время Приема</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="{{ route('dashboard.update', $customer[0]['id']) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <td>{{$customer[0]['id']}}</td>
                    <td>{{$customer[0]['supplier_name']}}</td>
                    <td>{{$customer[0]['speciality']}}</td>
                    <td><input name="customer_name" class="form-control @error('FIO') is-invalid @enderror" value="{{$customer[0]['customer_name']}}">
                      @error('FIO')
                      <p class="text-danger m-0">{{ $message }}</p>
                      @enderror</td>

                    <td><input name="email" class="form-control @error('email') is-invalid @enderror" value="{{$customer[0]['email']}}">
                      @error('email')
                      <p class="text-danger m-0">{{ $message }}</p>
                      @enderror</td>

                    <td><input name="number" class="form-control @error('number') is-invalid @enderror" value="{{$customer[0]['number']}}">
                      @error('number')
                      <p class="text-danger m-0">{{ $message }}</p>
                      @enderror</td>

                      <td><input name="comment" class="form-control @error('comment') is-invalid @enderror" value="{{$customer[0]['comment']}}">
                        @error('comment')
                        <p class="text-danger m-0">{{ $message }}</p>
                        @enderror</td>

                    <td><input name="time" class="form-control @error('time') is-invalid @enderror" value="{{$customer[0]['time']}}">
                      @error('time')
                      <p class="text-danger m-0">Время должно соответствовать формату Г.м.д Ч.м.с</p>
                      @enderror</td>
                    <td><button class="btn btn-primary" href="">Отредактировать</button></td>
                   </form>
                </tr>
            </tbody>
          </table>
          <form action="{{ route('dashboard.destroy', $customer[0]['id']) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" href="">Удалить</button>
          </form>
        </div>
      </main>
    </div>
  </div>
@endsection
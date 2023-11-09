@extends('layouts.base')
@section('main')
<div class="container">
    <main class="form-signin w-100 m-auto">
        <a href="{{ route('blog', ['id' => ($id * 1024)]) }}">Вернуться к профилю</a>   
        <div class="d-flex justify-content-center row">
            <div class="col-lg-4 col-md-4 col-sm-9">
                <form action="{{ route('blog.order.store') }}" method="POST">
                    @method('POST')
                    @csrf
                        @error('order_send')
                            <div class="alert alert-success fs-5" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    <h1 class="h3 mt-5 mb-3 fw-normal">Запись на прием</h1>
                    <input name="id" type="hidden" class="form-control" value="{{ $user[0]['id'] }}">
                    <input name="supplier_name" type="hidden" class="form-control" value="{{ $user[0]['name'] }}">
                    <input name="speciality" type="hidden" class="form-control" value="{{ $user[0]['status'] }}">
                    <div class="form-floating mb-3">
                        <input class="form-control bg-primary-subtle" id="floatingInput" value="{{ $user[0]['name'] }}" disabled>
                    </div>
                        @error('FIO')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    <div class="form-floating mb-3">
                      <input name="name" class="form-control @error('FIO') bg-danger-subtle @enderror" id="floatingInput" placeholder="name@example.com">
                      <label for="floatingInput">Ваше Ф.И.О</label>
                    </div>

                    <div class="form-floating  mb-3">
                        <input name="email" type="email" class="form-control @error('email') bg-danger-subtle @enderror" id="floatingPassword" placeholder="emaik">
                        <label for="floatingPassword">Почта</label>
                    </div>

                    <div class="form-floating  mb-3">
                        <input name="number" class="form-control @error('number') bg-danger-subtle @enderror" id="floatingPassword" value="+7" placeholder="number">
                        <label for="floatingPassword">Телефон</label>
                      </div>

                    {{-- <div class="form-floating  mb-3">
                      <input name="password" class="form-control @error('email') bg-danger-subtle @enderror" id="floatingPassword" value="8:00" placeholder="Password">
                      <label for="floatingPassword">Желаемый час приема</label>
                    </div> --}}
                    <select name="time_order" class="form-select" aria-label="Default select example">
                        <option value="0" selected>Желаемый час приема</option>
                        <option value="8">8:00</option>
                        <option value="9">9:00</option>
                        <option value="10">10:00</option>
                        <option value="11">11:00</option>
                        <option value="12">12:00</option>
                        <option value="13">13:00</option>
                        <option value="14">14:00</option>
                        <option value="15">15:00</option>
                        <option value="16">16:00</option>
                        <option value="17">17:00</option>
                        <option value="18">18:00</option>
                        <option value="19">19:00</option>
                      </select>
                    <button class="btn btn-primary w-100 mt-2 py-2" type="submit">Записаться</button>
                </form>   
            </div>
        </div>
    </main>
</div>
@endsection
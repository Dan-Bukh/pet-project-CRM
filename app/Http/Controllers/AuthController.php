<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthUserService;

class AuthController extends Controller
{
    public function register() 
    {
        return view('auth.register');
    }

    public function register_store(RegisterUserRequest $request, AuthUserService $service) 
    {
        $route = $service->register($request);
        return redirect(route($route));
    }

    public function login() 
    {
        return view('auth.login');
    }

    public function login_store(LoginUserRequest $request) 
    {
        if(auth('web')->attempt($request->validated())){
            $user = auth('web')->user();
            return redirect(route('blog', ['id' => $user['id']] ));
        }
        return redirect(route('login'))->withErrors(['email' => 'Неправильное Имя пользователя или Пароль']);
    }

    public function logout() 
    {
        auth('web')->logout();
        return redirect(route('blog'));
    }
}


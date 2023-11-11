<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register() 
    {
        return view('auth.register');
    }

    public function register_store(RegisterUserRequest $request) 
    {
        if(validate_fio($request['name'])) {
            //return redirect(route('register'))->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);
            return back()->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);
        };
        
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'email_verified_at' => now(),
            'status' => $request['status'],
            'password' => Hash::make($request['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if($user){
            // auth('web')->login($user);
            return redirect(route('login'));
        }

        return redirect(route('blog'));
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


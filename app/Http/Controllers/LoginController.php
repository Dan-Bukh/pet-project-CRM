<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register() 
    {
        return view('auth.register');
    }

    public function register_store(Request $request) 
    {
        $validated = $request->validate([
        'name' => ['required' ,'string', 'max:40'],
        'status' => ['required' ,'string', 'max:50'],
        'email' => ['required' ,'string', 'email', 'max:50', 'unique:users,email'],
        'password' => ['required' ,'string', 'max:50', 'confirmed'],
        ]);

        if(validate_fio($validated['name'])) {
            //return redirect(route('register'))->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);
            return back()->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);
        };
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'status' => $validated['status'],
            'password' => Hash::make($validated['password']),
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

    public function login_store(Request $request) 
    {
        $validated = $request->validate([
        'email' => ['required' ,'string', 'email', 'max:50'],
        'password' => ['required' ,'string', 'max:50'],
        ]);

        if(auth('web')->attempt($validated)){
            $user = auth('web')->user();
            return redirect(route('blog', ['id' => ($user['id'] * 1024)] ));
        }

        return redirect(route('login'))->withErrors(['email' => 'Неправильное Имя пользователя или Пароль']);
    }

    public function logout() 
    {
        auth('web')->logout();
        return redirect(route('blog'));
    }
}


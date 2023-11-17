<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthUserService 
{
    public function register($request) 
    {
        if(validate_fio($request['name'])) { return back()->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);};
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'email_verified_at' => now(),
            'status' => $request['status'],
            'password' => Hash::make($request['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $user ? 'login' : 'blog';
    }
}
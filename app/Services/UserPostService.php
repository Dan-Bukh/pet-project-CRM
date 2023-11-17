<?php 

namespace App\Services;

use App\Models\Customer;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class UserPostService 
{

    public function index($request) {
        $user = auth('web')->user();
        if($request->has('id')) {
            $user_name = User::query()->where('id', $request['id'])->get(['id','name', 'status']);
            if($user_name->containsOneItem()) {
                $posts = Post::query()->where('supplier_id', $request['id'])->get(['id', 'title', 'created_at']);
                return $compact = compact('user', 'user_name', 'posts');
            }
        }
        $user_name = false;
        return compact('user', 'user_name');
    }

    public function show($post) 
    {
        $post = Post::query()->where('id', $post)->get();
        if($post->containsOneItem()) {
            return compact('post');
        } else {
            return abort(404);
        }
    }

    public function order($request) : void 
    {
        Customer::create([
            'supplier_id' => $request['id'],
            'supplier_name' => $request['supplier_name'],
            'speciality' => $request['speciality'],
            'customer_name' => $request['name'],
            'email' => $request['email'],
            'number' => $request['number'],
            'comment' => 'В Ожидании Подтверждения',
            'time' => Carbon::create(now()->format('Y'), now()->format('m'), (now()->format('d') + 1), $request['time_order'], 00, 00),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function post_store($request) 
    {
        if(auth('web')->id() == $request['id']) {
            Post::create([
                'supplier_id' => $request['id'],
                'supplier_name' => $request['name'],
                'title' => $request['title'],
                'content' => $request['content'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return 'Пост создан успешно.';
        }
        return 'Что то пошло не так.';
    }

    public function post_edit($id) 
    {
        $post = Post::query()->where('id', $id)->get();
        $user = auth('web')->user();
        if(($post[0]['supplier_id'] ?? null) == $user->id) {
            return compact('user', 'post');
        } else {
            abort(404);
        }
    }

}
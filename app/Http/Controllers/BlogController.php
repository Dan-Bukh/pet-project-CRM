<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyPostRequest;
use App\Http\Requests\IndexUserRequest;
use App\Http\Requests\OrderCustomerRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Customer;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(IndexUserRequest $request) 
    {
        $user = auth('web')->user();
        $user_name = null;
        if($request->has('id')) {
            $user_name = User::query()->where('id', $request['id'])->get(['id','name', 'status']);
            if($user_name->containsOneItem()) {
                $posts = Post::query()->where('supplier_id', $request['id'])->get(['id', 'title', 'created_at']);
                return view('blog.index', compact('user', 'user_name', 'posts'));
            }
        }
        
        return view('blog.index', compact('user', 'user_name'));
    }

    public function show($post) 
    {

        $post = Post::query()->where('id', $post)->get();

        if(($post[0] ?? false) == true) {
            return view('blog.show', compact('post'));
        } else {
            abort(404);
        }
    }

    public function order($id) 
    {
        $user = User::query()->where('id', $id)->get(['name', 'id', 'status']);
        return view('blog.order', compact('id' ,'user'));
    }

    public function order_store(OrderCustomerRequest $request) 
    {
        if(validate_fio($request['name'])) {
            return back()->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);
        };
        $time = Carbon::now();

        Customer::query()->insertOrIgnore([
            'supplier_id' => $request['id'],
            'supplier_name' => $request['supplier_name'],
            'speciality' => $request['speciality'],
            'customer_name' => $request['name'],
            'email' => $request['email'],
            'number' => $request['number'],
            'comment' => 'В Ожидании Подтверждения',
            'time' => Carbon::create($time->format('Y'), $time->format('m'), ($time->format('d') + 1), $request['time_order'], 00, 00),
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        
        return back()->withErrors(['order_send' => 'Заявка направлена успешно, Ожидайте ответа специалиста.']);
    }

    public function post_create() 
    {

        $user = auth('web')->user();

        return view('blog.create', compact('user'));
    }

    public function post_store(StorePostRequest $request) 
    {
        if(auth('web')->id() == $request['id']) {
            Post::query()->insertOrIgnore([
                'supplier_id' => $request['id'],
                'supplier_name' => $request['name'],
                'title' => $request['title'],
                'content' => $request['content'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    
            return back()->withErrors(['success' => 'Пост создан успешно.']);
        }
        return back()->withErrors(['success' => 'Что то пошло не так.']);
    }

    public function post_edit($id) {
        $post = Post::query()->where('id', $id)->get();
        $user = auth('web')->user();
        if(($post[0]['supplier_id'] ?? null) == $user->id) {
            return view('blog.edit', compact('user', 'post'));
        } else {
            abort(404);
        }
    }

    public function post_update(UpdatePostRequest $request, $id) {
        Post::query()->where('id', $id)->update([
            'title' => $request['title'],
            'content' => $request['content'],
        ]);

        return back()->withErrors(['success' => 'Пост изменен успешно.']);
    }

    public function post_destroy(DestroyPostRequest $request, $id) 
    {
        Post::query()->where('id', $id)->delete();
        return redirect()->route('blog', ['id' => $request['id']]);
    }
}

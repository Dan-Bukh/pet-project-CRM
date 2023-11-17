<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyPostRequest;
use App\Http\Requests\IndexUserRequest;
use App\Http\Requests\OrderCustomerRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\UserPostService;

class BlogController extends Controller
{
    public function index(IndexUserRequest $request, UserPostService $service) 
    {
        $compact = $service->index($request);
        return view('blog.index', $compact);
    }

    public function show($post,  UserPostService $service) 
    {
        $compact = $service->show($post);
        return view('blog.show', $compact);
    }

    public function order($id) 
    {
        $user = User::query()->where('id', $id)->get(['name', 'id', 'status']);
        return view('blog.order', compact('id' ,'user'));
    }

    public function order_store(OrderCustomerRequest $request, UserPostService $service) 
    {   
        if(validate_fio($request['name'])) {return back()->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);}
        $service->order($request);
        return back()->withErrors(['order_send' => 'Заявка направлена успешно, Ожидайте ответа специалиста.']);
    }

    public function post_create() 
    {
        $user = auth('web')->user();
        return view('blog.create', compact('user'));
    }

    public function post_store(StorePostRequest $request, UserPostService $service) 
    {
        $message = $service->post_store($request);
        return back()->withErrors(['success' => $message]);
    }

    public function post_edit($id, UserPostService $service) {
        $compact = $service->post_edit($id);
        return view('blog.edit', $compact);
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

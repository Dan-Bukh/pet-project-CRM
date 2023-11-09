<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request) 
    {
        $validated = $request->validate([
            'id' => ['string'],
        ]);

        $user = auth('web')->user();

        

        if($request->has('id')) {
            $hash = $validated['id'] / 1024;
            $user_name = User::query()->where('id', $hash)->get(['name', 'status']);
            if($user_name->contains(0)) {
                $posts = Post::query()->where('supplier_id', $hash)->get(['id', 'title', 'created_at']);
                return view('blog.index', compact('user', 'user_name', 'posts', 'hash'));
            }
        }
        
        return view('blog.index', compact('user'));
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

    public function order_store(Request $request) 
    {
        $validated = $request->validate([
            "id" => ['required' ,'string', 'max:40'],
            "supplier_name" => ['required' ,'string', 'max:40'],
            "speciality" => ['required' ,'string', 'max:40'],
            "name" => ['required' ,'string', 'max:40'],
            "email" => ['required' ,'string', 'email', 'max:50'],
            "number" => ['required' ,'string', 'max:15'],
            "time_order" => ['required' ,'string', 'max:10'],
        ]);

        if(validate_fio($validated['name'])) {
            return back()->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);
        };
        $time = Carbon::now();

        Customer::query()->insertOrIgnore([
            'supplier_id' => $validated['id'],
            'supplier_name' => $validated['supplier_name'],
            'speciality' => $validated['speciality'],
            'customer_name' => $validated['name'],
            'email' => $validated['email'],
            'number' => $validated['number'],
            'comment' => 'В Ожидании Подтверждения',
            'time' => Carbon::create($time->format('Y'), $time->format('m'), ($time->format('d') + 1), $validated['time_order'], 00, 00),
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

    public function post_store(Request $request) 
    {

        $validated = $request->validate([
            'id' => ['required' ,'string', 'max:40'],
            'name' => ['required' ,'string', 'max:40'],
            'title' => ['required' ,'string', 'max:1000'],
            'content' => ['required' ,'string'],
        ]);
        
        Post::query()->insertOrIgnore([
            'supplier_id' => $validated['id'],
            'supplier_name' => $validated['name'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return back()->withErrors(['success' => 'Пост создан успешно.']);
    }

    public function post_edit($id) {
        $post = Post::query()->where('id', $id)->get();
        $user = auth('web')->user();
        if($post[0]['supplier_id'] == $user->id) {
            return view('blog.edit', compact('user', 'post'));
        } else {
            abort(404);
        }
    }

    public function post_update(Request $request, $id) {
        $validated = $request->validate([
            'title' => ['required' ,'string', 'max:1000'],
            'content' => ['required' ,'string'],
        ]);
        
        Post::query()->where('id', $id)->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return back()->withErrors(['success' => 'Пост изменен успешно.']);
    }

    public function post_destroy(Request $request, $id) 
    {
        $validated = $request->validate([
            'id' => ['required' ,'string', 'max:40'],
        ]);
        Post::query()->where('id', $id)->delete();
        return redirect()->route('blog', ['id' => ($validated['id'] * 1024)]);
    }
}

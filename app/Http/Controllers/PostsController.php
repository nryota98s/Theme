<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // postsの一覧表示
    public function index()
    {
        $list = DB::table('posts')->get();

        return view('main', ['list' => $list]);

    }

    // 投稿ページの表示
    public function createForm()
    {
        return view('createForm');
    }
    // 投稿の実施
    public function create(Request $request)
    {
        // バリデーション
        $this->validate($request, [
            'name' => [
                'required',
                'regex:/^[^\s]+([\s　][^\s]+)*$/u',
            ],
            'newPost' => ['required', 'regex:/^[^\s]+([\s　][^\s]+)*$/u', 'max:150']

        ]);

        $name = $request->input('name');
        $post = $request->input('newPost');


        DB::table('posts')->insert([

            'user_name' => $name,
            'contents' => $post
        ]);

        return redirect('/main');

    }
    //  投稿の更新ページ
    public function updateForm($id)
    {

        $post = DB::table('posts')

            ->where('id', $id)

            ->first();

        return view('updateForm', ['post' => $post]);

    }

    // 投稿の更新
    public function update(Request $request)
    {
        $this->validate($request, [
            'upPost' => ['required', 'regex:/^[^\s]+([\s　][^\s]+)*$/u', 'max:150']

        ]);

        $id = $request->input('id');

        $up_post = $request->input('upPost');

        DB::table('posts')

            ->where('id', $id)

            ->update(

                ['contents' => $up_post]

            );

        return redirect('/main');

    }


}

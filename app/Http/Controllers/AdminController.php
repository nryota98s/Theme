<?php

namespace App\Http\Controllers;


use App\Models\Follow;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Post;

use App\Models\User;

use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    //管理者ページ表示
    public function index()
    {
        // postsの一覧表示
        $list = Post::all();
        return view('admin', ['list' => $list]);

    }

    public function delete($id)
    {
        $result = Post::deletePost($id);

        if ($result) {
            return redirect('/admin');
        }

    }

    public function grant(Request $request)
    {

        // Userクラスからユーザー名取得し表示
        $list = User::all();

        $userId = $request->input('userid');


        return view('grant-admin', ['list' => $list, 'userId' => $userId]);

    }




}

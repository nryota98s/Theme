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

    public function grantTop(Request $request)
    {

        // Userクラスからユーザー名取得し表示
        $list = User::all();

        return view('grant-admin', ['list' => $list]);

    }


    // 権限付与・解除
    // userテーブルから$userIdを検索して
    public function grantAdmin(Request $request, $id)
    {
        // Userテーブルからパラメータより取得した$idをもとに情報取得
        $user = User::find($id);
        // 取得した情報のis_adminがtrueならfalseを、falseならtrueをsaveする
        if ($user->is_admin == true) {
            $user->is_admin = false;
        } else {
            $user->is_admin = true;
        }
        $user->save();
        return redirect('grant-admin');
    }




}

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

    // パスワード管理ページ
    public function grantPass()
    {
        $list = User::all();
        return view('pass-admin', ['list' => $list]);
    }

    // パスワード変更画面
    public function passupdateForm(Request $request)
    {
        $userId = $request->input('user_id');
        $post = User::getUserProfile($userId);
        return view('passup-admin', ['post' => $post]);

    }

    public function passReset(Request $request)
    {
        $this->validate($request, [
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);
        $newpass = $request->input('new_password');
        $id = $request->input('id');
        $usermodel = new User;
        return $usermodel->passwordReset($newpass, $id);
    }


}

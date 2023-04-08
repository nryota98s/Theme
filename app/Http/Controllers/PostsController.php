<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage; // Added namespace import

use Illuminate\Support\Facades\Hash;

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


    // profileのページ
    public function profile()
    {
        // ログイン中のユーザーの投稿一覧
        $posts = DB::table('posts')
            ->where('user_name', Auth::user()->name)
            ->get();
        // フォロー中の人数
        $followingCount = DB::table('follows')
            ->where('user_id', Auth::user()->id)
            ->count();
        // フォロワーの人数
        $followerCount = DB::table('follows')
            ->where('followed_user_id', Auth::user()->id)
            ->count();
        // 投稿件数の取得
        $postcheck = DB::table('posts')
            ->where('user_name', Auth::user()->name)
            ->count();


        return view('profile', [
            "posts" => $posts,
            'followingCount' => $followingCount,
            'followerCount' => $followerCount,
            "postcheck" => $postcheck
        ]);

    }

    // profileの更新ページ
    public function profileupdateForm()
    {

        $post = DB::table('users')

            ->where('id', Auth::user()->id)

            ->first();

        return view('/prof-update', ['post' => $post]);

    }

    // profileの更新

    public function profileupdate(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('upName');
        $bio = $request->input('upBio');
        $pass = $request->input('password');

        // アイコン画像
        if ($request->hasFile('image')) {
            // imageの取得
            $file = $request->file('image');

            // filenameを固有のものにするために元々のfile名に時間を追加している
            $filename = time() . '_' . $file->getClientOriginalName();
            // publicディスクを使用して、('フォルダ名', ファイル, ファイル名)を指定して保存
            Storage::disk('public')->putFileAs('icon', $file, $filename);
        }
        // imageがdefalut.png(初期状態)でない場合
        else if (Auth::user()->image != 'default.png') {
            $filename = Auth::user()->image;
        } else {
            //imageにファイル名がない場合、中身が空のためimageカラムの中身は変わらない
            $filename = null;
        }

        // ハッシュ化されたパスワードとユーザーが入力したパスワードが一致しない場合
        if (!Hash::check($pass, Auth::user()->password)) {
            // エラーを"prof-update"に返す(エラーだった場合に直前のデータを残すために->back()を使用)
            return redirect()->back()->with('error', 'パスワードが正しくありません');
        }

        DB::table('users')
            ->where('id', $id)
            ->update(['name' => $name, 'bio' => $bio, 'image' => $filename]);

        return redirect('/main');
    }



}

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

        $followers = DB::table('follows')
            //usersテーブルとfollowsテーブルをfollowed_user_idとusers.idの部分で内部結合させる
            ->join('users', 'follows.followed_user_id', '=', 'users.id')
            // user_idが現在ログインしているユーザーのidと一致するもので抽出
            ->where('follows.user_id', '=', Auth::user()->id)
            ->get();

        // $followersから、nameカラムの値を取り出して配列に格納する
        $followers_name = $followers->pluck('name')->toArray();

        $list = DB::table('posts')
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを抽出
            // whereInにすることで複数の値を指定することができる
            ->whereIn('user_name', $followers_name)
            ->get();

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

    // 投稿の削除
    public function delete($id)
    {

        DB::table('posts')
            ->where('id', $id)
            ->delete();
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

    public function following()
    {
        $followers = DB::table('follows')
            //usersテーブルとfollowsテーブルをfollowed_user_idとusers.idの部分で内部結合させる
            ->join('users', 'follows.followed_user_id', '=', 'users.id')
            // user_idが現在ログインしているユーザーのidと一致するもので抽出
            ->where('follows.user_id', '=', Auth::user()->id)
            ->get();

        // $followersから、nameカラムの値を取り出して配列に格納する
        $followers_id = $followers->pluck('id')->toArray();



        $list = DB::table('users')
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを複数抽出
            ->whereIn('id', $followers_id)
            ->get();


        return view('following', ['list' => $list]);
    }

    public function followed()
    {
        $followers = DB::table('follows')
            //usersテーブルとfollowsテーブルをfollowed_user_idとusers.idの部分で内部結合させる
            ->join('users', 'follows.user_id', '=', 'users.id')
            // followed_user_idが現在ログインしているユーザーのidと一致するもので抽出
            ->where('follows.followed_user_id', '=', Auth::user()->id)
            ->get();

        // $followersから、idカラムの値を取り出して配列に格納する
        $followed_id = $followers->pluck('id')->toArray();

        $list = DB::table('users')
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを複数抽出
            ->whereIn('id', $followed_id)
            ->get();


        return view('followed', ['list' => $list]);
    }


    // 検索結果
    public function search(Request $request)
    {
        // 検索ボックスに入力された文字を取得しusersテーブルから該当するものを表示
        $keyword = $request->input('keyword');
        $items = DB::table('users')
            ->where('name', 'like', '%' . $keyword . '%')
            ->where('id', '<>', Auth::user()->id)
            ->get();

        // ログインユーザーがフォローしているユーザー情報抽出
        $followed = DB::table('follows')
            ->where('user_id', Auth::user()->id)
            ->get();

        // $followedからfollowed_user_idを配列で抽出
        $id = $followed->pluck('followed_user_id')->toArray();

        return view('searchForm', ['keyword' => $keyword, 'items' => $items, 'id' => $id]);
    }






}

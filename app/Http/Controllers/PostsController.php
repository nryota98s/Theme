<?php

namespace App\Http\Controllers;


use App\Models\Follow;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage; // Added namespace import

use Illuminate\Support\Facades\Hash;

use App\Models\Post;

use App\Models\User;


class PostsController extends Controller
{
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
            ->where('id', '<>', Auth::user()->id)
            // 日付で昇順にする
            ->orderBy('created_at', 'desc')
            ->get();

        $now_id = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first(); // 最初の1つのレコードを取得

        $users = DB::table('users')
            ->where('id', '<>', Auth::user()->id)
            ->get();

        $followed = DB::table('follows')
            ->where('user_id', Auth::user()->id)
            ->get();

        // $followedからfollowed_user_idを配列で抽出
        $id = $followed->pluck('followed_user_id')->toArray();


        return view('main', ['list' => $list, 'now_id' => $now_id, 'users' => $users, 'id' => $id]);

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

        Post::createPost($name, $post);

        return redirect('/main');

    }
    //  投稿の更新ページ
    public function updateForm($id)
    {
        $post = Post::updateView($id);

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

        $result = Post::updatePost($id, $up_post);
        if ($result) {
            return redirect('/main');
        }

    }

    // 投稿の削除
    public function delete($id)
    {
        $result = Post::deletePost($id);

        if ($result) {
            return redirect('/main');
        }

    }


    // profileのページ
    public function profile($userid)
    {
        // userを取得
        $name = User::getUser($userid);

        // 現在開いているページ主のユーザーの投稿一覧
        $posts = Post::profileGetPost($userid);

        // 現在開いているページ主のフォロー中の人数
        $followingCount = Follow::followingCount($userid);

        // 現在開いているページ主のフォロワーの人数
        $followerCount = Follow::followerCount($userid);
        // 現在開いているページ主の投稿件数の取得
        $postcheck = Post::postCheck($userid);

        return view('profile', [
            "posts" => $posts,
            'followingCount' => $followingCount,
            'followerCount' => $followerCount,
            "postcheck" => $postcheck,
            "name" => $name

        ]);

    }

    // profileの更新ページ
    public function profileupdateForm($userid)
    {
        $post = User::getUserProfile($userid);
        return view('/prof-update', ['post' => $post]);

    }


    // profileの更新

    public function profileupdate(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('upName');
        $bio = $request->input('upBio');
        $pass = $request->input('password');
        $file = $request->file('image');
        return User::profile($id, $name, $bio, $pass, $request, $file);
    }

    public function following($userid)
    {
        $followers = DB::table('follows')
            //usersテーブルとfollowsテーブルをfollowed_user_idとusers.idの部分で内部結合させる
            ->join('users', 'follows.followed_user_id', '=', 'users.id')
            // user_idが現在開いているページ主のidと一致するもので抽出
            ->where('follows.user_id', '=', $userid)
            ->get();

        // $followersから、idカラムの値を取り出して配列に格納する
        $followers_id = $followers->pluck('id')->toArray();
        // $followersから、nameカラムの値を取り出して配列に格納する
        $followers_name = $followers->pluck('name')->toArray();

        $post = DB::table('posts')
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを複数抽出
            ->whereIn('user_name', $followers_name)
            ->orderBy('created_at', 'desc')
            ->get();


        $list = DB::table('users')
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを複数抽出
            ->whereIn('id', $followers_id)
            ->get();


        return view('following', ['list' => $list, 'post' => $post]);
    }



    public function followed($userid)
    {
        $followers = DB::table('follows')
            //usersテーブルとfollowsテーブルをfollowed_user_idとusers.idの部分で内部結合させる
            ->join('users', 'follows.user_id', '=', 'users.id')
            // followed_user_idが現在開いているページ主のidと一致するもので抽出
            ->where('follows.followed_user_id', '=', $userid)
            ->get();

        // $followersから、idカラムの値を取り出して配列に格納する
        $followed_id = $followers->pluck('id')->toArray();
        // $followersから、nameカラムの値を取り出して配列に格納する
        $followed_name = $followers->pluck('name')->toArray();


        $post = DB::table('posts')
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを複数抽出
            ->whereIn('user_name', $followed_name)
            ->orderBy('created_at', 'desc')
            ->get();

        $list = DB::table('users')
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを複数抽出
            ->whereIn('id', $followed_id)
            ->get();


        return view('followed', ['list' => $list, 'post' => $post]);
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




    // フォローする
    public function follow($userId)
    {
        Auth::user()->followAction()->attach($userId);
        return back();
    }

    // フォロー解除
    public function unfollow($userId)
    {
        Auth::user()->followAction()->detach($userId);
        return back();
    }





}

<?php

namespace App\Http\Controllers;


use App\Models\Follow;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Post;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index()
    {
        // モデルのインポート
        $postmodel = new Post;
        $usermodel = new User;
        $followmodel = new Follow;
        $userid = User::User();

        // postsの一覧表示
        $list = $postmodel->getFollowersPosts();

        // userの一覧表示(ログイン中のユーザーを除く)
        $users = $usermodel->getExcludedUsers();

        // フォロー中のユーザーのid取得
        $id = $followmodel->getFollowedUserIdsByUserId($userid);

        return view('main', ['list' => $list, 'users' => $users, 'id' => $id]);

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
        $user_id = $request->input('user_id');

        Post::createPost($name, $post, $user_id);

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
        $name = User::getUserProfile($userid);

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

        // postsの一覧表示
        $post = Post::getFollowersPosts();

        // フォロー中のユーザー表示
        $list = User::getFollowingUser();

        return view('following', ['list' => $list, 'post' => $post,]);
    }



    public function followed($userid)
    {
        // postsの一覧表示
        $post = Post::getFollowedPosts();
        // フォロワー表示
        $list = User::getFollowedUser();

        // フォロー中のユーザーのid取得
        $followmodel = new Follow;
        $id = $followmodel->getFollowedUserIdsByUserId($userid);


        return view('followed', ['list' => $list, 'post' => $post, 'id' => $id]);
    }


    // 検索結果
    public function search(Request $request)
    {
        // 検索ボックスに入力された文字を取得しusersテーブルから該当するものを表示
        $keyword = $request->input('keyword');
        $items = User::searchKey($keyword);
        $userid = User::User();

        // $followedからfollowed_user_idを配列で抽出
        $id = Follow::getFollowedUserIdsByUserId($userid);

        return view('searchForm', ['keyword' => $keyword, 'items' => $items, 'id' => $id]);
    }




    // フォローする
    public function follow($userId)
    {
        // attach($userId) メソッドは、Auth::user() の followAction() リレーションシップに新しい $userId の値を追加するために使用
        Auth::user()->followAction()->attach($userId);
        return back();
    }

    // フォロー解除
    public function unfollow($userId)
    {
        // detach($userId) メソッドは、Auth::user() の followAction() リレーションシップから指定された $userId の値を削除するために使用
        Auth::user()->followAction()->detach($userId);
        return back();
    }

    // パスワード更新のページ
    public function passupdateForm($userid)
    {
        $post = User::getUserProfile($userid);
        return view('/pass-update', ['post' => $post]);

    }

    public function passUpdate(Request $request)
    {
        $this->validate($request, [
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);
        $pass = $request->input('password');
        $newpass = $request->input('new_password');
        $id = $request->input('id');
        $usermodel = new User;
        return $usermodel->passwordUpdate($pass, $newpass, $id);
    }




}

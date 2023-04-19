<?php
// namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Follow;

use App\Models\User;

class Post extends Model
{

    protected $fillable = [
        'user_name',
        'contents',
    ];

    protected $table = 'posts';

    // postsの一覧表示
    public static function getFollowersPosts()
    {

        // フォロー中のユーザーの名前を取得
        $followersNames = Follow::join('users', 'follows.followed_user_id', '=', 'users.id')
            ->where('follows.user_id', Auth::user()->id)
            ->pluck('name')
            ->toArray();

        // フォロー中のユーザーの投稿を取得
        $followersPosts = Post::whereIn('user_name', $followersNames)
            ->where('id', '<>', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return $followersPosts;
        //フォロー中のユーザーの投稿表示　ここまで
    }

    // 投稿の実施
    // static を使うことでコントローラー上で\App\Models\Post::createPost($name, $post);と入れるだけで代入してメソッドが実行される
    public static function createPost($name, $post)
    {
        // self キーワードを使用してクラス内の別の静的メソッドを呼び出す
        // Call to undefined functionとなるためself::をつけることでコントローラーでcreatePostを呼び出した時に同様の処理ができる
        // self::create() はデータベーステーブルとモデルクラスが自動的に関連付けられるためテーブルの指定をする必要がない
        // だがカラムがあっていればなんでも入力できてしまうのでバリデーションを行う
        return self::create([
            'user_name' => $name,
            'contents' => $post
        ]);
    }

    //  投稿の更新ページ
    public static function updateView($id)
    {
        $post = self::where('id', $id)
            ->first();

        return $post;

    }
    // 投稿の更新
    public static function updatePost($id, $up_post)
    {
        $result = self::where('id', $id)
            ->update(

                ['contents' => $up_post]

            );

        return $result;

    }

    // 投稿の削除
    public static function deletePost($id)
    {
        $result = self::where('id', $id)
            ->delete();

        return $result;

    }

    // 現在開いているページ主のユーザーの投稿一覧
    public static function profileGetPost($userid)
    {
        $userModel = new User();
        // userを取得
        $name = $userModel->getUser($userid);

        // 現在開いているページ主のユーザーの投稿一覧
        $posts = self::where('user_name', $name->name)
            // 日付で昇順にする
            ->orderBy('created_at', 'desc')
            ->get();
        return $posts;
    }

    // 現在開いているページ主の投稿件数の取得
    public static function postCheck($userid)
    {
        // userを取得
        $name = User::getUser($userid);

        // 現在開いているページ主の投稿件数の取得
        $postcheck = self::where('user_name', $name->name)
            ->count();
        return $postcheck;
    }

    public static function getFollowedPosts()
    {
        $userid = User::User();

        $followers = DB::table('follows')
            //usersテーブルとfollowsテーブルをfollowed_user_idとusers.idの部分で内部結合させる
            ->join('users', 'follows.user_id', '=', 'users.id')
            // followed_user_idが現在開いているページ主のidと一致するもので抽出
            ->where('follows.followed_user_id', '=', $userid)
            ->get();
        // $followersから、nameカラムの値を取り出して配列に格納する
        $followed_name = $followers->pluck('name')->toArray();


        $post = DB::table('posts')
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを複数抽出
            ->whereIn('user_name', $followed_name)
            ->orderBy('created_at', 'desc')
            ->get();

        return $post;
    }

}

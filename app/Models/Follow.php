<?php
// namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Follow extends Model
{

    protected $fillable = [
        'user_name',
        'contents',
    ];
    protected $table = 'follows';


    // フォロー中のユーザーのid取得(フォロワーのページで使用)
    public static function getFollowingUserIdsByUserId($userid)
    {
        $followers = DB::table('follows')
            //usersテーブルとfollowsテーブルをfollowed_user_idとusers.idの部分で内部結合させる
            ->join('users', 'follows.user_id', '=', 'users.id')
            // followed_user_idが現在開いているページ主のidと一致するもので抽出
            ->where('follows.followed_user_id', '=', $userid)
            ->get();
        $followed_id = $followers->pluck('id')->toArray();
        return $followed_id;
    }

    // フォロワーのユーザーのid取得
    public static function getFollowedUserIdsByUserId($userid)
    {
        $id = self::where('user_id', $userid)
            ->pluck('followed_user_id')
            ->toArray();

        return $id;
    }

    // 現在開いているページ主のフォロー中の人数のカウント
    public static function followingCount($userid)
    {
        $followingCount = self::where('user_id', $userid)
            ->count();

        return $followingCount;
    }

    // 現在開いているページ主のフォロワーの人数
    public static function followerCount($userid)
    {
        $followerCount = self::where('followed_user_id', $userid)
            ->count();
        return $followerCount;
    }
}

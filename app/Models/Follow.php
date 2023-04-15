<?php
// namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage; // Added namespace import

use Illuminate\Support\Facades\Hash;

class Follow extends Model
{

    protected $fillable = [
        'user_name',
        'contents',
    ];
    protected $table = 'follows';

    // フォロー中のユーザーのid取得
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

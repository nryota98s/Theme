<?php
// namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage; // Added namespace import

use Illuminate\Support\Facades\Hash;

class User extends Model
{

    protected $fillable = [
        'user_name',
        'contents',
    ];
    protected $table = 'users';

    // 現在ログインしているアカウントを見つける
    public static function get_UserId($userid)
    {
        return static::where('id', $userid)->first();
    }

    // userの一覧表示(ログイン中のユーザーを除く)
    public function getExcludedUsers()
    {
        return $this->where('id', '<>', auth()->user()->id)->get();
    }

    // profileの更新ページ
    public static function getUserProfile($userid)
    {
        // ユーザーのプロフィール情報を取得
        $profile = self::where('id', $userid)
            ->first();

        return $profile;
    }

    // userを取得
    public static function getUser($userid)
    {
        $name = DB::table('users')
            ->where('id', $userid)
            ->first();
        return $name;
    }

    public static function profile($id, $name, $bio, $pass, $request)
    {
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

    public function followingUser($userid)
    {
        $followers = DB::table('follows')
            // usersテーブルとfollowsテーブルをfollowed_user_idとusers.idの部分で内部結合させる
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

}

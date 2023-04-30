<?php
// namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage; // Added namespace import

use Illuminate\Support\Facades\Hash;

class User extends Model
{

    protected $fillable = [
        'user_name',
        'contents',
        'is_admin'
    ];
    protected $table = 'users';


    public static function User()
    {
        $userid = Auth::user()->id;
        return $userid;
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
        $name = self::where('id', $userid)
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
            return redirect()->back()->with('error', '入力されたパスワードが正しくありません');
        }
        self::where('id', $id)->update
        ([
                'name' => $name,
                'bio' => $bio,
                'image' => $filename
            ]);

        return redirect('/main');
    }

    // フォロー中のユーザー表示
    public static function getFollowingUser()
    {

        $userid = User::User();
        $followers_id = Follow::getFollowedUserIdsByUserId($userid);
        $list = self::whereIn('id', $followers_id)
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを複数抽出
            ->get();
        return $list;
    }

    public static function getFollowedUser()
    {
        $userid = User::User();


        // $followersから、idカラムの値を取り出して配列に格納する
        $followed_id = Follow::getFollowingUserIdsByUserId($userid);

        $list = self::whereIn('id', $followed_id)
            // user_nameがログイン中のアカウントがフォローしているアカウント名のものを複数抽出
            ->get();

        return $list;

    }

    // 検索結果
    public static function searchKey($keyword)
    {
        $items = self::where('name', 'like', '%' . $keyword . '%')
            ->where('id', '<>', Auth::user()->id)
            ->get();

        return $items;
    }

    // パスワードの変更
    public function passwordUpdate($pass, $newpass, $id)
    {
        if (!Hash::check($pass, Auth::user()->password)) {
            // エラーを"pass-update"に返す(エラーだった場合に直前のデータを残すために->back()を使用)
            return redirect()->back()->with('error', 'パスワードが正しくありません');
        }
        self::where('id', $id)
            ->update(['password' => bcrypt($newpass)]);
        return redirect()->back()->with('success', 'パスワードを更新しました');
    }

    // 管理画面パスワードリセット
    public function passwordReset($newpass, $id)
    {
        self::where('id', $id)
            ->update(['password' => bcrypt($newpass)]);
        return redirect()->back()->with('success', 'パスワードを更新しました');
    }


}

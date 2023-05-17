<?php
use Illuminate\Database\Seeder;
use App\Models\Follow;
use App\User;
use Faker\Generator as Faker;

class FollowsTableSeeder extends Seeder
{
    public function run()
    {
        // 古いデータを削除し新しいデータに書き換える
        Follow::truncate();
        $users = User::all();
        // ユーザーをランダムに選択し、フォロー関係を作成する
        foreach ($users as $user) {
            $followed_users = $users->random(3); // ランダムに3人をフォローする
            foreach ($followed_users as $followed_user) {
                if ($user->id !== $followed_user->id) {
                    Follow::create([
                        'user_id' => $user->id,
                        'followed_user_id' => $followed_user->id,
                    ]);
                }
            }
        }
    }
}

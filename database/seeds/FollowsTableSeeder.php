<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Follow;

class FollowsTableSeeder extends Seeder
{
    public function run()
    {
        // ユーザーをランダムに選択し、フォロー関係を作成する
        $users = User::all();
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

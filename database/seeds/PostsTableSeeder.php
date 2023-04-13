<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_name' => 'MidnightEchoes',
                'contents' => '心に刻む旅の記憶',
            ],
            [
                'user_name' => 'SolarSpectrum',
                'contents' => '瞬きする星空の神秘',
            ],
            [
                'user_name' => 'CrystalCove',
                'contents' => '時間よ止まれ、永遠に続く瞬間
',
            ],
            [
                'user_name' => 'ThunderboltStrike',
                'contents' => '魂に響く音楽の魔法',
            ],
            [
                'user_name' => 'MysticMeadow',
                'contents' => '自由に羽ばたく翼の喜び',
            ],
            [
                'user_name' => 'OceanicWhispers',
                'contents' => '永遠の愛に包まれた幸せ',
            ],
            [
                'user_name' => 'EnchantedWoods',
                'contents' => '大自然の中で感じる小さな幸せ',
            ],
            [
                'user_name' => 'CrimsonSoul',
                'contents' => 'クリエイティブな想像力の広がり',
            ],
            [
                'user_name' => 'CelestialBloom',
                'contents' => '冒険への未知なる興奮と緊張',
            ],
            [
                'user_name' => 'NebulaStorm',
                'contents' => '心地よい温かさに包まれた安らぎ',
            ],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'MidnightEchoes',
                'email' => 'qalazizelawye@eolom.com',
                'password' => 'wjK9',
            ],
            [
                'name' => 'SolarSpectrum',
                'email' => 'tifevudoyuj@gokiw.com',
                'password' => 'xRt3',
            ],
            [
                'name' => 'CrystalCove',
                'email' => 'qicimuyex@mayog.com',
                'password' => 'sFq7
',
            ],
            [
                'name' => 'MysticMeadow',
                'email' => 'cyzocizik@rolox.com',
                'password' => 'tGv2',
            ],
            [
                'name' => 'OceanicWhispers',
                'email' => 'herynatokav@zotul.com',
                'password' => 'pDk6',
            ],
            [
                'name' => 'EnchantedWoods',
                'email' => 'coqavazoh@kokix.com',
                'password' => 'zHm4',
            ],
            [
                'name' => 'CrimsonSoul',
                'email' => 'mywyvevug@ziket.com',
                'password' => 'yLc8',
            ],
            [
                'name' => 'CelestialBloom',
                'email' => 'jipehymafav@wazax.com',
                'password' => 'bNf1',
            ],
            [
                'name' => 'NebulaStorm',
                'email' => 'xoyimivow@nukud.com',
                'password' => 'mPj5',
            ],
            [
                'name' => 'ThunderboltStrike',
                'email' => 'gojokarix@gowum.com',
                'password' => 'vTn0',
            ],

        ]);
    }
}

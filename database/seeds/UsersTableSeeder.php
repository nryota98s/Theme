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
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'SolarSpectrum',
                'email' => 'tifevudoyuj@gokiw.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'CrystalCove',
                'email' => 'qicimuyex@mayog.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'MysticMeadow',
                'email' => 'cyzocizik@rolox.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'OceanicWhispers',
                'email' => 'herynatokav@zotul.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'EnchantedWoods',
                'email' => 'coqavazoh@kokix.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'CrimsonSoul',
                'email' => 'mywyvevug@ziket.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'CelestialBloom',
                'email' => 'jipehymafav@wazax.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'NebulaStorm',
                'email' => 'xoyimivow@nukud.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'ThunderboltStrike',
                'email' => 'gojokarix@gowum.com',
                'password' => bcrypt('password'),
            ],

        ]);
    }
}

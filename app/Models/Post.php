<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function index()
    {

        $list = DB::table('posts')->get();

        return view('posts.index', ['list' => $list]);

    }
}

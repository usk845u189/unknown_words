<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // 常にログインしている状態にする
    public function setup()
    {
        parent::setup();
        \DB::table('users')->insert([
            'id' => 1,
            'name' => mt_rand(), 
            'email' => mt_rand().'@email.com', 
            'password' => \Hash::make('password') 
        ]);
        $user = User::find(1);
        $this->be($user);
    }

}

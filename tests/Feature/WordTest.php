<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WordTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * ユーザー登録
     *
     * @return void
     */
    public function testUserRegister()
    {
        $data = [
            'name' => 'Test User1', 
            'email' => 'test@testmail.com', 
            'password' => 'password', 
            'password_confirmation' => 'password' 
        ];

        $response = $this->postJson(route('register'), $data);

        $response->assertStatus(302)->assertRedirect('/word');
    }

    /**
     * ログイン
     *
     * @return void
     */
    public function userLogin()
    {
        $data = [
            'email' => 'test@testmail.com', 
            'password' => 'password'
        ];

        $response = $this->postJson(route('login'));
        $response->assertStatus(302);
    }

    /**
     * メインページ
     *
     * @return void
     */
    public function openTopPage()
    {
        $response = $this->get('/word');
        $response->assertStatus(200);
    }
}
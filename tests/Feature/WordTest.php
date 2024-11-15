<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Word;

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
// 
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

    /**
     * メインページの見た目
     *
     * @return void
     */
    public function testTopPageView()
    {
        $this->visit('/word')
        ->see('ID')
        ->see('単語')
        ->see('わからないところ')
        ->see('詳細')
        ->see('削除');
    }

    /**
     *　入力画面のテスト
     *　入力画面を開いて値を入力し、適切にDBに記録されるのか？
     * @return void
     */
    public function store()
    {
       $this->assertAuthenticated();

       $word = Word::factory()->create()
            ->actingAs($word)
            ->post('/word');

    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Word;

class WordTest extends TestCase
{

    /**
     * ユーザー登録
     *
     * @return void
     */
    public function testUserRegister()
    {
        $data = [
            'Name' => 'Test User1', 
            'Email Address' => 'test@testmail.com', 
            'Password' => 'password', 
            'Confirm password' => 'password' 
        ];

        $response = $this->postJson(route('register'), $data);

        $response->assertStatus(302)->assertRedirect('/word');


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
     *　入力画面のテスト
     *　入力画面を開いて値を入力し、適切にDBに記録されるのか？
     * @return void
     */
    public function storeWord()
    {
        $wordData = factory(Word::class)->make();

        $response = $this->post('/word', [
            'word' => $wordData->word, 
            'detail' => $wordData->detail, 
            'body' => $wordData->body
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('words', [
            'word' => $wordData->word, 
            'detail' => $wordData->detail, 
            'body' => $wordData->body
        ]);

    }

    public function showWord()
    {
        $word = factory(Word::class)->create();

        $response = $this->get('/word/detail/{$word->id}');

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $word->id, 
            'word' => $word->word, 
            'detail' => $word->detail, 
            'body' => $word->body
        ]);
    }
    
    public function updateWord()
    {
        $word = factory(Word::class)->create();
        $word->update([
            'word' => 'Updated word', 
            'detail' => 'Updated detail', 
            'body' => 'Updated body'
        ]);
        $this -> assertDatabaseHas('words', [
            'id' => $word->id, 
            'word' => 'Updated word', 
            'detail' => 'Updated detail', 
            'body' => 'Updated body'
        ]);

        $word->refresh();
        $this->assertEquals('Updated word', $word->word);
        $this->assertEquals('Updated detail', $word->detail);
        $this->assertEquals('Updated body', $word->body);
    }

    public function deleteWord()
    {
        $word = factory(Word::class)->create();

        $response = $this->delete('/word/delete/{$word->id}');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('words', [
            'id' => $word->id,
        ]);
    }
}

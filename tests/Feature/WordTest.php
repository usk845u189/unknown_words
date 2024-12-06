<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Models\Word;
use Illuminate\Database\Seeder;

class WordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザー登録
     *
     * @return void
     */
    public function testUserRegister()
    {
        session()->flush();
        
        $data = [
            'id' => 2, 
            'name' => 'Test User1', 
            'email' => 'test@testmail.com', 
            'password' => 'password', 
            'password_confirmation' => 'password' 
        ];

        $response = $this->postJson(route('register'), $data);

        // $response->dump();

        $response->assertStatus(302)->assertRedirect('/home');


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
    public function testOpenTopPage()
    {
        $response = $this->get('/word');
        $response->assertStatus(200);
    }

    /**
     *　入力画面のテスト
     *　入力画面を開いて値を入力し、適切にDBに記録されるのか？
     * @return void
     */
    public function testStoreWord()
    {
        $user = User::find(1);
        $this->be($user);
        $wordData = factory(Word::class)->make();

        $response = $this->post('/word', [
            'word' => $wordData->word, 
            'detail' => $wordData->detail, 
            'body' => $wordData->body
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('words', [
            'word' => $wordData->word, 
            'detail' => $wordData->detail, 
            'body' => $wordData->body
        ]);

    }

    public function testShowWord()
    {
        $user = User::find(1);
        
        $this->be($user);
        \Log::error($user);
        $word = factory(Word::class)->make();
        dd($word);

        // $response = $this->get(`/word/detail/{$word->id}`);
        $response = $this->get('/word/detail/1');

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $word->id, 
            'word' => $word->word, 
            'detail' => $word->detail, 
            'body' => $word->body
        ]);
    }
    
    public function testUpdateWord()
    {
        $word = factory(Word::class)->make();
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

    public function testDeleteWord()
    {
        $word = factory(Word::class)->make();

        // $response = $this->delete(`/word/delete/{$word->id}`);
        $response = $this->delete('/word/delete/1');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('words', [
            'id' => $word->id,
        ]);
        // $response->dump();
    }
}

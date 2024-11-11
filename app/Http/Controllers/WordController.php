<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word; //modelのクラス

class WordController extends Controller
{
    public function index(Request $request)
    {
        $words = Word::where('user_id',\Auth::user()->id)->get();
        return view('word.index',['words' => $words]);
    }

    public function create(Request $request)
    {
        return view('word.create');

        // ajax通信用
        // $word = new Word();
        // $word->word = $request->input('word');
        // $word->detail = $request->input('detail');
        // $word->body = $request->input('body');
        // $word->save();

        // return response()->json($word);
    }

    public function store(Request $request)
    {
        $request->validate([
            'word' => 'required|string', 
            'detail' => 'required|string', 
            'body' => 'required|string',
        ]);

        $word = new Word();
        $word->user_id = \Auth::id();
        $word->word = $request->word;
        $word->detail = $request->detail;
        $word->body = $request->body;
        $word->save();

        return redirect("word/");

        // ajax通信で非同期で画面の更新を行う場合はこっちを使う
        // return response()->json($word);
    }

    public function detail(Request $request, $id)
    {
        $word = Word::find($id)->toArray();
        // dd(optional($word["id"]));
        return view('word.detail', ['word'=>$word]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'word' => 'required|string', 
            'detail' => 'required|string', 
            'body' => 'required|string'
        ]);

        $word = Word::find($id);
        // $word -> update([
        //     'word' => $request->input('word'), 
        //     'detail' => $request->input('detail'), 
        //     'body' => $request->input('body')
        // ]);
        $word->word = $request->word;
        $word->detail = $request->detail;
        $word->body = $request->body;
        $word->save();

        return redirect("word/");
          
    }

    public function delete(Request $request, $id)
    {
        $word = Word::find($id);
        $word->delete();
        return redirect("word/");
    }
}

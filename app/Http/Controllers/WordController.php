<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word; //これなに？

class WordController extends Controller
{
    public function index(Request $request)
    {
        $words = Word::where('user_id',\Auth::user()->id)->get();
        return view('word.index',['words' => $words]);
    }
}
// ['words' => $words]
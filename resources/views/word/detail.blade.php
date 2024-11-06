@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">単語詳細</div>
            </div>
            <div class="panel-body">
                <form method="post" action="/word/update">
                    {{ csrf_field() }}
                    <label for="text">単語</label>
                    <input type="text" name="word" value="{{ $word->word }}">
                    <hr>
                    <label for="text">わからなかったところ</label><br>
                    <input type="text" name="detail" style="width: 720px" value="{{ $word->detail }}">
                    <hr>
                    <label for="textarea">内容</label>
                    <textarea name="body" id="body" cols="30" rows="10" style="width:720px" value="{{ $word->body }}"></textarea>
                    <br>
                    <button type="submit" class="btn btn-warning">追加</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                    <div class="panel-heading">追加単語</div>
            </div>
            <div class="panael-body">
                <form method="POST" action="/word">
                    {{ csrf_field() }}
                    <label for="text">単語</label><br>
                    <input type="text" name="word" cols="10">
                    <hr>
                    <label for="text">わからなかったところ</label><br>
                    <input type="text" name="detail" style="width:720px">
                    <hr>
                    <label for="textarea">内容</label><br>
                    <textarea name="body" id="body" style="width:720px"></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary">登録</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
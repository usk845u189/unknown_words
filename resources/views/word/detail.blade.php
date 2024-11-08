@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">単語詳細</div>
            </div>
            <div class="panel-body">
                <form method="post" action="/word/update/{{ $word["id"] }}">
                    <input type="hidden" name="_method" value="put">
                    {{ csrf_field() }}
                    <label for="text">単語</label><br>
                    <input type="text" name="word" value="{{ $word["word"] }}">
                    <hr>
                    <label for="text">わからなかったところ</label><br>
                    <input type="text" name="detail" style="width: 720px" value="{{ $word["detail"] }}">
                    <hr>
                    <label for="textarea">内容</label><br>
                    <textarea name="body" id="body" cols="30" rows="10" style="width:720px" >{{ $word["body"] }}</textarea>
                    <br>
                    <button type="submit" class="btn btn-warning">変更</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
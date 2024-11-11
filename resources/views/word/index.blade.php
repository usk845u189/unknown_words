@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="card">
                    <div class="card-header">
                        <h4>単語リスト</h4>
                        <a href="/word/create" class="btn btn-primary w-100 text-end" id="createBtn">作成</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-stripped text-nowrap">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>単語</td>
                                <td>わからないところ</td>
                                <td>詳細</td>
                                <td>削除</td>
                            </tr>
                        </thead>
                        @foreach($words as $word)
                        <tbody>
                            <tr>
                                <td>{{ $word->id }}</td>
                                <td>{{ $word->word }}</td>
                                <td>{{ $word->detail }}</td>
                                <td><a href="/word/detail/{{ $word->id }}" class="btn btn-success">詳細</a></td>
                                <td>
                                    <form method="POST" action="/word/delete/{{ $word->id }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" class="btn btn-danger">削除</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" id="createForm" style="display:none;">
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
                    <button type="submit" class="btn btn-primary" id="saveBtn">登録</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#createBtn').click(function() {
            $('#createForm').toggle();
        });

        $('#saveBtn').click(function(){
            $.ajax({
                method: "POST", 
                url: "word/", 
                data: {
                    "_token": "{{ csrf_token() }}", 
                    word: $("input[name='word']").val(), 
                    detail: $("input[name='detail']").val(), 
                    body: $("input[name='body']").val()
                }, 
                success: function(res) {
                    $()
                }
            })
        })
    })
</script>

@endsection



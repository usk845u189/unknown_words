@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="card">
                    <div class="card-header">
                        <h4>単語リスト</h4>
                        <button class="btn btn-primary w-100 text-end" id="createBtn">作成</button>
                        {{-- <a href="/word/create" class="btn btn-primary w-100 text-end" id="createBtn">作成</a> --}}
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

<div class="container" >
    <div class="modal fade" id="wordModal" tabindex="-1" aria-labelledby="wordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wordModalLabel">単語を追加</h5>
                </div>
                <div class="modal-body">
                    <form id="wordForm" method="POST" action="/word" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="word">単語</label>
                            <input type="text" class="form-control" name="word" id="word" required>
                        </div>
                        <div class="form-group">
                            <label for="detail">わからなかったところ</label>
                            <input type="text" class="form-control" name="detail" id="detail" style="width:100%">
                        </div>
                        <div class="form-group">
                            <label for="body">内容</label>
                            <textarea class="form-control" name="body" id="body" style="width:100%"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveBtn">登録</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    $(function() {
        $('#createBtn').click(function() {
            $('#wordModal').modal('show');
        });

        $('#saveBtn').click(function(e){
            e.preventDefault();

            $.ajax({
                method: "POST", 
                url: "/word", 
                data: {
                    word: $('#word').val(), 
                    detail: $('#detail').val(), 
                    body: $('#body').val(), 
                    _token: $('input[name="_token"]').val()
                }, 
                success: function(response) {
                    alert('単語が追加されました。')
                    $('#wordModal').modal('hide');

                    // モーダルの中を空に（もっといい方法があるはず）
                    let word = document.getElementById('name');
                    word.val = '';
                    let detail = document.getElementById('detail');
                    detail.val = '';
                    let body = document.getElementById('body');
                    body.val = '';
                }, 
                error: function() {
                    alert('エラーが発生しました。')
                }
                
            });
        });
    });
</script>

@endsection



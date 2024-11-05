@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="card">
                    <div class="card-header">
                        <h4>単語リスト</h4>
                        <a href="/word/create" class="btn btn-primary w-100 text-end">作成</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-stripped text-nowrap">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>単語</td>
                                <td>わからないところ</td>
                                <td>追記</td>
                                <td>削除</td>
                            </tr>
                        </thead>
                        @foreach($words as $word)
                        <tbody>
                            <tr>
                                <td>{{ $word->id }}</td>
                                <td>{{ $word->word }}</td>
                                <td>{{ $word->detail }}</td>
                                <td><a href="/word/update/{{ $word->id }}" class="btn btn-success">追記</a></td>
                                <td><button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#del_modal">削除</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- 削除確認用モーダル --}}
<div class="modal fade" id="del_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">削除確認</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            この行を削除しますか？
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
            <form action="/word/delete/#" method='POST'> {{-- #に削除を押した単語のidを与えたいがやり方がわからない bladeを確認 --}}
            <input type="submit" class="btn btn-danger" value="削除">
        </form>
        </div>
        </div>
    </div>
</div>

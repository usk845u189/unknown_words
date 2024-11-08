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
@endsection



@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">post</div>
                <form method="POST" action="/post">
                    {{ csrf_field() }}
                    <input type="text" name="title">
                    <input type="text" name="description">
                    <textarea name="body" id="" cols="30" rows="10"></textarea>
                    <button type="submit">送信</button>
                </form>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
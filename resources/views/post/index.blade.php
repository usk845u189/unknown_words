@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">post</div>
                    @foreach($posts as $post)
                        <a href="/post/{{ $post->id }}"><p>{{ $post->title }}</p></a>
                    @endforeach
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
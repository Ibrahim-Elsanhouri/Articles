@extends('layouts.app')
@section('content')
<h1>{{$post->title}}</h1>
@if(!Auth::guest() && Auth::user()->id == $post->user_id)
<div class="clearfix">
<a href="{{ route ('posts.edit' , $post->id)}}" class="btn btn-default">Edit Post</a>
<div class="pull-right">
<form action="{{route('posts.destroy' , $post->id )}}" method="post">
{{csrf_field()}}
{{method_field('DELETE')}}
<button type="submit" class="btn btn-danger" >Delete Post</button>
</form>
</div>
@endif

<div class="container">
{{ $post->body }}
<!--<p><img src="upload/{{ $post->url }}"></p>-->
<img src="{{ asset('upload/'.$post->url) }}"  width="400" height="100" class="img-responsive" />




</div>
</hr>

<div class="container">
<div class="panel">
<br><br>

@foreach($post->comments as $c)
@if($c->approved == 1)

<div class="panel-body">
{{$c->body}}
</div>
<div class="panel-footer">
Wrote By : {{$c->user->name}}
</div>
@endif
@endforeach
</div>
</div>
<hr/>
<div class="panel panel-primary">
<div class="panel-heading">
Tags
</div>
<div class="panel-body">

            @foreach($post->tags as $tag)
                <a href="">
                    <span class="label label-info">
                        <i class="fa fa-tag"></i> {{ $tag->title }}
                    </span>
                </a>
                &nbsp;
            @endforeach

            <hr />

</div></div>


@if (Auth::check())
<div class="container">
<form action="{{route('posts.comments' , $post->id)}}" method="post">
{{csrf_field()}}
<div class="form-group">
<textarea placeholder="Add your Comment" class="form-control" cols="15" rows="5" name="body"></textarea>
<input type="hidden" name="commentable_type" value="App\Post" class="form-control"/>
<input type="hidden" name="commentable_id" value="{{$post->id}}" class="form-control"/>

</div>
<input type="submit" class="btn btn-primary"/>
</form>
</div>

@endif
@endsection
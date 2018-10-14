@extends('layouts.app')
@section('content')
@if($posts->count()==0)
<div class="alert alert-info">
<strong>Ops</strong> No Posts 
</div>
@else
@foreach($posts as $post)

<div class="panel">
<div class="panel-heading">
<h3><a href="{{ route ('posts.show' , $post->id)}}">{{$post->title}}</a></h3>
</div>
<div class="panel-body">
{{str_limit(strip_tags($post->body) , 50)}}
</div>
<div class="panel-footer">
<span class="label label-info">
<i class="glyphicon glyphicon-calendar"></i>
{{$post->created_at}}
</span>
&nbsp;
<span class="label label-info">
<i class="glyphicon glyphicon-user"></i>
{{$post->user->name}}
</span>
</div>
</div>
@endforeach
@endif
{{$posts->links()}}
@endsection
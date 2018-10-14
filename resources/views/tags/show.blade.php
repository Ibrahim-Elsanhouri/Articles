@extends('layouts.app')
@section('content')
<h1>{{$tag->title}}</h1>
<div class="clearfix">
<a href="" class="btn btn-default">Edit Tag</a>
<div class="pull-right">
<form action="" method="post">
{{csrf_field()}}
{{method_field('DELETE')}}
<button type="submit" class="btn btn-danger" >Delete Tag</button>
</form>
</div>
</hr>
<div class="container">
<div class="panel">
<br><br>
@foreach($tag->posts  as $p)

<div class="panel-body">
<a href="{{ route('posts.show',$p->id) }}" >{{$p->title}}</a>
</div>
@endforeach
</div>
</div>
<hr/>
@foreach($tag->comments as $c)
<div class="panel-body">
{{$c->body}}
</div>
@endforeach
</div>
</div>

@if (Auth::user()->role_id == 1)
<div class="container">
<form action="{{route('tags.comments' , $tag->id)}}" method="post">
{{csrf_field()}}
<div class="form-group">
<textarea placeholder="Add your Comment about the tag - this area for admins only " class="form-control" cols="15" rows="5" name="body"></textarea>
<input type="hidden" name="commentable_type" value="App\Tag" class="form-control"/>
<input type="hidden" name="commentable_id" value="{{$tag->id}}" class="form-control"/>

</div>
<input type="submit" class="btn btn-primary"/>
</form>
</div>

@endif
@endsection
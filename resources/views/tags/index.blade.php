@extends('layouts.app')
@section('content')
@foreach($tags as $tag)

<div class="panel">
<div class="panel-heading">
<h3><a href="{{ route ('tags.show' , $tag->id)}}">{{$tag->title}}</a></h3>
</div>
<div class="panel-body">
{{$tag->desc}}</div>
<div class="panel-footer">

</div>
</div>
@endforeach
{{$tags->links()}}
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Comments Information</div>
             

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                 

                    <table class="table table-striped">
<tr>
<th>Comment</th>
 <th>Comment Model </th>
 <th>status</th>
 <th>Created by</th>
<th>Edit Comment</th>
<th> Delete Comment</th>
</tr>
@foreach($comments as $comment)
<tr>
<td>{{$comment->body }}</td>
<td>{{$comment->commentable_type}}</td>
@if ($comment->approved == 1)
<td>Approved</td>
@else 
<td>Not Approved</td>
@endif 
<td>{{$comment->user->name}}</td>

<td><a href="{{route ('comments.edit' , $comment->id)}}" class="btn btn-primary">Edit</a></td>
<td>
<form action="{{ route('comments.destroy' , $comment->id) }}" method="post">
{{csrf_field()}}
{{method_field('DELETE')}}
<button type="submit" class="btn btn-danger" >Delete</button>
</form>
</td>
</tr>
@endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

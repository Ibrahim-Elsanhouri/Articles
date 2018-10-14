@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="btn-group pull-right">
                <a href="{{ route('posts.store') }}" class="btn btn-default btn-small">Add New Post</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Your Posts</h3>
                 

                    <table class="table table-striped">
<tr>
<th>Post Title</th> <th>Created at</th>
<th>Edit Post</th>
<th>Delete Post</th>
</tr>
@foreach($posts as $post)
<tr>
<td>{{$post->title}}</td>
<td>{{$post->created_at}}</td>
<td><a href="{{ route('posts.edit' , $post->id) }}" class="btn btn-primary">Edit</a></td>
<td>
<form action=" {{route('posts.destroy' , $post->id )}} " method="post">
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

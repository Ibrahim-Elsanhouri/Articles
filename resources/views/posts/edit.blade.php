@extends('layouts.app')
@section('content')
   
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{$post->title}}</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('posts.update' , $post->id)}}">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Post Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"  value="{{$post->title}}">

                           
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="body" class="col-md-4 control-label">Post Body</label>

                            <div class="col-md-6">
                            <textarea id="body" type="text" class="form-control" name="body" class="ckeditor">{{$post->body}}</textarea>
                            
                            </div>
                        </div>

             


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit a Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')
@section('content')
   
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add a new Post</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Post Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"  required autofocus>

                           
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="body" class="col-md-4 control-label">Post Body</label>

                            <div class="col-md-6">
                            <textarea id="body" type="text" class="form-control" name="body"></textarea>
                            
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="url" class="col-md-4 control-label">Post Image</label>

                            <div class="col-md-6">
                                <input id="url" type="file" class="form-control" name="url"  >

                           
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tags" class="col-md-4 control-label">Post Tags</label>


                              <div class="col-md-6">
<select name="tags[]" class="form-control tags" multiple>
@foreach($tags as $tag)
<option value="{{$tag->id}}">{{$tag->title}}</option>
@endforeach
</select>
                           
                            </div>
<!--
<select name="tags[]" class="form-control" multiple>
@foreach($tags as $tag)
<option value="{{$tag->id}}">{{$tag->title}}</option>
@endforeach
</select> -->                            
                        </div>
             


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add a Post
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
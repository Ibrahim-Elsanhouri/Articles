@extends('layouts.app')
@section('content')
   
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Comment </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route ('comments.update' , $comment->id) }}">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}


                        <div class="form-group">
                            <label for="body" class="col-md-4 control-label">Comment Body </label>

                            <div class="col-md-6">
                                <input id="body" type="text" class="form-control" name="body"  value="{{$comment->body}}">

                           
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="body" class="col-md-4 control-label">Comment  Approved</label>

                            <div class="col-md-6">
<select class="form-control" name="approved">
<option value="1">Approved</option>
<option value="0">Not approved</option>

</select>                            
                            </div>
                        </div>

             


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit a Comment
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
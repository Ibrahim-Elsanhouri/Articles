@extends('layouts.app')
@section('content')
   
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contact US</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('contactsend') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"  required autofocus>

                           
                            </div>
                        </div>


                           <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"  required autofocus>

                           
                            </div>
                        </div>



                           <div class="form-group">
                            <label for="title" class="col-md-4 control-label">subject</label>

                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control" name="subject"  required autofocus>

                           
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-md-4 control-label">Message Body</label>

                            <div class="col-md-6">
                            <textarea id="body" type="text" class="form-control" name="body"></textarea>
                            
                            </div>
                        </div>

             


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                 Send an Email
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
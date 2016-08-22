@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Add user</div></h2>
        {!! Form::open(array('action' => 'Admin\AdminController@usersAddPost',  'enctype' => 'multipart/form-data')) !!}
        <div class="form-group">
            <button type="submit" class="btn btn-success "><i class="fa fa-floppy-o"></i> Save</button>
            <button type="button" class="btn btn-primary " onclick="window.location = '/admin/users'"><i class="fa fa-close"></i> Don't save</button>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Info of user</div>
            <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name','Name') !!}
                            {!! Form::text('name' , $value = null , $attributes = ['placeholder' => 'Name' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->users->first('name') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email','Email') !!}
                            {!! Form::text('email' , $value = null , $attributes = ['placeholder' => 'Email' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->users->first('email') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('password','Password') !!}
                            {!! Form::password('password'  , $attributes = ['placeholder' => 'Your Password' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->users->first('password') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('repassword','Repeat Password') !!}
                            {!! Form::password('repassword'  , $attributes = ['placeholder' => 'Repeat Your Password' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->users->first('repassword') }}</div></h5>
                    </div>
                </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop
@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Delete user</div></h2>
        {!! Form::open(array('action' => 'Admin\AdminController@usersDeletePost',  'enctype' => 'multipart/form-data')) !!}
        {!! Form::hidden('id',"{$dataAll->id}") !!}
        <div class="form-group">
            <button type="submit" class="btn btn-danger "><i class="fa fa-trash-o"></i> Delete</button>
            <button type="button" class="btn btn-primary " onclick="window.location = '/admin/users'"><i class="fa fa-close"></i> Don't Delete</button>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Info of user</div>
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name' , "{$dataAll->name}" , $attributes = ['readonly','placeholder' => 'Name' , 'class' => 'form-control']) !!}
                    </div>
                    <h5><div class="label label-danger">{{ $errors->users->first('name') }}</div></h5>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('email','Email') !!}
                        {!! Form::text('email' , "{$dataAll->email}" , $attributes = ['readonly','placeholder' => 'Email' , 'class' => 'form-control']) !!}
                    </div>
                    <h5><div class="label label-danger">{{ $errors->users->first('email') }}</div></h5>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop
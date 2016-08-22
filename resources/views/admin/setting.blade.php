@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Setting</div></h2>
        {!! Form::open(array('action' => 'Admin\AdminController@settingPost')) !!}
            {!! Form::hidden('id' , $data->id) !!}
            <div class="form-group">
                <button type="submit" class="btn btn-success "><i class="fa fa-floppy-o"></i> Change</button>
                <button type="button" class="btn btn-primary " onclick="window.location = '/admin'"><i class="fa fa-close"></i> Don't change</button>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Info of user</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name','Name') !!}
                            {!! Form::text('name' , "{$data->name}" , $attributes = ['placeholder' => 'Your Name' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->setting->first('name') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email','Email') !!}
                            {!! Form::text('email' , "{$data->email}" , $attributes = ['placeholder' => 'Your Email' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->setting->first('email') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('password','Password') !!}
                            {!! Form::password('password'  , $attributes = ['placeholder' => 'Your Password' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->setting->first('password') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('repassword','Repeat Password') !!}
                            {!! Form::password('repassword'  , $attributes = ['placeholder' => 'Repeat Your Password' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->setting->first('repassword') }}</div></h5>
                    </div>
                </div>
            </div>

        {!! Form::close() !!}
    </div>
@stop
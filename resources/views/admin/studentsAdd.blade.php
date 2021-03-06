@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Add student</div></h2>
        {!! Form::open(array('action' => 'Admin\AdminController@studentsAddPost',  'enctype' => 'multipart/form-data')) !!}
        <div class="form-group">
            <button type="submit" class="btn btn-success "><i class="fa fa-floppy-o"></i> Save</button>
            <button type="button" class="btn btn-primary " onclick="window.location = '/admin/students'"><i class="fa fa-close"></i> Don't save</button>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Info of student</div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-6 col-lg-8">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('stuid','ID student') !!}
                            {!! Form::text('stuid' , $value = null , $attributes = ['placeholder' => 'ID of student' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('stuid') }}</div></h5>
                        <div class="form-group">
                            {!! Form::label('name','Name') !!}
                            {!! Form::text('name' , $value = null , $attributes = ['placeholder' => 'Name' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('name') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email','Email') !!}
                            {!! Form::text('email' , $value = null , $attributes = ['placeholder' => 'Email' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('email') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('year','Enter of year') !!}
                            {!! Form::text('year' , $value = null , $attributes = ['placeholder' => 'Enter of year' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('year') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('field','Field') !!}
                            {!! Form::text('field' , $value = null , $attributes = ['placeholder' => 'Field' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('field') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('nationalId','National ID') !!}
                            {!! Form::text('nationalId' , $value = null , $attributes = ['placeholder' => 'National ID' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('nationalId') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('password','Password') !!}
                            {!! Form::password('password'  , $attributes = ['placeholder' => 'Your Password' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('password') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('repassword','Repeat Password') !!}
                            {!! Form::password('repassword'  , $attributes = ['placeholder' => 'Repeat Your Password' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('repassword') }}</div></h5>
                    </div>
                </div>
                <div class="col-xs-6 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('image','Image') !!}
                        {!! Form::file('image' , $attributes =['class' => 'form-control' , 'accept' => 'image/*']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::textarea('desc' , $value = null , $attributes = ['placeholder' => 'Description for ads' , 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop
@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Delete student</div></h2>
        {!! Form::open(array('action' => 'Admin\AdminController@studentsDeletePost',  'enctype' => 'multipart/form-data')) !!}
        {!! Form::hidden('id',"{$dataAll->id}") !!}
        <div class="form-group">
            <button type="submit" class="btn btn-danger "><i class="fa fa-trash-o"></i> Delete</button>
            <button type="button" class="btn btn-primary " onclick="window.location = '/admin/students'"><i class="fa fa-close"></i> Don't delete</button>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Info of student</div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-6 col-lg-8">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('stuid','ID student') !!}
                            {!! Form::text('stuid' , "{$dataAll->stuId}" , $attributes = ['readonly','placeholder' => 'ID of student' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('stuid') }}</div></h5>
                        <div class="form-group">
                            {!! Form::label('name','Name') !!}
                            {!! Form::text('name' , "{$dataAll->name}" , $attributes = ['readonly','placeholder' => 'Name' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('name') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email','Email') !!}
                            {!! Form::text('email' , "{$dataAll->email}" , $attributes = ['readonly','placeholder' => 'Email' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('email') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('year','Enter of year') !!}
                            {!! Form::text('year' , "{$dataAll->year}" , $attributes = ['readonly','placeholder' => 'Enter of year' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('year') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('field','Field') !!}
                            {!! Form::text('field' ,"{$dataAll->field}", $attributes = ['readonly','placeholder' => 'Field' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('field') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('nationalId','National ID') !!}
                            {!! Form::text('nationalId' , "{$dataAll->nationalId}" , $attributes = ['readonly','placeholder' => 'National ID' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->students->first('nationalId') }}</div></h5>
                    </div>
                </div>
                <div class="col-xs-6 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('image','Image') !!}
                        {!! Form::image ("/uploads/img/{$dataAll->img}" ,'logoShow' , $attributes = ['class' => 'img-responsive']) !!}
                        {!! Form::hidden('imgName',"{$dataAll->img}") !!}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop
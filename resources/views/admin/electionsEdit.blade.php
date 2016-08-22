@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Edit election</div></h2>
        {!! Form::open(array('action' => 'Admin\AdminController@electionsEditPost',  'enctype' => 'multipart/form-data')) !!}
            {!! Form::hidden('id',"{$dataAll->id}") !!}
        <div class="form-group">
            <button type="submit" class="btn btn-success "><i class="fa fa-floppy-o"></i> Save</button>
            <button type="button" class="btn btn-primary " onclick="window.location = '/admin'"><i class="fa fa-close"></i> Don't save</button>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Info of election</div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-6 col-lg-8">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name','Name') !!}
                            {!! Form::text('name' , "{$dataAll->name}" , $attributes = ['placeholder' => 'Name' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->elections->first('name') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('count','Count of choice') !!}
                            {!! Form::number('count' , "{$dataAll->countChoice}" , $attributes = ['placeholder' => 'count' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->elections->first('count') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('count2','Maximum of choice') !!}
                            {!! Form::number('count2' , "{$dataAll->countChoice2}" , $attributes = ['placeholder' => 'count' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->elections->first('count2') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('dateStart','Date of start') !!}
                            {!! Form::date('dateStart' ,"{$dataAll->dateStart}" , $attributes = ['placeholder' => 'Date of start' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->elections->first('dateStart') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('dateEnd','Date of end') !!}
                            {!! Form::date('dateEnd' ,"{$dataAll->dateEnd}", $attributes = ['placeholder' => 'Date of end' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->elections->first('dateEnd') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('limitType','Type of limit') !!}
                            {!! Form::select ('limitType' , array('N' => 'None' ,'F' => 'Field' , 'Y' => 'Year') , "{$dataAll->limitType}" ,$attributes = ['class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->elections->first('limitType') }}</div></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('description','Description') !!}
                            {!! Form::textarea('description'  , "{$dataAll->description}" , $attributes = ['placeholder' => 'Your description' , 'class' => 'form-control']) !!}
                        </div>
                        <h5><div class="label label-danger">{{ $errors->elections->first('description') }}</div></h5>
                    </div>

                </div>
                <div class="col-xs-6 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('image','Image') !!}
                        {!! Form::image ("/uploads/img/{$dataAll->logo}" ,'logoShow' , $attributes = ['class' => 'img-responsive']) !!}
                        {!! Form::hidden('imgName',"{$dataAll->logo}") !!}
                        {!! Form::file('image' , $attributes =['class' => 'form-control' , 'accept' => 'image/*']) !!}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop
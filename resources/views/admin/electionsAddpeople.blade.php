@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">People</div></h2>
        @if(Session::has('message'))
            <div class="alert alert-info">{{Session::get('message')}}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ID of student</th>
                    <th>Name of student</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($studentAll != null) { $count=1; foreach ($studentAll as $election) : ?>
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$election->stuId}}</td>
                    <td>{{$election->name}}</td>
                    <td>
                        <button type="submit" class="btn btn-danger" onclick="window.location = '/admin/election/addpeople/{{$idE}}/delete/{{$election->stuId}}'"><i class="fa fa-trash-o"></i> Delete</button>
                    </td>
                </tr>
                <?php ++$count; endforeach; }?>
                </tbody>
            </table>
            {!! Form::open(array('action' => 'Admin\AdminController@electionsAddpeoplePost')) !!}
                {!! Form::hidden('id',"{$idE}") !!}
                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Add</button>
                </div>
                <div class="form-group">
                    {!! Form::label('stuId', 'ID of student') !!}
                    {!! Form::text('stuId',$value = null, $attributes=['placeholder' => 'ID of Student' , 'class' => 'form-control']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@extends('layouts.user.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Select</div></h2>

        @if(Session::has('message'))
            <div class="alert alert-info">{{Session::get('message')}}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name of student</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                {!! Form::open(array('action' => 'User\UserController@electionSelectPost')) !!}
                    {!! Form::hidden('minchoice',"{$countChoice}") !!}
                    {!! Form::hidden('maxchoice',"{$countChoice2}") !!}
                    {!! Form::hidden('election_id',"{$idE}") !!}
                <?php foreach ($studentAll as $student) : ?>
                <tr>
                    <td><input type="checkbox" name="select[]" value="{{$student->stuId}}"></td>
                    <td>{{$student->name}}</td>
                    <td>
                        <button type="button" class="btn btn-default" onclick="window.location = '/page/{{$student->id}}'"><i class="fa fa-eye"></i> View page</button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <div class="form-group">
                    <h3><label class="label label-info">You Have {{$countChoice}} Minimum Choice</label></h3><br>
                    <h3><label class="label label-info">You Have {{$countChoice2}} Maximum Choice</label></h3><br>
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                    <label>Empty </label>
                    <input type="checkbox" name="zero" value="zero" />
                </div>
                {!! Form::close() !!}
                </tbody>
            </table>
        </div>
    </div>
@stop
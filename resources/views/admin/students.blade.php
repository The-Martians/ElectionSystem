@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Students</div></h2>
        <div class="form-group">
            <button type="button" class="btn btn-success"  onclick="window.location = '/admin/students/add'"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add students</button>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-info">{{Session::get('message')}}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ID student</th>
                    <th>Name of student</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $count=1; foreach ($dataAll as $student) : ?>
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$student->stuId}}</td>
                        <td>{{$student->name}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="window.location = '/admin/students/edit/{{$student->id}}'"><i class="fa fa-pencil"></i> Edit</button>
                            <button type="button" class="btn btn-danger" onclick="window.location = '/admin/students/delete/{{$student->id}}'"><i class="fa fa-trash-o"></i> Delete</button>
                        </td>
                    </tr>
                <?php ++$count; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
@stop
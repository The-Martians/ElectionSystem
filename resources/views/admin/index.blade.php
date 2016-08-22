@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Elections</div></h2>
        <div class="form-group">
            <button type="button" class="btn btn-success"  onclick="window.location = '/admin/election/add'"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add election</button>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-info">{{Session::get('message')}}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name of election</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $count=1; foreach ($dataAll as $election) : ?>
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$election->name}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="window.location = '/admin/election/edit/{{$election->id}}'"><i class="fa fa-pencil"></i> Edit</button>
                        <button type="button" class="btn btn-danger" onclick="window.location = '/admin/election/delete/{{$election->id}}'"><i class="fa fa-trash-o"></i> Delete</button>
                        <button type="button" class="btn btn-success" onclick="window.location = '/admin/election/addpeople/{{$election->id}}'"><i class="fa fa-user-plus"></i> Add people</button>
                        <button type="button" class="btn btn-default" onclick="window.location = '/admin/election/view/{{$election->id}}'"><i class="fa fa-eye"></i> View state</button>
                    </td>
                </tr>
                <?php ++$count; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
@stop
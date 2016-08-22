@extends('layouts.user.main')
@section('content')
    <div class="container">
        <h2><div class="page-header">Elections</div></h2>
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
                <?php $count=1; foreach ($result as $election) : ?>
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$election->name}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="window.location = '/select/{{$election->id}}'"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Select</button>
                        <button type="button" class="btn btn-default" onclick="window.location = '/view/{{$election->id}}'"><i class="fa fa-eye"></i> View state</button>
                    </td>
                </tr>
                <?php ++$count; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
@stop
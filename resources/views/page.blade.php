<!DOCTYPE html>
<html>
<head>
    <title>
        Election System Beta
    </title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/custom.css" type="text/css" />
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    @if(\Session::has('admin'))
        <button type="button" class="btn btn-primary" onclick="window.location = '/admin'"><i class="fa fa-times"></i> Close</button><br><hr>
    @endif
    @if(\Session::has('user'))
        <button type="button" class="btn btn-primary" onclick="window.location = '/'"><i class="fa fa-times"></i> Close</button><br><hr>
    @endif
        <div class="col-md-4">
            <img src='/uploads/img/{{$data->img}}' class="img-circle img-responsive img-thumbnail" width="100%" /><br>
        </div>
        <div class="col-md-4">
            <h2><div class="page-header">{{$data->name}}</div></h2><br>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <pre>{{$data->desc}}</pre>
        </div>


        <div class="col-md-2"></div>
</div>
</body>
</html>
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
<div class="col-md-4"></div>
<div class="col-md-4 margin-top-20">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Register Admin</div>
            <div class="panel-body">
                {!! Form::open(array('action' => 'Admin\AuthController@registerAdminPost')) !!}
                <div class="form-group">
                    <label class="label label-danger">{{ $errors->register->first('invalid') }}</label>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-chevron-right fa-fw"></i></span>
                        {!! Form::text('name',$value = null ,$attributes = ['class' => 'form-control' , 'placeholder' => 'Your name']) !!}
                    </div>
                    <h5><div class="label label-danger">{{ $errors->register->first('name') }}</div></h5>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                        {!! Form::text('email',$value = null ,$attributes = ['class' => 'form-control' , 'placeholder' => 'Your email address']) !!}
                    </div>
                    <h5><div class="label label-danger">{{ $errors->register->first('email') }}</div></h5>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        {!! Form::password('password', $attributes = ['class' => 'form-control' , 'placeholder' => 'Your Password']) !!}
                    </div>
                    <h5><div class="label label-danger">{{ $errors->register->first('password') }}</div></h5>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        {!! Form::password('repassword', $attributes = ['class' => 'form-control' , 'placeholder' => 'Repeat Password']) !!}
                    </div>
                    <h5><div class="label label-danger">{{ $errors->register->first('repassword') }}</div></h5>
                </div>

                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user-plus"></i> Register</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="col-md-4"></div>
</body>
</html>
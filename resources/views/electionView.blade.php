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
        <button type="button" class="btn btn-primary" onclick="window.location = '/admin'"><i class="fa fa-times"></i> Close</button>
        @endif
    @if(\Session::has('user'))
            <button type="button" class="btn btn-primary" onclick="window.location = '/'"><i class="fa fa-times"></i> Close</button>
        @endif
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID of student</th>
                <th>Name of student</th>
                <th>Count</th>
            </tr>
            </thead>
            <tbody>
            <?php  if($result != null){foreach ($result as $r) : ?>
            <tr>
                <td>{{$r['stuid']}}</td>
                <td>{{$r['name']}}</td>
                <td>
                    {{$r['count']}}
                </td>
            </tr>
            <?php endforeach; }?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>
        Election System Beta
    </title>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/custom.css"/>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Election System</a>
            </div>
            @if(Session::has('admin'))
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/admin"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
                        <li><a href="/admin/users"><i class="fa fa-briefcase" aria-hidden="true"></i> Users</a></li>
                        <li><a href="/admin/students"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Students</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/admin/setting" title="Open Setting Page"><i class="fa fa-user"></i> {{$data->name}}</a></li>
                        <li><a href="/admin/logout" title="Logout"><i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            @else
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="navbar-text"><i class="fa fa-sign-in"></i> Login</li>

                    </ul>
                </div><!--/.nav-collapse -->
            @endif
        </div>
    </nav>
</header>
<section>
    @yield('content')
</section>
</body>
</html>
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
            @if(Session::has('user'))
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li><a href="/"><i class="fa fa-bars" aria-hidden="true"></i> Election</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/setting" title="Open Setting Page"><i class="fa fa-user"></i> {{$data->name}}</a></li>
                        <li><a href="/logout" title="Logout"><i class="fa fa-sign-out"></i></a></li>
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
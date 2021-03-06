<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Home</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            @if (Auth::check())
                <li><a href="{{ url('/client/info') }}">Info</a></li>
            @endif
            @if (Auth::check() && Auth::user()->isAdmin())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Admin<b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/admin/user') }}">Users</a></li>
                        <li><a href="{{ url('/admin/star') }}">Stars</a></li>
                        <li><a href="{{ url('/admin/item') }}">Items</a></li>
                    </ul>
                </li>
            @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">Logged in as {{ Auth::user()->name }}<b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

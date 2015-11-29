<nav class="navbar navbar-inverse">
    <a class="navbar-brand" href="/">Home</a>
    <ul class="nav navbar-nav">
        @if (Auth::guest())
            <li><a href="{{ url('/auth/login') }}">Login</a></li>
            <li><a href="{{ url('/auth/register') }}">Register</a></li>
        @else
            <li class="navbar-text"><p>Logged in as <a href="#" class="navbar-link">{{ Auth::user()->name }}</a></p></li>
            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
        @endif
    </ul>
</nav>

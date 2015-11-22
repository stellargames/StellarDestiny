<nav>
    <div>
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
        </ul>

        <ul>
            @if (Auth::guest())
                <li><a href="{{ url('/auth/login') }}">Login</a></li>
                <li><a href="{{ url('/auth/register') }}">Register</a></li>
            @else
                <li>
                    Logged in as <a href="#">{{ Auth::user()->name }}</a>
                    <ul>
                        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>

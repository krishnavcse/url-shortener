<aside class="col-12 col-md-2 p-0 bg-dark flex-shrink-1">
    <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-2">
        <div class="collapse navbar-collapse ">
            <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                <li>
                    <b> Hello </b> {{ Auth::user()->name }}
                </li>
                <li class="nav-item {{ basename($_SERVER['REQUEST_URI']) == 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link pl-0" href="{{ route('dashboard') }}"><i class="fa fa-bullseye fa-fw"></i> <span class="d-none d-md-inline">Dashboard</span></a>
                </li>
                <li class="nav-item {{ basename($_SERVER['REQUEST_URI']) == 'users' ? 'active' : '' }}">
                    <a class="nav-link pl-0" href="{{ route('users') }}"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Users</span></a>
                </li>
                <li class="nav-item {{ basename($_SERVER['REQUEST_URI']) == 'short-urls' ? 'active' : '' }}">
                    <a class="nav-link pl-0" href="{{ route('short-urls') }}"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Shortened URLs</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('user/logout') }}"><i class="fa fa-sign-out"></i> <span class="d-none d-md-inline">Logout</span></a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
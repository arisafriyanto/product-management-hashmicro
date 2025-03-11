<nav class="navbar navbar-expand py-1 px-3 border-bottom">
    <button class="btn" id="sidebar-toggle" type="button">
        <i class="fa-solid fa-bars-staggered rotate-180"></i>
    </button>
    <div class="navbar-collapse navbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                    <img src="{{ asset('images/profile.png') }}" class="avatar img-fluid rounded-circle border"
                        alt="Avatar">
                </a>
                <div class="dropdown-menu dropdown-menu-end">

                    <form action="{{ route('logout') }}" method="POST" class="d-inline-block py-0 dropdown-item">
                        @csrf
                        <button type="submit" class="dropdown-item px-0">
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

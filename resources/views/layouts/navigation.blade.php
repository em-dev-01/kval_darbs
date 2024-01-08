<nav class="navbar navbar-expand-sm navbar-dark"
    style="background-color: #081c15; color: #d8f3dc; padding-left: 4rem; padding-right: 4rem;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" style="color: #d8f3dc;">
            AR Builders
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                @guest
                    <li class="nav-item mx-2"><a href="#" style="color: #d8f3dc; text-decoration: none;">Par mums</a></li>
                    <li class="nav-item mx-2"><a href="#galerija" style="color: #d8f3dc; text-decoration: none;">Galerija</a></li>
                    <li class="nav-item mx-2"><a href="#" style="color: #d8f3dc; text-decoration: none;">Kontakti</a></li>
                @endguest
                @auth
                    @if (Auth::user()->isManager())
                        <li class="nav-item mx-2 {{ Request::is('users') ? 'active' : '' }}"><a href="{{ route('users.index') }}" class="nav-link">Darbinieki</a></li>
                        <li class="nav-item mx-2 {{ Request::is('client_requests') ? 'active' : '' }}"><a href="{{ route('client_requests.index') }}" class="nav-link">Pieteikumi 
                            @if ($unreadCount > 0)
                                <span id="notificationBadge" class="badge badge-danger">{{ $unreadCount }}</span>
                            @endif
                            </a>
                        </li>
                    @endif
                    <li class="nav-item mx-2 {{ Request::is('projects') ? 'active' : '' }}"><a href="{{ route('projects.index') }}" class="nav-link">Projekti</a></li>
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color: #d8f3dc;">Pieteikties</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" style="color: #d8f3dc;">Reģistrēties</a></li>
                    @endif
                @else
                @if (Auth::user()->isManager())
                <li class="nav-item">
                    <a href="{{ route('projects.create') }}" class="btn btn-primary btn-md  active" role="button" aria-pressed="true" style="background-color: #1B4332; border-color: #52b788;">
                        Jauns projekts
                    </a>
                </li>
                    
                @endif
                    
                    <li class="nav-item pt-1">
                        <a id="" class="nav-link" href="#" role="" style="color: #d8f3dc;">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item pt-1">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">Atslēgties
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

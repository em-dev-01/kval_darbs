<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #081c15; color: #d8f3dc; padding-left: 4rem; padding-right: 4rem;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" style="color: #d8f3dc;">
           AR Builders
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @guest
                    <li class="nav-item mx-2"><a href="#" style="color: #d8f3dc; text-decoration: none;">Par mums</a></li>
                    <li class="nav-item mx-2"><a href="#galerija" style="color: #d8f3dc; text-decoration: none;">Galerija</a></li>
                    <li class="nav-item mx-2"><a href="#" style="color: #d8f3dc; text-decoration: none;">Kontakti</a></li>
                @endguest
                @auth
                    <li class="nav-item mx-2 {{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{route('dashboard')}}" class="nav-link">Dashboard</a></li>
                    <li class="nav-item mx-2 {{ Request::is('projects') ? 'active' : '' }}"><a href="{{route('projects.index')}}" class="nav-link">Projekti</a></li>
                    <li class="nav-item mx-2 {{ Request::is('users') ? 'active' : '' }}"><a href="{{route('users.index')}}" class="nav-link">Darbinieki</a></li>
                    <li class="nav-item mx-2 {{ Request::is('client_requests') ? 'active' : '' }}"><a href="{{route('client_requests.index')}}" class="nav-link">Pieteikumi</a></li>
                @endauth
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color: #d8f3dc;">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('register')}}" style="color: #d8f3dc;">Register</a></li>
                    @endif
                @else
                    <li class="nav-item">
                        <a href="{{route('projects.create')}}" class="btn btn-primary btn-md active" role="button" aria-pressed="true" style="background-color: #1B4332; border-color: #52b788;">
                            Jauns projekts
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #d8f3dc;">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

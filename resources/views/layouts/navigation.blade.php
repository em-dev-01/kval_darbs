<nav class="navbar navbar-expand-sm navbar-dark bg-dark px-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'AR Builders') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
              @guest
                <li class="nav-item mx-2"><a href="#">Par mums</a></li>
                <li class="nav-item mx-2"><a href="#galerija">Galerija</a></li>
                <li class="nav-item mx-2"><a href="#">Kontakti</a></li>
              @endguest
              @auth
                <li class="nav-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="nav-item mx-2"><a href="{{route('projects.index')}}">Projekti</a></li>
                <li class="nav-item mx-2"><a href="{{route('users.index')}}">Darbinieki</a></li>
                <li class="nav-item mx-2"><a href="{{route('client_requests.index')}}">Pieteikumi</a></li>
              @endauth
              
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
                    @endif
                @else
                    <li class="nav-item">
                        <a href="{{route('projects.create')}}" class="btn btn-primary btn-md active" role="button" aria-pressed="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                            </svg>
                            Jauns projekts
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

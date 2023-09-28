<?php
$name = Auth::user()->name ?? null;
$firstLetter = strtoupper(substr($name, 0, 1));
?>

<header class="sticky-top">
    <div class="container">
        <div class="row px-2 px-sm-0">
            <!-- Left side -->
            <!-- Ricerca attiva solo su schermata home -->
            @if (Route::is('guest.home'))
                <div class="col-md-1 col-xl-4 d-none d-md-flex justify-content-start">
                    <a class="logo" href="http://localhost:5174/">
                        <img src="{{ asset('img/logo.png') }}" alt="logo">
                        <h1 class="d-none d-xl-inline-block">boolbnb</h1>
                    </a>
                </div>

                <!-- Center -->
                <div class="col-11 col-md-6 col-xl-4">
                    <div class="filter-menu">
                        <button class="small-label">
                            <div>Ovunque</div>
                        </button>
                        <span class="separator"></span>

                        <button class="small-label">
                            <div>Qualunque settimana</div>
                        </button>
                        <span class="separator"></span>

                        <button class="small-label">
                            <div>Aggiungi ospiti</div>
                            <div class="icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                        </button>
                    </div>
                </div>
            @else
                <div class="col-11 col-md-7 col-xl-8 d-flex justify-content-start">
                    <a class="logo" href="http://localhost:5174/">
                        <img src="{{ asset('img/logo.png') }}" alt="logo">
                        <h1>boolbnb</h1>
                    </a>
                </div>
            @endif

            <!-- Right side -->
            <div class="col-1 col-md-5 d-flex col-xl-4 justify-content-end gap-2">
                <div class="d-none d-md-flex">
                    <a href="{{ route('admin.apartments.create') }}" class="button-light">Apri un Boolbnb</a>

                    <button class="button-light"><i class="fa-solid fa-globe"></i></button>
                </div>

                {{-- Dropdown --}}
                <div class="login-menu dropdown">
                    <button class="dropdown-toggle d-none d-md-flex align-items-center" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-bars"></i>
                        @guest
                            <div class="user ms-2">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @else
                            <div class="user ms-2">
                                <span id="admin-name">{{ $firstLetter }}</span>
                            </div>
                        @endguest
                    </button>

                    <button class="dropdown-toggle d-flex d-md-none align-items-center" data-bs-toggle="dropdown">
                        @guest
                            <div class="user">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @else
                            <div class="user">
                                <span id="admin-name">{{ $firstLetter }}</span>
                            </div>
                        @endguest
                    </button>

                    <ul class="dropdown-menu">
                        @guest
                            <li><a class="dropdown-item" href="{{ route('login') }}"><b>Accedi</b></a></li>
                            @if (Route::has('register'))
                                <li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a></li>
                            @endif
                        @else
                            <li><a class="dropdown-item" href="{{ route('admin.apartments.index') }}">I miei Boolbnb</a>
                            </li>
                            <li><a class="dropdown-item " href="{{ route('admin.home') }}">Il mio Profilo</a></li>
                            <li><a class="dropdown-item disabled" href="#">Messaggi</a></li>
                            <li><a class="dropdown-item disabled" href="#">Notifiche</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="{{ route('admin.apartments.create') }}">Apri un Boolbnb</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('profile') }}">Account</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();  document.getElementById('logout-form').submit();">Esci</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<?php
$name = Auth::user()->name ?? null;
$firstLetter = strtoupper(substr($name, 0, 1));
?>

<header class="sticky-top">
    <div class="container h-100">
        <div class="row flex-nowrap px-2 px-sm-0 justify-content-center align-items-center h-100">
            <!-- Left side -->
            <div class="col col-md-1 col-xl-4 d-none d-md-flex justify-content-start">
                <a class="logo" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="logo">
                    <h1 class="d-none d-xl-inline-block">boolbnb</h1>
                </a>
            </div>

            <!-- Center -->
            <div class="col col-11 col-md-6 col-xl-4">
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

            <!-- Right side -->
            <div class="d-flex align-items-center d-md-none col col-1 ms-2">
                <div class="filter"><i class="fa-solid fa-sliders"></i></div> <!-- Filtri avanzati (DA FARE) -->
            </div>

            <div class="d-none d-md-flex col-1 col-md-5 col-xl-4 justify-content-end gap-2">
                <a href="#" class="button-light">Affitta con Boolbnb</a>

                <button class="button-light"><i class="fa-solid fa-globe"></i></button>

                {{-- Dropdown --}}
                <div class="login-menu dropdown">
                    <button class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-bars"></i>
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
                            <hr>
                            <li><a class="dropdown-item" href="#">Affitta con Boolbnb</a></li>
                        @else
                            <li><a class="dropdown-item" href="#">Messaggi</a></li>
                            <li><a class="dropdown-item" href="#">Notifiche</a></li>
                            <li><a class="dropdown-item" href="#">Viaggi</a></li>
                            <li><a class="dropdown-item" href="#">Preferiti</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="#">Affitta con Boolbnb</a></li>
                            <li><a class="dropdown-item" href="#">Account</a></li>
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

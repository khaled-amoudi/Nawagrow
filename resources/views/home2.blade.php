@extends('layout-custom.main')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            {{-- <i class="fa-solid fa-bell position-relative h4 text-secondary mt-1 p-5">
                <span
                    class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </i> --}}

            {{-- <button type="button" class="btn btn-primary position-relative">
                Inbox

            </button> --}}
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle position-relative" href="#" role="button"
                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown link
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        99+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                    {{-- @if (user()->auth())
                        @foreach ($notifications as $notification)
                            <li><a class="dropdown-item" href="#">{{ $notification->type }}</a></li>
                        @endforeach
                    @endif --}}

                </ul>
            </div>



            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link">Home</a>
                            </li>
                        @else
                            <li class="nav-item">

                                <a href="{{ route('login') }}" class="nav-link">Log
                                    in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>






@endsection

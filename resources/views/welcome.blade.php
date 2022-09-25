<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Sederhana</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary" style="color: #000000">

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <a class="navbar-brand" href="/">Blog Sederhana</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success px-5 text-white" href="{{ route('login') }}">Sign In</a>
                    </li>
                @endguest
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                        <img class="img-profile rounded-circle" src="{{ asset('sb-admin/img/undraw_profile.svg') }}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="/">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Home
                        </a>

                        @if (Auth::check() && Auth::user()->roles === 'ADMIN')
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-fw fa-tachometer-alt mr-2 text-gray-400"></i>
                                Dashboard
                            </a>
                        @elseif(Auth::check() && Auth::user()->roles === 'AUTHOR')
                            <a class="dropdown-item" href="{{ route('author.dashboard') }}">
                                <i class="fas fa-fw fa-tachometer-alt mr-2 text-gray-400"></i>
                                Dashboard
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal"
                            data-target="#logoutModal"
                            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </div>
                </li>
            </ul>

        </div>
    </nav>

    <div class="container">

        @foreach ($articles as $article)
            <div class="row mt-5 justify-content-center">

                <div class="col-md-12 col-lg-12">
                    <div class="card p-3">
                        <article>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="caption">
                                        <h3>{{ $article->title }}</h3>
                                        <small> {{ date('d-m-Y', strtotime($article->created_at)) }} |
                                            {{ $article->category->name }} | by {{ $article->user->name }}</small>
                                    </div>
                                    <center><img src="{{ asset('storage/article/' . $article->image) }}"
                                            width="30%" /></center>
                                    <p>{!! $article->content !!}</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>

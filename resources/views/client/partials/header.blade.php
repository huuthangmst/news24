<header>
    <style>
        .ri {
            float: right;
        }

    </style>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <nav class="container navbar navbar-expand-lg navbar-light ">
                <a class="navbar-brand" href="#"></a>
                {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#"></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i>{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Hello, {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu float-left" aria-labelledby="navbarDropdown">
                                @if ((Auth::user()->user_type)==0)
                                <a class="dropdown-item text-dark" href="/guest">Post</a>
                                @else
                                <a class="dropdown-item text-dark" href="/dashboard">Dashboard</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            <div class="header-mid d-none d-md-block">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="logo">
                                <a href="{{ route('news.index') }}"><img
                                        src="{{ asset('news_templates/assets/img/logo/logo1.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5">
                            <div class="header-banner f-right ">
                                <img src="" alt="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            {{-- <div class="column">
                                <button type="button" class="btn btn-primary">Login</button>
                                <button type="button" class="btn btn-primary">Register</button>
                            </div> --}}
                            {{-- <ul class="navbar-nav ms-auto">
                                <!-- Authentication Links -->
                                @guest
                                @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @endif

                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Hello, {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu float-left" aria-labelledby="navbarDropdown">
                                        @if ((Auth::user()->user_type)==0)
                                        <a class="dropdown-item text-dark" href="/guest">Post</a>
                                        @else
                                        <a class="dropdown-item text-dark" href="/dashboard">Dashboard</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                            <!-- sticky -->
                            <div class="sticky-logo">
                                <a href="index.html"><img src="" alt=""></a>
                            </div>
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-md-block">
                                <nav>
                                    <ul id="navigation">
                                        @foreach ($data_Categories as $cate_item)
                                        <li><a
                                                href="{{ route('news.categories', ['slug'=>$cate_item->slug]) }}">{{ $cate_item->name }}</a>
                                            <ul class="submenu">
                                                @foreach ($cate_item->topics as $topic_item)
                                                <li><a
                                                        href="{{ route('news.topics', ['slug'=>$topic_item->slug])}}">{{ $topic_item->name }}</a>
                                                </li>
                                                @endforeach

                                            </ul>
                                        </li>
                                        @endforeach

                                        {{-- <li><a href="index.html"></a></li>
                                        <li><a href="categori.html">Category</a></li>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="latest_news.html">Latest News</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="#">Pages</a>
                                            <ul class="submenu">
                                                <li><a href="elements.html">Element</a></li>
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="single-blog.html">Blog Details</a></li>
                                                <li><a href="details.html">Categori Details</a></li>
                                            </ul>
                                        </li> --}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <i class="fas fa-search special-tag"></i>
                                <div class="search-box">
                                    <form action="#">
                                        <input type="text" placeholder="Search">

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-md-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>

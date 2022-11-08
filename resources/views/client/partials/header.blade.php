<header>
    <style>
        .ri {
            float: right;
        }

    </style>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-sticky">
                
                <div class="container">
                    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">Navbar</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                            
                            </div>
                        </div>
                    </nav> --}}
                    <div class="row align-items-center col-md-12">
                        <div class="col-lg-9 col-md-9">
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-md-block">
                                <nav>
                                    <ul id="navigation">
                                        @foreach ($data_Categories as $cate_item)
                                            
                                            <li><a href="{{ route('news.categories', ['slug'=>$cate_item->slug]) }}">{{ $cate_item->name }}</a>
                                                <ul class="submenu">
                                                    @foreach ($cate_item->topics as $topic_item)
                                                        @if($topic_item != null)
                                                            <li><a href="{{ route('news.topics', ['slug'=>$topic_item->slug])}}">{{ $topic_item->name }}</a></li>
                                                        @endif
                                                    @endforeach
                                                    
                                                </ul>
                                            </li>
                                        @endforeach
                                        
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <!-- Main-menu -->
                            <div class="main-menu d-md-block">
                                <nav>
                                    <ul id="navigation" class='row'>
                                        {{-- <div class='col-xl-9 col-lg-9 col-md-9'>
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
                                        </div> --}}
                                        <div class='col-xl-12 col-lg-12 col-md-12'>
                                            @guest
                                                @if (Route::has('login'))
                                                <li class="nav-item">
                                                    <a class="nav-link text-dark" href="{{ route('login') }}"><i class="bi bi-box-arrow-left text-primary"></i> {{ __('Login') }}</a>
                                                </li>
                                                @endif

                                                @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="nav-link text-dark" href="{{ route('register') }}"><i class="bi bi-person-fill text-primary"></i>{{ __('Register') }}</a>
                                                </li>
                                                @endif
                                                @else
                                                <div class="nav-item dropdown">
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
                                                </div>
                                            @endguest
                                        </div>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        {{-- <div class="col-xl-2 col-lg-2 col-md-4">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <i class="fas fa-search special-tag"></i>
                                <div class="search-box">
                                    <form action="#">
                                        <input type="text" placeholder="Search">

                                    </form>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Mobile Menu -->
                        {{-- <div class="col-12">
                            <div class="mobile_menu d-block d-md-none"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>

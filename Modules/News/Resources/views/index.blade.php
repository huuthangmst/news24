@extends('client.layouts.client')
@section('title')
    <title>News -Trang chủ</title>
    </style>
@endsection
@section('content')
<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>Trending now</strong>
                            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    <li class="news-item">{{$first_post->title}}.
                                    </li>
                                    <li class="news-item">{{$tech->title}}.
                                    </li>
                                    <li class="news-item">{{$ent->title}}.
                                    </li>
                                    <li class="news-item">{{$new->title}}.
                                    </li>
                                    
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <a href="{{ route('news.detail', ['slug'=>$first_post->slug])}}"><img src="{{$first_post->feature_image_path}}" alt=""></a>
                                <div class="trend-top-cap">
                                    <span>For you!</span>
                                    <h2><a href="{{ route('news.detail', ['slug'=>$first_post->slug])}}">{{$first_post->title}}</a></h2>
                                </div>
                            </div>
                        </div>
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <a href="{{ route('news.detail', ['slug'=>$tech->slug])}}"><img src="{{$tech->feature_image_path}}" alt=""></a>
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <span class="color1">Công nghệ</span>
                                            <h4><a href="{{ route('news.detail', ['slug'=>$tech->slug])}}">{{$tech->title}}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <a href="{{ route('news.detail', ['slug'=>$ent->slug])}}"><img src="{{$ent->feature_image_path}}" alt=""></a>
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <span class="color2">Giải trí</span>
                                            <h4>
                                                <h4><a href="{{ route('news.detail', ['slug'=>$ent->slug])}}">{{$ent->title}}</a></h4>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <a href="{{ route('news.detail', ['slug'=>$new->slug])}}"><img src="{{$new->feature_image_path}}" alt=""></a>
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <span class="color3">Thời sự</span>
                                            <h4><a href="{{ route('news.detail', ['slug'=>$new->slug])}}">{{$new->title}}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">
                        @foreach ($posts_data as $post)
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-img">
                                    <img height="100" width="100" src="{{$post->feature_image_path}}" alt="">
                                </div>
                                <div class="trand-right-cap">
                                    <span class="text-danger">News</span><i class="	fas fa-eye text-secondary"> {{ count($post->post_view) }}</i>
                                    <h6><a href="{{ route('news.detail', ['slug'=>$post->slug])}}">{{$post->title}}</a></h6>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->
    <!--   Weekly-News start -->
    <div class="weekly-news-area pt-50">
        <div class="container">
            <div class="weekly-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Top News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly-news-active dot-style d-flex dot-style">
                            @foreach($posts_data as $post)                      
                                <div class="weekly-single">
                                    <div class="weekly-img">
                                        <img src="{{$post->feature_image_path}}" alt="">
                                    </div>
                                    <div class="weekly-caption">
                                        <span class="color1">Top news</span>
                                        <h4><a href="#">{{$post->title}}</a></h4>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Weekly-News -->
    <!-- Whats New Start -->
    
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @foreach ($data_content as $da)
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-md-3">
                            <div class="section-tittle mb-30">
                                <h3>{{ $da->name }}</h3>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="properties__button">
                                <!--Nav Button  -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        @foreach ($da->topics as $to)
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                            href="#nav-profile" role="tab" aria-controls="nav-profile"
                                            aria-selected="false">{{ $to->name }}</a>
                                        @endforeach
                                    </div>
                                </nav>
                                <!--End Nav Button  -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Nav Card -->
                            <div class="tab-content" id="nav-tabContent">
                                <!-- card one -->
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <div class="whats-news-caption">
                                        <div class="row">
                                            @foreach ($da->postss as $po)
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="single-what-news mb-100">
                                                        <div class="">
                                                            <img width="300px" height="200px" src="{{ $po->feature_image_path }}" alt="">
                                                        </div>
                                                        <div class="what-cap">
                                                            <h4><a href="#">{{ $po->title }}</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- End Nav Card -->
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-4">
                    @foreach ($posts_50data as $f)
                    <div class="section-top-border">
                        <h6 class="mb-30">{{ $f->title }}</h6>
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ $f->feature_image_path }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-7 mt-sm-20r">
                                <p class="text-dark">{{ $f->description }}</p>
                            </div>
                        </div>
                    </div>
                        {{-- <div class="trand-right-single d-flex">
                            <h6><a href="{{ route('news.detail', ['slug'=>$f->slug])}}">{{$f->title}}</a></h6>
                            
                            <div class="trand-right-cap">
                                <div class="trand-right-img">
                                    <img height="100" width="100" src="{{$f->feature_image_path}}" alt="">
                                </div>
                                <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                    {{ $f->description }}
                                </span>
                            </div>
                        </div>
                        <hr class="g"> --}}
                    @endforeach
                    <!-- Section Tittle -->
                    
                    
                    
                </div>
                
            </div>
            
        </div>
    </section>
    <!-- Whats New End -->
    
    
    <!--   Weekly2-News start -->
    <div class="weekly2-news-area  weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Weekly Top News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly2-news-active dot-style d-flex dot-style">
                            <div class="weekly2-single">
                                <div class="weekly2-img">
                                    <img src="" alt="">
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1">Corporate</span>
                                    <p>25 Jan 2020</p>
                                    <h4><a href="#">Welcome To The Best Model Winner Contest</a></h4>
                                </div>
                            </div>
                            <div class="weekly2-single">
                                <div class="weekly2-img">
                                    <img src="" alt="">
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1">Event night</span>
                                    <p>25 Jan 2020</p>
                                    <h4><a href="#">Welcome To The Best Model Winner Contest</a></h4>
                                </div>
                            </div>
                            <div class="weekly2-single">
                                <div class="weekly2-img">
                                    <img src="" alt="">
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1">Corporate</span>
                                    <p>25 Jan 2020</p>
                                    <h4><a href="#">Welcome To The Best Model Winner Contest</a></h4>
                                </div>
                            </div>
                            <div class="weekly2-single">
                                <div class="weekly2-img">
                                    <img src="" alt="">
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1">Event time</span>
                                    <p>25 Jan 2020</p>
                                    <h4><a href="#">Welcome To The Best Model Winner Contest</a></h4>
                                </div>
                            </div>
                            <div class="weekly2-single">
                                <div class="weekly2-img">
                                    <img src="" alt="">
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1">Corporate</span>
                                    <p>25 Jan 2020</p>
                                    <h4><a href="#">Welcome To The Best Model Winner Contest</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Weekly-News -->


    <!--Start pagination -->
    <div class="pagination-area pb-45 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="#"><span
                                            class="flaticon-arrow roted"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link" href="#"><span
                                            class="flaticon-arrow right-arrow"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End pagination  -->
</main>
@endsection
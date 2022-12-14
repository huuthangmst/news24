@extends('client.layouts.client')
@section('title')
    <title>News -Trang chủ</title>
    <style>
        a.topic {
            box-shadow: inset 0 0 0 0 #eb4545;
            color: #eb4545;
            margin: 0 -.25rem;
            padding: 0 .25rem;
            transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
            }
        a.topic:hover {
            box-shadow: inset 100px 0 0 0 #eb4545;
            color: white;
        }
        .responsive {
            width: 100%;
            max-width: 500px;
            height: auto;
            max-height: 210px;
        }
        .responsive_trending {
            height: auto;
            max-height: 500px;
        }
        .responsive_weekly_news {
            width: 100%;
            max-width: 500px;
            height: auto;
            max-height: 140px;
        }
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
                            <a></a><strong>Trending now</strong>
                            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    @if($first_post != null)
                                        <li class="news-item">{{$first_post->title}}.
                                        </li>
                                    @endif
                                    @if ($tech != null)
                                        <li class="news-item">{{$tech->title}}.
                                        </li>
                                    @endif
                                    @if ($new != null)
                                        <li class="news-item">{{$ent->title}}.
                                        </li>
                                    @endif
                                    @if ($new != null)
                                        <li class="news-item">{{$new->title}}.
                                        </li>
                                    @endif 
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="trending-top mb-30">
                            <div class="trend-top-img" data-aos="fade-down">
                                @if ($first_post != null)
                                    <a href="{{ route('news.detail', ['slug'=>$first_post->slug])}}"><img src="{{$first_post->feature_image_path}}" class="responsive_trending" alt=""></a>
                                    <div class="trend-top-cap">
                                        <span>For you!</span>
                                        <h2><a href="{{ route('news.detail', ['slug'=>$first_post->slug])}}">{{$first_post->title}}</a></h2>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35" data-aos="fade-right">
                                        @if ($tech != null)
                                            <div class="zoom trend-bottom-img mb-30">
                                                <a href="{{ route('news.detail', ['slug'=>$tech->slug])}}"><img height="190px" width="40px" src="{{$tech->feature_image_path}}" alt=""></a>
                                            </div>
                                            <div class="trend-bottom-cap">
                                                <span class="color1">Công nghệ</span>
                                                <h4><a class="text" href="{{ route('news.detail', ['slug'=>$tech->slug])}}">{{$tech->title}}</a></h4>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35" data-aos="fade-right">
                                        @if ($ent != null)
                                            <div class="zoom trend-bottom-img mb-30">
                                                <a href="{{ route('news.detail', ['slug'=>$ent->slug])}}"><img height="190px" width="40px" src="{{$ent->feature_image_path}}" alt=""></a>
                                            </div>
                                            <div class="trend-bottom-cap">
                                                <span class="color2">Giải trí</span>
                                                <h4>
                                                    <h4><a class="text" href="{{ route('news.detail', ['slug'=>$ent->slug])}}">{{$ent->title}}</a></h4>
                                                </h4>
                                            </div>
                                        @endif 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35" data-aos="fade-right">
                                        @if ($new != null)
                                            <div class="zoom trend-bottom-img mb-30">
                                                <a href="{{ route('news.detail', ['slug'=>$new->slug])}}"><img height="190px" width="40px" src="{{$new->feature_image_path}}" alt=""></a>
                                            </div>
                                            <div class="trend-bottom-cap">
                                                <span class="color3">Thời sự</span>
                                                <h4><a class="text" href="{{ route('news.detail', ['slug'=>$new->slug])}}">{{$new->title}}</a>
                                                </h4>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">
                        @foreach ($posts_data as $post)
                            <div class="trand-right-single d-flex" data-aos="zoom-out-left">
                                <div class="trand-right-img">
                                    <a href="{{ route('news.detail', ['slug'=>$post->slug])}}"><img class="zoom" height="100" width="150" src="{{$post->feature_image_path}}" alt=""></a>
                                </div>
                                <div class="trand-right-cap">
                                    <span class="text-danger">News</span><i class="	fas fa-eye text-secondary"> {{ count($post->post_view) }}</i>
                                    <h6><a class="text" href="{{ route('news.detail', ['slug'=>$post->slug])}}">{{$post->title}}</a></h6>
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
                                <div class="weekly-single" data-aos="zoom-in-down">
                                    <div class="weekly-img">
                                        <img src="{{$post->feature_image_path}}" alt="">
                                    </div>
                                    <div class="weekly-caption">
                                        <span class="color1">Top news</span>
                                        <h4><a href="{{ route('news.detail', ['slug'=>$post->slug])}}">{{$post->title}}</a></h4>
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
                                            <a class="nav-item nav-link topic text-dark"  
                                            href="{{ route('news.topics', ['slug'=>$to->slug])}}" 
                                            >{{ $to->name }}</a>
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
                                                @if ($po->enable == 1)
                                                <div class="col-lg-6 col-md-6" data-aos="zoom-in-down">
                                                    <div class="single-what-news mb-100">
                                                        <div class="hover15">
                                                            <a href="{{ route('news.detail', ['slug'=>$post->slug])}}"><figure><img class="responsive" width="600" height="400" src="{{ $po->feature_image_path }}" alt=""></figure></a>
                                                        </div>
                                                        <div class="what-cap">
                                                            <h4><a class="text2" href="{{ route('news.detail', ['slug'=>$post->slug])}}">{{ $po->title }}</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
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
                    <div class="section-top-border" data-aos="zoom-in">
                        <a class="" href="{{ route('news.detail', ['slug'=>$f->slug])}}"><h6 class="mb-30">{{ $f->title }}</h6></a>
                        <div class="row">
                            <div class="zoom col-md-5">
                                <a href="{{ route('news.detail', ['slug'=>$f->slug])}}"><img src="{{ $f->feature_image_path }}" alt="" class="img-fluid"></a>
                            </div>
                            <div class="col-md-7 mt-sm-20r">
                                <p class="text text-dark">{{ $f->description }}</p>
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
                            <h3>Weekly News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly2-news-active dot-style d-flex dot-style">
                            @foreach ($post_week as $week)
                                <div class="weekly2-single">
                                    <div class="weekly2-img">
                                        <a href="{{ route('news.detail', ['slug'=>$week->slug])}}"><img src="{{ $week->feature_image_path }}" class="responsive_weekly_news" alt=""></a>
                                    </div>
                                    <div class="weekly2-caption">
                                        <span class="color1">{{ $week->topics->name }}</span>
                                        <p>{{ date('d-m-Y', strtotime($week->created_at)) }}</p>
                                        <h4><a class="text2" href="{{ route('news.detail', ['slug'=>$week->slug])}}">{{ $week->title }}</a></h4>
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


    <!--Start pagination -->
    {{-- <div class="pagination-area pb-45 text-center">
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
    </div> --}}
    <!-- End pagination  -->
</main>
@endsection
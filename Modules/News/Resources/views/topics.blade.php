@extends('client.layouts.client')
@section('title')
<title>Topic</title>
<style>
    .animate-charcter
    {
        /* text-transform: uppercase; */
        background-image: linear-gradient(
            -225deg,
            #d41f1f 0%,
            #5b58f7 29%,
            #ff1361 67%,
            #fff800 100%
        );
        background-size: auto auto;
        background-clip: border-box;
        background-size: 50% auto;
        color: #fff;
        background-clip: text;
        text-fill-color: transparent;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textclip 2s linear infinite;
        display: inline-block;
        font-size: 16px;
    }

    @keyframes textclip {
        to {
            background-position: 200% center;
        }
    }
    .res {
        height: auto;
        max-height: 100px;
        max-width: 150px;
        width: 300px;
    }
    @media only screen and (max-width: 600px) {
        img.res {
            height: auto;
            max-height: 150px;
            
        }
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
                    <div class="col-lg-12 container">
                        {{-- <div class="trending-tittle">
                            <strong>{{ $categories_data->name }}</strong>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="properties__button">
                                <!--Nav Button  -->                                            
                                <nav>                                                                     
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                        c
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Travel</a>
                                        <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#nav-last" role="tab" aria-controls="nav-contact" aria-selected="false">Fashion</a>
                                        <a class="nav-item nav-link" id="nav-Sports" data-toggle="tab" href="#nav-nav-Sport" role="tab" aria-controls="nav-contact" aria-selected="false">Sports</a>
                                        <a class="nav-item nav-link" id="nav-technology" data-toggle="tab" href="#nav-techno" role="tab" aria-controls="nav-contact" aria-selected="false">Technology</a>
                                    </div>
                                </nav>
                                <!--End Nav Button  -->
                            </div>
                        </div> --}}
                        <div class="col-lg-3 col-md-3">
                            <div class="trending-tittle">
                                <strong>{{ $name->name }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="properties__button">
                                <!--Nav Button  -->                                            
                                <nav>                                                                     
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        @foreach ($topics_data->topics as $topic_item)
                                        @if ($topic_item->slug == $slug)
                                            <p class='animate-charcter'><a class=" nav-item " 
                                                href="{{ route('news.topics', ['slug'=>$topic_item->slug]) }}" 
                                                role="tab" aria-controls="nav-contact" 
                                                aria-selected="true">{{ $topic_item->name }}
                                            </a></p>
                                        @else
                                            <a class="nav-item nav-link text-dark" 
                                                href="{{ route('news.topics', ['slug'=>$topic_item->slug]) }}" 
                                                role="tab" aria-controls="nav-contact" 
                                                aria-selected="true">{{ $topic_item->name }}
                                            </a>
                                        @endif
                                        
                                        @endforeach
                                        
                                    </div>
                                </nav>
                                <!--End Nav Button  -->
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        {{-- <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="{{$first_post->feature_image_path}}" alt="">
                        <div class="trend-top-cap">
                            <span>For you!</span>
                            <h2><a href="details.html">{{$first_post->title}}</a></h2>
                        </div>
                    </div>
                </div> --}}
                <!-- Trending Bottom -->
                <div class="trending-bottom ml-2 container">
                    <div class="row">
                        {{-- @foreach ($categories_data->postss as $cate_item)
                        <div class="col-lg-4">
                            <div class="single-bottom mb-35">
                                <div class="column">
                                    <div class="row">
                                        <div class="trend-bottom-cap">
                                            <h4><a href="details.html">{{$cate_item->title}}</a></h4>
                                        </div>
                                        <div>
                                            <h6><a href="details.html">{{$cate_item->description}}</a></h6>
                                        </div>
                                    </div>
                                    <div class="trend-bottom-img mb-30">
                                        <img src="{{$cate_item->feature_image_path}}" alt="">
                                    </div>
                                </div>

                            </div>
                        </div>

                        @endforeach --}}
                        @foreach ( $categories_data->postss as $cate_item )
                            @if ($cate_item->enable == 1)
                                <div class="section-top-border" data-aos="zoom-in">
                                    <a href="{{ route('news.detail', ['slug'=>$cate_item->slug])}}"><h4 class="mb-30">{{$cate_item->title}}</h4></a>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{ route('news.detail', ['slug'=>$cate_item->slug])}}"><img src="{{$cate_item->feature_image_path}}" alt="" class="img-fluid res"></a>
                                        </div>
                                        <div class="col-md-9 mt-sm-20">
                                            <p class="text">{{$cate_item->description}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <!-- Riht content -->
            {{-- <div class="col-lg-4">
                        @foreach ($posts_data as $post)
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-img">
                                    <img height="100" width="100" src="{{$post->feature_image_path}}" alt="">
        </div>
        <div class="trand-right-cap">
            <span class="text-danger">News</span>
            <h6><a href="{{ route('news.detail', ['slug'=>$post->slug])}}">{{$post->title}}</a></h6>
        </div>
    </div>
    @endforeach

    </div> --}}
    </div>
    </div>
    </div>
    </div>

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

@extends('client.layouts.client')
@section('title')
<title>Detail</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
<main>
    <style>
        .checked {
            color: orange;
        }

        div.stars {
            width: 270px;
            display: inline-block;
        }

        .mt-200 {
            margin-top: 200px;
        }

        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #FD4;
            transition: all .2s;
        }

        input.star:checked~label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked~label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked~label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: rotate(-15deg) scale(1.3);
        }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }

    </style>
    <!-- About US Start -->
    <div class="about-area">
        <div class="container">
            <!-- Hot Aimated News Tittle-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending-tittle">
                        <strong>{{optional($detail->topics)->name}}</strong>
                    </div>
                    {{-- {{ date('d-m-Y', strtotime($detail->created_at)) }} --}}
                    <div>
                        Updated: {{ date('d-m-Y', strtotime($detail->created_at)) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <!-- Trending Tittle -->
                    <div class="about-right mb-90">
                        <div class="section-tittle mb-30 pt-30">
                            <h3>{{ $detail->title }}</h3>
                        </div>
                        <div class="about-img">
                            <img src="{{ $detail->feature_image_path }}" alt="">
                        </div>
                        <div class="about-prea about-img">
                            {!! $detail->content !!}
                        </div>

                    </div>
                    <div class="comments-area">
                        <h3>Write Comment</h3>
                        @if (auth()->check())
                        <div class="card bg-light text-dark">
                            <form method="POST" action="{{ route('news.comment') }}">
                                @csrf
                                {{-- rating --}}
                                <input class="star star-5 form-control @error('ranking') is-invalid @enderror"
                                    id="star-5" type="radio" value="5" name="ranking" />

                                <label class="star star-5" for="star-5"></label>

                                <input class="star star-4 form-control @error('ranking') is-invalid @enderror"
                                    id="star-4" type="radio" value="4" name="ranking" />

                                <label class="star star-4" for="star-4"></label>

                                <input class="star star-3 form-control @error('ranking') is-invalid @enderror"
                                    id="star-3" type="radio" value="3" name="ranking" />

                                <label class="star star-3" for="star-3"></label>

                                <input class="star star-2 form-control @error('ranking') is-invalid @enderror"
                                    id="star-2" type="radio" value="2" name="ranking" />

                                <label class="star star-2" for="star-2"></label>

                                <input class="star star-1 form-control @error('ranking') is-invalid @enderror"
                                    id="star-1" type="radio" value="1" name="ranking" />

                                <label class="star star-1" for="star-1"></label>
                                {{-- validator --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align ml-2"></span>
                                    </label>
                                    @error('ranking')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- end rating --}}
                                <input type="text" name="comment" required
                                    class="container form-control @error('comment') is-invalid @enderror"
                                    value="{{old('comment')}}" size="80" placeholder="✍️ Write comment for you...">
                                </input>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align ml-2"></span>
                                    </label>
                                    @error('comment')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-danger mt-3">Send comment</button>
                            </form>
                        </div>
                        @else
                            <p class="text-danger">Must be logged in before commenting!</p>
                        @endif
                        

                        <h4 class="mt-5">Comments orthers</h4>
                        @if ($comments_data == [])
                        <p>This post has no comments yet...</p>
                        @else
                        @foreach ($comments_data as $comment)
                        <div class="">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="https://phunugioi.com/wp-content/uploads/2020/01/anh-avatar-supreme-dep-lam-dai-dien-facebook.jpg"
                                            alt="">
                                    </div>
                                    <div class="desc">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5 class="text-primary">
                                                    {{ $comment->user->name }}
                                                </h5>
                                                <div class="ml-2">
                                                    @if ($comment->ranking == 5)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    @elseif($comment->ranking == 4)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($comment->ranking == 3)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($comment->ranking == 2)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($comment->ranking == 1)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @else
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @endif
                                                    
                                                </div>
                                                <p class="date">{{ date('d-m-Y', strtotime($comment->created_at)) }}
                                                </p>
                                            </div>
                                            {{-- <div class="reply-btn">
                                                        <a href="#" class="btn-reply text-uppercase">reply</a>
                                                    </div> --}}
                                        </div>
                                        <p class="comment text-dark">
                                            {{ $comment->comment }}
                                        </p>
                                        @if (auth()->check())
                                        <button id="reply-button"
                                            onclick="showReplyForm('{{$comment->id}}', '{{ $comment->user->name }}')"
                                            class="border-0 bg-transparent">
                                            <h5><i class="fa fa-reply"></i> Reply</h5>
                                        </button>
                                        @endif
                                        
                                        {{-- form rep --}}
                                        <div class="row flex-row d-flex">
                                            <form action="{{ route('news.reply', ['id'=>$comment->id]) }}" method="post"
                                                style="display:none" id="reply-form-{{$comment->id}}">
                                                @csrf
                                                <div class="col-lg-12">
                                                    <textarea name="message"></textarea>
                                                </div>
                                                <button class="btn-primary" type="submit">Submit</button>
                                            </form>
                                        </div>
                                        {{-- data rep --}}
                                        
                                        
                                        @foreach ($data_replys as $rep)
                                        {{-- <h5>{{ $rep->user_id }}</h5>
                                        <h5>{{ $comment->user->id }}</h5> --}}
                                            @if ($rep->comment_id == $comment->id)
                                            <div class="mt-2">
                                                <div class="comment-list">
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb">
                                                                <img src="https://toigingiuvedep.vn/wp-content/uploads/2021/05/hinh-anh-avatar-doremon-cute.png" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <h5>
                                                                            {{ $rep->user->name }}
                                                                        </h5>                                                                        
                                                                    </div>                                                              
                                                                </div>
                                                                <p class="comment">
                                                                    {{ $rep->message }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            @endif
                                        @endforeach
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                    </div>
                    <!-- From -->
                    {{-- <div class="row">
                        <div class="col-lg-8">
                            <form class="form-contact contact_form mb-80" action="contact_process.php" method="post"
                                id="contactForm" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control w-100 error" name="message" id="message"
                                                cols="30" rows="9" onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter Message'"
                                                placeholder="Enter Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control error" name="name" id="name" type="text"
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter your name'"
                                                placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control error" name="email" id="email" type="email"
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control error" name="subject" id="subject" type="text"
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-4">
                    <!-- Section Tittle -->
                    <div class="section-tittle mb-40">
                        <h3>Same Topic</h3>
                    </div>
                    <!-- Flow Socail -->
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($posts_data as $post)
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-img">
                                    <a href="{{ route('news.detail', ['slug'=>$post->slug])}}"><img height="100"
                                            width="100" src="{{$post->feature_image_path}}" alt=""></a>
                                </div><span>&emsp;</span>
                                <div class="trand-right-cap">
                                    <span class="text-danger">News</span>
                                    <h6><a href="{{ route('news.detail', ['slug'=>$post->slug])}}">{{$post->title}}</a>
                                    </h6>
                                </div>
                            </div>
                            <div>&emsp;</div>
                            @endforeach

                        </div>
                    </div>
                    <!-- New Poster -->
                    <div class="news-poster d-none d-lg-block">
                        <img src="assets/img/news/news_card.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About US End -->
</main>
@endsection

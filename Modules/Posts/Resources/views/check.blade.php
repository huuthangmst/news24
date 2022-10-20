@extends('admin.layouts.admin')

@section('title')
<title>Edit Post</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->


    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Posts</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="dropdown-item" href="#">Settings 1</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{route('posts.checked', [$dataPost->id])}}" method="post" data-parsley-validate
                        class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @csrf

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Title</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="title" value="{{$dataPost->title}}"
                                    class="form-control @error('title') is-invalid @enderror">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align ml-2"></span>
                            </label>
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- decription --}}
                        <div class="item form-group">
                            <label class='col-form-label col-md-3 col-sm-3 label-align'>Description</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <textarea name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="3">{{$dataPost->description}}</textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align ml-2"></span>
                            </label>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Image Url</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="" value="{{$dataPost->feature_image_path}}"
                                    class="form-control">
                            </div>
                        </div>
                        {{-- avatar --}}
                        <div class="item form-group">
                            <label class='col-form-label col-md-3 col-sm-3 label-align'>Avatar</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" class="form-control-file" name="feature_image_path">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class='col-form-label col-md-3 col-sm-3 label-align'>Avatar</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <img class="feature_image" height="80" width="80"
                                    src="{{$dataPost->feature_image_path}}">
                            </div>
                        </div>

                        {{-- content --}}
                        <div class="item form-group">
                            <label class='col-form-label col-md-3 col-sm-3 label-align'>Content</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <textarea class="form-control my-editor @error('content') is-invalid @enderror"
                                    name="content" value="{{$dataPost->content}}" name="content" rows="20"
                                    cols="50">{{$dataPost->content}}</textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align ml-2"></span>
                            </label>
                            @error('content')
                            <div class="text-danger">{{ $message }} </div>
                            @enderror
                        </div>

                        {{-- topic --}}
                        <div class="item form-group">
                            {!! Form::label(null, 'Topic:', ['class'=>'col-form-label col-md-3 col-sm-3 label-align'])
                            !!}
                            <div class="col-md-6 col-sm-6">
                                {!! Form::select('topic_id', $dataTopic->pluck('name', 'id'), $dataPost->topic_id,
                                ['class'=>'form-control','placeholder' => 'Pick a category...']) !!}
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align ml-2"></span>
                            </label>
                            @error('topic_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- writer --}}
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Writer</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input  type="text" name="user_id" value="{{$dataPost->user_id}}"
                                    class="form-control @error('user_id') is-invalid @enderror">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align ml-2"></span>
                            </label>
                            @error('user_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @if (($au->user_type)==1)
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Enable</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="1" class="join-btn"> &nbsp; Enable
                                            &nbsp;
                                        </label>
                                        <button id="dis" class="btn btn-primary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="0" class="join-btn"> Disable
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- @if ()
                                
                            @endif --}}
                            <div id="des" class="item form-group">
                                <label class='col-form-label col-md-3 col-sm-3 label-align'>Description enable</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea name="description_check"
                                        class="form-control"
                                        rows="2"></textarea>
                                </div>
                            </div>
                        @endif

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Edit</button>
                                <a href="/guest"><button class="btn btn-primary" type="button">Back</button></a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<script>
    $("#dis").click(function() {
        $("#des").show();
    });
</script>
<!-- /.content-wrapper -->
@endsection

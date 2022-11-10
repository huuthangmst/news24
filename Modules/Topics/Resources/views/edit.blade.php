@extends('admin.layouts.admin')

@section('title')
<title>Update Topic</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content --> {{-- Thử dùng cái này --}}
    {{-- https://laravelcollective.com/docs/6.x/html#drop-down-lists --}}


    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Update Topics</h2>
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
                    {{-- <form action="{{route('topics.update', [$dataTopic->id])}}" method="post" data-parsley-validate
                    class="form-horizontal form-label-left">
                    @csrf

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Name</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" name="name" value="{{$dataTopic->name}}"
                                class="form-control @error('name') is-invalid @enderror">
                        </div>
                    </div>


                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align ml-2"></span>
                        </label>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Categories</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <select id="heard" name="category_id"
                                class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="" selected>Choose categories</option>
                                {!! $htmlSelect !!}
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align ml-2"></span>
                        </label>
                        @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Enable</label>
                        <div class="col-md-6 col-sm-6 ">
                            <div id="gender" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                    data-toggle-passive-class="btn-default">
                                    <input type="radio" name="enable" value="1" class="join-btn"> &nbsp; Enable
                                    &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary"
                                    data-toggle-passive-class="btn-default">
                                    <input type="radio" name="enable" value="0" class="join-btn"> Disable
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="/topics"><button class="btn btn-primary" type="button">Back</button></a>
                        </div>
                    </div>

                    </form> --}}

                    {!! Form::open(['method' => 'POST', 'route' => ['topics.update', $dataTopic->id]], ['class'=>'form-horizontal form-label-left']) !!}
                    @csrf
                    <div class="form-group">
                        <div class="item form-group">
                            {!! Form::label(null, 'Name:', ['class'=>'col-form-label col-md-3 col-sm-3 label-align']) !!}
                            <div class="col-md-6 col-sm-6">
                                {!! Form::text('name',$dataTopic->name, ['class'=>'form-control','placeholder'=>'Write name']) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            {!! Form::label('category', 'Category:', ['class'=>'col-form-label col-md-3 col-sm-3 label-align']) !!}
                            <div class="col-md-6 col-sm-6">
                                {!! Form::select('category_id', $dataCate->pluck('name', 'id'), $dataTopic->category_id, ['class'=>'form-control','placeholder' => 'Pick a category...']) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Enable</label>
                            <div class="col-md-6 col-sm-6 ">
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    @if ($dataTopic->enable == 1)
                                        <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="1" class="join-btn" checked="checked"> &nbsp; Enable
                                            &nbsp;
                                        </label>
                                        <label class="btn btn-primary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="0" class="join-btn"> Disable
                                        </label>
                                    @else
                                        <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="1" class="join-btn"> &nbsp; Enable
                                            &nbsp;
                                        </label>
                                        <label class="btn btn-primary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="0" class="join-btn" checked="checked"> Disable
                                        </label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            {!! Form::submit('Update', ['class'=>'btn btn-success']) !!}
                            <a href="/topics"><button class="btn btn-primary" type="button">Back</button></a>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

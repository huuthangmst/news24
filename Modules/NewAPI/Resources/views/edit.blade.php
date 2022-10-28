@extends('admin.layouts.admin')
@section('title')
<title>Edit Api</title>
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
                    <h2>Edit </h2>
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
                    <form action="{{route('newapi.update', ['id'=>$data_api->id])}}" method="post" data-parsley-validate
                        class="form-horizontal form-label-left">
                        @csrf

                        <div class="item form-group">
                            {!! Form::label(null, 'Categories:', ['class'=>'col-form-label col-md-3 col-sm-3 label-align'])
                            !!}
                            <div class="col-md-6 col-sm-6">
                                {!! Form::select('category_id', $data_user->pluck('name', 'id'),
                                ['class'=>'form-control','value' => $data_api->user_id]) !!}
                            </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="/topics"><button class="btn btn-primary" type="button">Back</button></a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

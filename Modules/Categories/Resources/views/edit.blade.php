@extends('admin.layouts.admin')

@section('title')
<title>Update</title>
<style>
    .h {
    color: #f32179;
    padding:20px;
    border-color: #f32179;
    font-size: 30px;
    transition: 0.2s;
    background-color: transparent;
    border-radius: 3em;
    cursor: pointer;
}


    .h {
    color: #fff;
    background: #11b146;
    box-shadow: 0 0 10px #11b146, 0 0 10px #11b146, 0 0 5px #11b146;
}
</style>
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
                    <h2>Update Categories</h2>
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
                    <form action="{{route('categories.update', [$dataCategories->id])}}" method="post" data-parsley-validate
                        class="form-horizontal form-label-left">
                        @csrf

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Name</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="name" value="{{ $dataCategories->name }}"
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
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Enable</label>
                            <div class="col-md-6 col-sm-6 ">
                                @if ($dataCategories->enable == 1)
                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                        <button class="btn btn-secondary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="1" class="join-btn" checked="checked"> &nbsp; Enable
                                            &nbsp;
                                        </button>
                                        <button class="btn btn-primary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="0" class="join-btn"> Disable
                                        </button>
                                        
                                    </div>
                                @else
                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                        <button class="btn btn-secondary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="1" class="join-btn"> &nbsp; Enable
                                            &nbsp;
                                        </button>
                                        <label class="btn btn-primary" data-toggle-class="btn-primary"
                                            data-toggle-passive-class="btn-default">
                                            <input type="radio" name="enable" value="0" class="join-btn" checked="checked"> Disable
                                        </label>
                                    </div>
                                @endif
                                
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="/categories"><button class="btn btn-primary" type="button">Back</button></a>
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

@extends('admin.layouts.admin')

@section('title')
<title>Post manager</title>
@endsection
@section('content')

<div class="mt-5 mr-3">
    {{-- <a 
        onclick="return confirm('Are you sure you want to get form api?');"
        href="{{route('posts.getApi') . '?type=1'}}">
        <button type="button" class="btn btn-secondary float-right"><i class="fa fa-plus"></i></span> Get Post from API
        </button>
    </a> --}}
    <a href="{{route('posts.create') . '?type=0'}}">
        <button type="button" class="btn btn-secondary float-right"><i class="fa fa-plus"></i></span> Write Post
        </button>
    </a>
</div>

<div class="col-md-12 col-sm-6 mt-5">
    <div class="x_panel">
        <div class="x_title">
            <h2>List Check Post</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                            class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Avatar image</th>
                        <th>Title</th>
                        <th>Description disable</th>
                        <th>Enable status</th>
                        {{-- <th colspan="2">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPost as $posts_items)
                        
                    <tr>
                        <th scope="row">{{ $posts_items->id }}</th>
                        <th><img src="{{ $posts_items->feature_image_path }}" height="50" width="50"></th>
                        <td>{{ $posts_items->title }}</td>
                        {{-- @forelse($var ?? [] as $varItem)

                        @empty

                        @endforelse --}}
                        @if ($posts_items->post_check == null || $posts_items->post_check == [])
                            <td><p class="text-primary">Nothing</td></p>
                        @elseif ($posts_items->post_check->description_check == null) 
                                <td><p class="text-primary">Nothing</td></p>
                        @else
                            <td><p class="text-primary">{{ $posts_items->post_check->description_check }}</td></p>
                        @endif
                        
                        {{-- <td>{{ $posts_items->user_id }}</td> --}}
                        {{-- <td>{{optional($posts_items->topics)->name}}</td>
                        <td>{{optional($posts_items->topics->categories)->name}}</td> --}}
                        {{-- @if ($posts_items->post_type == 1)
                            <td>API</td>
                        @else
                            <td>Write</td>
                        @endif --}}
                        
                        @if ($posts_items->enable == 1)
                            <td>Enable</td>
                        @else
                            <td>Disable</td>
                        @endif
                        {{-- @if ($dataPosts->check2[0]->description_check == '')
                            <td>null</td>
                        @else
                            <td>{{$dataPosts->check2[0]->description_check}}</td>
                        @endif --}}
                        
                        {{-- <td>
                            <a
                                href="{{ route('posts.check', ['id'=>$posts_items->id]) }}"
                                class="btn btn-primary "><i class="fa fa-edit"></i></a>
                            <a
                                href="{{ route('posts.destroy', ['id'=>$posts_items->id]) }}"
                                data-url=""
                                onclick="return confirm('Are you sure you want to delete this item?');"
                                class="btn btn-danger action_delete "><i class="fa fa-trash"></i></a>
                        </td> --}}
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>          
        </div>
        {{-- <div class="col-md-6">
            <p>{{ $dataCategories->links() }}</p>
        </div>  --}}
    </div>
</div>

@endsection

@extends('admin.layouts.admin')
@section('title')
<title>API</title>

@endsection
@section('content')
    <div class="mt-5 mr-3">
        <a href="{{ route('newapi.create') }}">
            <button
                {{-- onclick="return confirm('Are you sure you want to action this item?');" --}}
                type="button" class="btn btn-secondary float-right"><i class="fa fa-plus"></i></span> Create Api
            </button>
        </a>
    </div>

    <div class="col-md-12 col-sm-6 mt-5">
        <div class="x_panel">
            <div class="x_title">
                <h2>Categories manager</h2>
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
                            <th>Url key</th>
                            <th>User</th>
                            
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keyData as $key_items)
                            
                        <tr>
                            <th scope="row">{{ $key_items->id }}</th>
                            {{-- <td><input size="60"  value="{{ $uri }}/api/newposts?apiKey={{ $key_items->apiKey }}" disabled id="myInput"></td> --}}
                            {{-- <td id="copy_{{ $key_items->id }}">{{ $uri }}/api/newposts?apiKey={{ $key_items->apiKey }}</td>                   --}}
                            <td id="copy_{{ $key_items->id }}">{{ $key_items->apiKey }}</td>
                            <td>{{optional($key_items->users)->name}}</td>

                            <td>
                                {{-- <button class="btn btn-primary" onclick="myFunction()">Copy URI key</button> --}}
                                <button title="Copy api" class="black" type="button" onclick="copyEvent('copy_{{ $key_items->id }}')"><i class="bi bi-pass"></i></button>
                                <a
                                    title="Update"
                                    href="{{ route('newapi.edit', ['id'=>$key_items->id]) }}"
                                    class="blue "><i class="fa fa-edit"></i></a>&nbsp
                                <a
                                    title="Delete"
                                    href="{{ route('newapi.destroy', ['id'=>$key_items->id]) }}"
                                    data-url=""
                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                    class="red action_delete "><i class="fa fa-trash"></i></a>
                            </td>
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
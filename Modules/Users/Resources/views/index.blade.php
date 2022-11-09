@extends('admin.layouts.admin')
@section('title')
<title>Users</title>
@endsection
@section('content')

{{-- <div class="mt-5 mr-3">
    <a href="{{ route('topics.create') }}">
        <button type="button" class="btn btn-secondary float-right"><i class="fa fa-plus"></i></span> Add topics
        </button>
    </a>
</div> --}}

<div class="col-md-12 col-sm-6 mt-5">
    <div class="x_panel">
        <div class="x_title">
            <h2>Users manager</h2>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>User type</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users_data as $user_items)
                        
                    <tr>
                        <th scope="row">{{ $user_items->id }}</th>
                        <td>{{ $user_items->name }}</td>
                        <td>{{$user_items->email}}</td>
                        @if ($user_items->user_type == 1)
                            <td>Admin</td>
                        @else
                            <td>User</td>
                        @endif
                        <td>
                            <a
                                title="Update"
                                href="{{ route('users.edit', ['id'=>$user_items->id]) }}"
                                class="blue "><i class="fa fa-edit"></i></a>&nbsp
                            @if ($user_items->user_type != 1)
                            <a
                                title="Delete"
                                href="{{ route('users.destroy', ['id'=>$user_items->id]) }}"
                                onclick="return confirm('Are you sure you want to delete this item?');"
                                class="red action_delete "><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>       
        </div>
        {{-- <div class="col-md-6">
            <p>{{$users_data->links() }}</p>
        </div>  --}}
    </div>
</div>

@endsection

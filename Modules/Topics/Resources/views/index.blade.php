@extends('admin.layouts.admin')
@section('title')
<title>Topics</title>
@endsection
@section('content')

<div class="mt-5 mr-3">
    <a href="{{ route('topics.create') }}">
        <button type="button" class="btn btn-secondary float-right"><i class="fa fa-plus"></i></span> Add topics
        </button>
    </a>
</div>

<div class="col-md-12 col-sm-6 mt-5">
    <div class="x_panel">
        <div class="x_title">
            <h2>Topics manager</h2>
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
                        <th>Categories</th>
                        <th>Enable status</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataTopics as $topic_items)
                        
                    <tr>
                        <th scope="row">{{ $topic_items->id }}</th>
                        <td>{{ $topic_items->name }}</td>
                        <td>{{optional($topic_items->categories)->name}}</td> {{-- gọi phương thức trên một đối tượng --}}
                        @if ($topic_items->enable == 1)
                            <td>Enable</td>
                        @else
                            <td>Disable</td>
                        @endif
                        <td>
                            <a
                                href="{{ route('topics.edit', ['id'=>$topic_items->id]) }}"
                                class="btn btn-primary "><i class="fa fa-edit"></i></a>
                            <a
                                href="{{ route('topics.destroy', ['id'=>$topic_items->id]) }}"
                                onclick="return confirm('Are you sure you want to delete this item?');"
                                class="btn btn-danger action_delete "><i class="fa fa-trash"></i></a>
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

@extends('admin.layouts.admin')
@section('title')
<title>Trang chủ</title>
<style>
    .td-div {
        width: 200px;
        max-width: 200px;
        /* add this */
        white-space: nowrap;
        overflow: hidden;
    }

</style>
@endsection
@section('content')
{{-- <h1>This is home page manager</h1> --}}
<!-- page content -->
<div>
    <!-- top tiles -->
    <div class="column">
        <div class="row" style="display: inline-block;">
            <div class="tile_count">
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top green"><i class="fa fa-eye"></i> Total Views</span>
                    <div class="count">{{ $total_views }}</div>
                    <span class="count_bottom"><i class="green">+ {{ $view_today }} </i> views today</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top green"><i class="fa fa-bullseye"></i> Total New Views</span>
                    <div class="count">{{ $total_new_views }}</div>
                    <span class="count_bottom"><i class="green">+ {{ $new_view_today }}</i> view today</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top green"><i class="fa fa-clock-o"></i> Total View Back</span>
                    <div class="count">{{ $total_views_back }}</div>
                    <span class="count_bottom"><i class="green">+ {{ $view_back_today }} </i> view today</span>
                </div>

                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top green"><i class="fa fa-user"></i> Total Users</span>
                    <div class="count">{{ $total_users }}</div>
                    {{-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span> --}}
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top green"><i class="fa fa-user"></i> Total Posts</span>
                    <div class="count">{{ $total_posts }}</div>

                </div>
                
                
            </div>
        </div>
    </div>
    <!-- /top tiles -->

    

    <div class="row">


    <div class="col-md-3 col-sm-4 ">
        <div class="x_panel tile fixed_height_320 overflow_hidden">
            <div class="x_title">
                <h2 class="green">Top 5 users has many post</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                <table class="" style="width:100%">
                    <tr>

                        <th>
                            <div class="col-lg-7 col-md-7 col-sm-7 ">
                                <p class="">Name</p>
                            </div>

                        </th>
                        <th>
                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                <p class="">Post munber</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <table class="tile_info">
                                @foreach ($top_user as $topu_item)
                                <tr>
                                    <td>
                                        <p><i class="fa fa-check-square-o green"></i>{{ $topu_item->name }} </p>
                                    </td>

                                </tr>
                                @endforeach

                            </table>
                        </td>
                        <td>
                            <table class="tile_info">
                                @foreach ($top_user as $topu_item)
                                <tr>

                                    <td><b>{{ $topu_item->post_list_count }}</b></td>
                                </tr>
                                @endforeach

                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-4 ">
        <div class="x_panel tile fixed_height_320 overflow_hidden">
            <div class="x_title">
                <h2 class="green">Top 5 countries with the most views</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                <table class="" style="width:100%">
                    <tr>

                        <th>
                            <div class="col-lg-7 col-md-7 col-sm-7 ">
                                <p class="">Country</p>
                            </div>

                        </th>
                        <th>
                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                <p class="">Progress</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <table class="tile_info">
                                @foreach ($country as $country_item)
                                <tr>
                                    <td>
                                        <p><i class="fa fa-check-square-o green"></i>{{ $country_item->country }}
                                        </p>
                                    </td>

                                </tr>
                                @endforeach

                            </table>
                        </td>
                        <td>
                            <table class="tile_info">
                                @foreach ($country as $country_item)
                                <tr>

                                    <td><b>{{ round(($country_item->coun/$total_views)*100, 2) }}%</b></td>
                                </tr>
                                @endforeach

                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-sm-4 ">
        <div class="x_panel tile fixed_height_320 overflow_hidden">
            <div class="x_title">
                <h2 class="green">Top 5 post with the most views</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                <table class="" style="width:100%">
                    <tr>

                        <th>
                            <div class="col-lg-7 col-md-7 col-sm-7 ">
                                <p class="">Post title</p>
                            </div>

                        </th>
                        <th>
                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                <p class="">Total view</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <table class="tile_info">
                                @foreach ($top_view_post as $post_view_item)
                                <tr>
                                    <td class="td-div">
                                        <p><i class="fa fa-check-square-o green "></i>{{ $post_view_item->title }}
                                        </p>
                                    </td>

                                </tr>
                                @endforeach

                            </table>
                        </td>
                        <td>
                            <table class="tile_info">
                                @foreach ($top_view_post as $post_view_item)
                                <tr>

                                    <td><b>{{ $post_view_item->post_view_count }}</b></td>
                                </tr>
                                @endforeach

                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-5 col-sm-5  ">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="green">Statistics of posts by month</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                {{-- <canvas id="mybarChart"></canvas> --}}
                
                <div id="container"></div>
            </div>
        </div>
    </div>

    </div>
    



</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var postData = <?php echo json_encode($postData)?>;
    var year = <?php echo $year?>;
    Highcharts.chart('container', {
        title: {
            text: `Statistics of posts by month, ${year}`,  
        },
        xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ]
        },
        yAxis: {
            title: {
                text: 'Post number'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        chart: { //bỏ thì thành biểu đồ đường, để thì biểu đồ cột
            type: 'column'
        },
        series: [{
            name: 'Post',
            data: postData
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>
<!-- /page content -->
@endsection

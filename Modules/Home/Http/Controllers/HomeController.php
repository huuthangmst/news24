<?php

namespace Modules\Home\Http\Controllers;

use App\Models\Categories;
use App\Models\PostViews;
use App\Models\Topics;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class HomeController extends Controller
{
    private $categories;
    private $postViews;
    private $topics;

    public function __construct(Categories $categories, PostViews $postViews, Topics $topics)
    {
        $this->categories = $categories;
        $this->postViews = $postViews;
        $this->topics = $topics;
    }

    public function index()
    {
        // total views
        $total_views = $this->postViews->get()->count();

        // total new views
        $new_views = $this->postViews
            ->selectRaw('count(post_id) as new_views')
            ->groupBy('post_id', 'ip_adress')
            ->orderBy('new_views', 'DESC')
            ->having('new_views', '=', 1)
            ->get();
        $back = $this->postViews
            ->selectRaw('count(post_id) as new_views')
            ->groupBy('post_id', 'ip_adress')
            ->orderBy('new_views', 'DESC')
            ->having('new_views', '>', 1)
            ->get();

        $total_new_views = json_decode(($new_views->count()) + ($back->count())); // views back are also a new view


        // total views back
        $views_back = $this->postViews
            ->selectRaw('count(post_id) as views_back')
            ->groupBy('post_id', 'ip_adress')
            ->orderBy('views_back', 'DESC')
            ->having('views_back', '>', 1)
            ->get();
        //$total_views_back = json_decode($views_back);

        $total_views_back = $total_views - $total_new_views;
        //dd(json_decode($views_back));


        // count the most viewed posts in the last 24 hours:
        // $view_today = json_decode($this->postViews
        //     ->selectRaw('count(post_id) as today')
        //     // ->groupBy('post_id', 'ip_adress')
        //     ->where("created_at", "=", now())
        //     ->get()->first());
        $view_today = $this->postViews->whereDate('created_at', Carbon::today())->count();
        
        // new views today
        $new_view_today2 = json_decode($this->postViews
            ->selectRaw('count(post_id) as new_views')
            ->groupBy('post_id', 'ip_adress')
            // ->where("created_at", ">=", date("Y-m-d H:i:s"))
            ->whereDate('created_at', Carbon::today())
            ->having('new_views', '=', 1)
            ->get()->count());
        $back2 = $this->postViews
            ->selectRaw('count(post_id) as new_views')
            ->groupBy('post_id', 'ip_adress')
            ->whereDate('created_at', Carbon::today())
            ->having('new_views', '>', 1)
            ->count();

        $new_view_today = ( $new_view_today2 + $back2);
        //dd($new_view_today);

        // back views today
        $summ = json_decode($this->postViews
            ->selectRaw('count(post_id) as views_back')
            ->groupBy('post_id', 'ip_adress')
            ->whereDate('created_at', Carbon::today())
            ->having('views_back', '>', 1)
            ->get());
        $back_today = collect($summ)->reduce(function ($carry, $item) {
            return $carry + $item->views_back;
        });
        
        $view_back_today = (int)$back_today - (collect($summ)->count());
        //dd($view_back_today);

        // top country view
        $country = json_decode($this->postViews
            ->selectRaw('country, count(country) as coun')
            ->groupBy('country')
            ->orderBy('coun', 'DESC')
            ->get()->take(5));
        
        // top topic
        // $top_topic = json_decode($this->topics->with('post_view')->get()->cou);
        // foreach($top_topic as $v){
        //     $a = ($v->post_view);
        //     dd($a);
        // }
        

        return view('home::index', compact(
            'total_views',
            'total_new_views',
            'total_views_back',
            'view_today',
            'new_view_today',
            'view_back_today',
            'country'
        ));
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('home::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('home::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

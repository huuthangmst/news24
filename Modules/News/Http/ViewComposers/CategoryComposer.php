<?php

namespace Modules\News\Http\ViewComposers;

use Illuminate\View\View;
use app\Models\Categories;
use App\Models\CheckPosts;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;

class CategoryComposer
{
    private $categories;
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }
    public function compose(View $view)
    {
        // get all category
        $data_Categories = json_decode($this->categories->with('topics')->get());
        $post_disable = json_decode(Posts::where('enable', 0)->with('post_user')->with('post_check')->get());
        // count check post enable
        $check_count = json_decode(Posts::where('enable', 0)->whereRelation('post_check', 'enable', '=', 1)->get());
        //dd($check_count);
        if(auth()->check()){
            // get day
            $date = date('Y-m-d H:i:s');

            $auth_id = Auth::user()->id;
            $checked_posts = json_decode(
                Posts::where('enable', 0)
                    ->with('post_user')
                    ->where('user_id', $auth_id)
                    ->with('post_check')
                    ->whereRelation('post_check', 'enable', '=', 1)
                    ->whereRelation('post_check', 'description_check', '!=', null)
                    ->get()
            );
            $view->with('data_Categories', $data_Categories)
            ->with('date', $date)
            ->with('post_disable', $post_disable)
            ->with('checked_posts', $checked_posts)
            ->with('check_count', $check_count);
        }
        else{
            // get day
            $date = date('Y-m-d H:i:s');

            //dd($data_Categories);
            $view->with('data_Categories', $data_Categories)
                ->with('date', $date)
                ->with('post_disable', $post_disable);
                // ->with('checked_posts', $checked_posts);
        }


        // //dd($data_Categories);
        // $view->with('data_Categories', $data_Categories)
        //     ->with('date', $date)
        //     ->with('post_disable', $post_disable)
        //     ->with('checked_posts', $checked_posts);
    }
}

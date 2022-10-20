<?php

namespace Modules\News\Http\ViewComposers;

use Illuminate\View\View;
use app\Models\Categories;
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
        //dd($post_disable);
        if(auth()->check()){
            // get day
            $date = date('Y-m-d H:i:s');

            $auth_id = Auth::user()->id;
            $checked_posts = json_decode(
                Posts::where('enable', 0)
                    ->with('post_user')
                    ->where('user_id', $auth_id)
                    ->with('post_check')
                    ->get()
            );
            $view->with('data_Categories', $data_Categories)
            ->with('date', $date)
            ->with('post_disable', $post_disable)
            ->with('checked_posts', $checked_posts);
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

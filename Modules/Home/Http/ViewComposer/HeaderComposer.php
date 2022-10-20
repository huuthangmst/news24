<?php

namespace Modules\Home\Http\ViewComposer;  

use App\Models\Categories;
use Illuminate\View\View;
use App\Models\Posts;
use \Auth;

class PostsComposer
{
    private $posts;
    private $categories;
    public function __construct(Categories $categories, Posts $posts)
    {
        $this->categories = $categories;
        $this->posts = $posts;
    }
    public function compose(View $view)
    {
        $data_Categories = json_decode($this->categories->with('topics')->get());
        $view->with('data_Categories', $data_Categories);
    }
}

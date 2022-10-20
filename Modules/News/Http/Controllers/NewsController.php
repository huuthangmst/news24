<?php

namespace Modules\News\Http\Controllers;

use App\Models\Categories;
use App\Models\Comments;
use App\Models\Posts;
use App\Models\PostViews;
use App\Models\Replys;
use App\Models\Topics;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\News\Http\Requests\CommentRequest;

class NewsController extends Controller
{
    private $topics;
    private $categories;
    private $posts;
    private $post_views;
    private $comments;
    public $slug_detail;
    private $replys;

    public function __construct(
        Topics $topics, 
        Posts $posts, 
        Categories $categories, 
        PostViews $post_views, 
        Comments $comments,
        Replys $replys)
    {
        $this->topics = $topics;
        $this->posts = $posts;
        $this->categories = $categories;
        $this->post_views = $post_views;
        $this->comments = $comments;
        $this->replys = $replys;
    }
    public function index()
    {
        // Công nghệ
        //$tech = json_decode($this->posts->with('topics')->where('topic_id', 4)->latest()->first());
        $tech = json_decode($this->categories->with('postss')->where('slug', 'cong-nghe')->first()->postss->first());
        //dd($tech);

        // Giải trí
        //$ent = json_decode($this->posts->where('topic_id', 1)->latest()->first());
        $ent = json_decode($this->categories->with('postss')->where('slug', 'giai-tri')->first()->postss->first());

        // Thời sự
        //$new = json_decode($this->posts->where('topic_id', 6)->latest()->first());
        $new = json_decode($this->categories->with('postss')->where('slug', 'xa-hoi')->first()->postss->first());
        //dd($new);

        $first_post = $this->posts->where('enable', 1)->latest()->first();
        $posts_data = json_decode($this->posts->with('post_view')->where('enable', 1)->latest()->skip(0)->take(5)->get()); //get first 5 rows and latest
        //dd($posts_data);
        //dd(json_decode($posts_data));

        // get post follow topic
        $data_content = json_decode($this->categories->with('postss')->with('topics')->get());
        //dd($data_content);

        // get 50 post
        $posts_50data = json_decode($this->posts->with('post_view')->where('enable', 1)->skip(0)->take(10)->get());
        return view('news::index', compact(
            'posts_data',
            'first_post',
            'tech',
            'ent',
            'new',
            'data_content',
            'posts_50data'
        ));
    }


    public function detail($slug, Request $request)
    {
        $slug_detail = $slug;

        $posts_data = $this->posts->latest()->skip(0)->take(10)->get(); //get first 5 rows and latest
        $detail = json_decode($this->posts->with('topics')->where('slug', $slug)->first());

        // count views vd:Post::where('slug',$slug)->increment('view_count');
        /*$sessionView = Session::get('key');

        $post_id = json_decode($this->posts->where('slug', $slug)->first()->id);
        
        //new_views
        $new_views = json_decode(PostViews::all()->where('post_id', $post_id)->first()->new_views);
        //news_back
        $views_back = json_decode(PostViews::all()->where('post_id', $post_id)->first()->views_back);
        
        if (!$sessionView) { // nếu chưa có session ->xem mới
            Session::put('key', 1); //set giá trị cho session
            $post = PostViews::updateOrCreate(
                [
                    'post_id'=> $post_id,
                ],
                [
                    'new_views'=>$new_views+1,
                    'views_back'=>$views_back
                ]
            );
            //$post->increment('views');
        }
        else { // ->xem lại
            $post = PostViews::updateOrCreate(
                [
                    'post_id'=> $post_id,
                ],
                [
                    'new_views'=>$new_views,
                    'views_back'=>$views_back+1
                ]
            );
        }
        //dd($post); */

        //count views with ip
        $ip_client = '45.225.123.24';
        $post_id = json_decode($this->posts->where('slug', $slug)->first()->id);
        $ip_data = geoip()->getLocation($ip_client);

        $post = PostViews::Create(
            [
                'post_id' => $post_id,
                'ip_adress' => $ip_client,
                'country' => $ip_data->country,
                'city' => $ip_data->city,
            ]
        );

        // get all comments
        $comments_data = json_decode($this->comments->with('post')->with('user')->with('reply')->where('post_id', $post_id)->get());
        //dd($comments_data);

        // get replys
        $data_replys = json_decode($this->replys->with('comment')->with('user')->get());
        //dd($data_replys);

        return view('news::detail', compact('detail', 'posts_data', 'comments_data', 'data_replys'));
    }


    public function categories($slug)
    {
        $topics_data = json_decode($this->categories->with('topics')->where('slug', $slug)->first());
        $categories_data = $this->categories->with('postss')->where('slug', $slug)->first();
        //dd(json_decode($categories_data));
        return view('news::categories', compact('categories_data', 'topics_data'));
    }


    public function topic($slug)
    {
        $list_topic = json_decode($this->topics->with('categories')->where('slug', $slug)->first()); // list các topic theo slug
        $name = $list_topic->categories; // get name of categories
        //dd($name);

        $topics_data = json_decode($this->categories->with('topics')->where('slug', $name->slug)->first()); // get list topic with categories slug
        //dd($topics_data);

        $categories_data = json_decode($this->topics->with('postss')->where('slug', $slug)->first()); //cate có nhiều posts
        //dd($categories_data);
        return view('news::topics', compact('categories_data', 'topics_data', 'name'));
    }


    public function comment(CommentRequest $request)
    {
        // get slug previous url
        $url = str_replace(url('/'), '', url()->previous());
        $slugs = explode("/", $url);
        $latestslug = $slugs[(count($slugs) - 1)];

        // get id post with slug
        $post = json_decode($this->posts->where('slug', $latestslug)->first());

        $dataComment = [
            'post_id' => $post->id,
            'user_id' => Auth()->user()->id,
            'comment' => $request->comment,
            'ranking' => $request->ranking
        ];

        // save into database
        $this->comments->create($dataComment);
        //dd($dataComment);

        return redirect()->back();
    }


    public function reply($id, Request $request)
    {
        $data_reply = [
            'user_id' => Auth()->user()->id,
            'comment_id' => $id,
            'message'=>$request->message
        ];
        $this->replys->create($data_reply);
        // dd($data_reply);
        return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
}

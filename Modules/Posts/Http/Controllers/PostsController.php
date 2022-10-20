<?php

namespace Modules\Posts\Http\Controllers;

use App\Models\Categories;
use App\Models\CheckPosts;
use App\Models\Posts;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Topics;
use Modules\Posts\Http\Components\SelectTopics;
use Modules\Posts\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Http;
use DOMDocument;
use Modules\Posts\Http\Traits\StorageImageTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    use StorageImageTrait;
    private $topics;
    private $posts;
    private $categories;
    private $check_post;
    public function __construct(Topics $topics, Posts $posts, Categories $categories, CheckPosts $check_post)
    {
        $this->topics = $topics;
        $this->posts = $posts;
        $this->categories = $categories;
        $this->check_post = $check_post;
    }

    public function index()
    {
        $dataPosts = $this->posts->all();
        return view('posts::index', compact('dataPosts'));
    }

    public function create()
    {
        $au = Auth::user();
        $htmlSelect = $this->getTopics($topicId = '');
        return view('posts::create', compact('htmlSelect', 'au'));
    }

    public function getTopics($topicId)
    {
        $data = $this->topics->all();
        $options = new SelectTopics($data);
        $htmlSelect = $options->topicsSelect();
        return $htmlSelect;
    }

    public function store(CreatePostRequest $request)
    {
        
        $auth = Auth::user()->user_type;
        if($auth == 1) // is admin
        {
            $en = $request->enable;
        }
        else{
            $en = 0;
        }
        $dataPostCreate = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'topic_id' => $request->topic_id,
            'post_type' => $request->type,
            'user_id' => $request->user_id,
            'enable' => $en,
            'slug' => Str::slug($request->title)
        ];
        
        
        //dd($dataPostCreate);
        // data image upload
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'posts');

        // nếu image upload is not empty
        if (!empty($dataUploadFeatureImage)) {
            $dataPostCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataPostCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }
        
        // dd($dataPostCreate);
        $this->posts->create($dataPostCreate);

        // get id post
        $id_post = json_decode($this->posts->where('title', $request->title)->first()->id);
        //dd($id_post);
        $data_check = [
            'post_id'=>$id_post,
            'description_check'=>null,
            'enable'=>1
        ];
        
        $this->check_post->create($data_check);
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        return view('posts::show');
    }

    public function edit($id)
    {
        $au = Auth::user();
        $dataPost = $this->posts->find($id);
        $dataTopic = $this->topics->all();
        //$htmlSelect=$this->getTopicsUpdate($dataPost->id);
        return view('posts::edit', compact('dataTopic', 'dataPost', 'au'));
    }

    public function getTopicsUpdate($topicId)
    {
        $data = $this->topics->all();
        $options = new SelectTopics($data);
        $htmlSelect = $options->topicsSelectUpdate($topicId);
        return $htmlSelect;
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user()->user_type;
        if($auth == 1) // is admin
        {
            $en = $request->enable;
        }
        else{
            $en = 0;
        }
        $dataPostUpdate = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'topic_id' => $request->topic_id,
            'user_id' => $request->user_id,
            'enable' => $en,
            'slug' => Str::slug($request->title)
        ];
        // data image upload
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'posts');

        // nếu image upload is not empty
        if (!empty($dataUploadFeatureImage)) {
            $dataPostUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataPostUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }

        $this->posts->find($id)->update($dataPostUpdate);
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $this->posts->find($id)->delete();
        return redirect()->route('posts.index');
    }

    // tìm title trong db->đối chứng với nhau xem có trùng nhau hay k->nếu trùng thì ko tạo->ngược lại thì tạo luôn vào database
    public function getTitle($title)
    {
        $title = $this->posts->where('title', $title)->get();
        return $title;
    }

    public function getApi(Request $request)
    {
        $url = "https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=87384f1c2fe94e11a76b2f6ff11b337f";

        $data = Http::get($url);

        $item = json_decode($data->body());

        $i = collect($item->articles);

        $limit = $i->take(5);   // take limited 5 items

        $decode = json_decode($limit);

        foreach ($decode as $post) {
            $ite = (array)$post;

            // create post 
            $dataPost = [
                'title' => $ite['title'],
                'description' => $ite['description'],
                'content' => $ite['content'],
                'topic_id' => '1',
                'post_type' => $request->type,
                'user_id' => '1',
                'enable' => '1',
                'feature_image_path' => $ite['urlToImage'],
                'slug' => Str::slug($request->title)
            ];
            //dd($dataPost);
            $this->posts->firstOrCreate($dataPost);
        }
        return redirect()->route('posts.index');
    }

    public function check($id){
        $au = Auth::user();
        $dataPost = $this->posts->find($id);
        $dataTopic = $this->topics->all();
        //$htmlSelect=$this->getTopicsUpdate($dataPost->id);
        return view('posts::check', compact('dataTopic', 'dataPost', 'au'));
    }

    public function checked(Request $request, $id){
        $auth = Auth::user()->user_type;
        if($auth == 1) // is admin
        {
            $en = $request->enable;
        }
        else{
            $en = 0;
        }
        $dataPostUpdate = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'topic_id' => $request->topic_id,
            'user_id' => $request->user_id,
            'enable' => $en,
            'slug' => Str::slug($request->title)
        ];
        // data image upload
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'posts');

        // nếu image upload is not empty
        if (!empty($dataUploadFeatureImage)) {
            $dataPostUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataPostUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }
        //
        $data_check = [
            'post_id'=>$id,
            'description_check'=>$request->description_check,
            'enable'=>1
        ];
        //dd($dataPostUpdate);
        $this->posts->find($id)->update($dataPostUpdate);
        // get id check table
        $o = json_decode($this->check_post->with('post')->where('post_id', $id)->first()->id);
        // dd($o);
        $this->check_post->find($o)->update($data_check);
        return redirect()->route('posts.index');
    }
}

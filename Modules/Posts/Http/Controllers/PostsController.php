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
        $dataPosts = $this->posts->latest()->paginate(5);
        // dd($dataPosts);
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
        if ($auth == 1) // is admin
        {
            $en = $request->enable;
        } else {
            $en = 0;
        }
        $dataPostCreate = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'topic_id' => $request->topic_id,
            'post_type' => $request->type,
            'user_id' => Auth::id(),
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
            'post_id' => $id_post,
            'description_check' => null,
            'enable' => 1
        ];

        $toast = $this->check_post->create($data_check);
        if($toast){
            toast('Created Post Successfully!','success','top-right');
        }

        $user_type = (Auth::user());
        if ($user_type->user_type == 0) {
            return redirect()->route('guest.index');
        } else {
            return redirect()->route('posts.index');
        }
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
        if ($auth == 1) // is admin
        {
            $en = $request->enable;
            $user_id = $request->user_id;
        } else {
            $en = 0;
            $user_id = Auth::id();
        }
        $dataPostUpdate = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'topic_id' => $request->topic_id,
            'user_id' => $user_id,
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

        $toast = $this->posts->find($id)->update($dataPostUpdate);

        $id_post = json_decode($this->posts->where('title', $request->title)->first()->id);
        //dd($id_post);
        $data_check = [
            'post_id' => $id_post,
            'description_check' => null,
            'enable' => 0
        ];

        $this->check_post->updateOrCreate($data_check);
        if($toast){
            toast('Updated Successfully!','success','top-right');
        }
        $user_type = (Auth::user());
        if ($user_type->user_type == 0) {
            return redirect()->route('guest.index');
        } else {
            return redirect()->route('posts.index');
        }
    }

    public function destroy($id)
    {
        $a = $this->posts->find($id)->delete();
        if ($a) {
            toast('Deleted Successfully!', 'success', 'top-right');
        }
        $user_type = (Auth::user());
        if ($user_type->user_type == 0) {
            return redirect()->route('guest.index');
        } else {
            return redirect()->route('posts.index');
        }
    }

    // tìm title trong db->đối chứng với nhau xem có trùng nhau hay k->nếu trùng thì ko tạo->ngược lại thì tạo luôn vào database
    public function getTitle($title)
    {
        $title = $this->posts->where('title', $title)->get();
        return $title;
    }

    public function getApi(Request $request)
    {
        $url = "https://newsapi.org/v2/everything?domains=wsj.com&apiKey=87384f1c2fe94e11a76b2f6ff11b337f";

        $data = Http::get($url);

        $item = json_decode($data->body());

        $i = collect($item->articles)->random(10);

        $limit = $i->take(5);   // take limited 5 items

        $decode = json_decode($limit);

        //dd($decode);

        $array = array("trong-nuoc", "chung-khoan", "phim", "gioi-sao", "thi-cu", "bao-mat", 'tai-chinh', 'vien-thong', 'thi-truong');
            $t = $array[array_rand($array, 1)];
            $id_topic = $this->topics->where('slug', $t)->first()->id;

        foreach ($decode as $post) {
            $ite = (array)$post;
            dd($ite['description']);
            // create post 
            $dataPost = [
                'description' => $ite['description'],
                'content' => $ite['content'],
                'topic_id' => $id_topic,
                'post_type' => $request->type,
                'user_id' => Auth::id(),
                'enable' => '1',
                'feature_image_path' => $ite['urlToImage'],
                'slug' => Str::slug($ite['title'])
            ];
            
            $toast = $this->posts->firstOrCreate(
                ['title' => $ite['title']], [
                    $dataPost
                ]
            );
            if($toast){
                toast('Get Post with API Successfully!','success','top-right');
            }
        }
        return redirect()->route('posts.index');
    }

    public function check($id)
    {
        $au = Auth::user();
        $dataPost = $this->posts->find($id);
        $dataTopic = $this->topics->all();
        //$htmlSelect=$this->getTopicsUpdate($dataPost->id);
        return view('posts::check', compact('dataTopic', 'dataPost', 'au'));
    }

    public function checked(Request $request, $id)
    {
        $auth = Auth::user()->user_type;
        if ($auth == 1) // is admin
        {
            $en = $request->enable;
        } else {
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
            'post_id' => $id,
            'description_check' => $request->description_check,
            'enable' => 1
        ];
        //dd($dataPostUpdate);
        $toast = $this->posts->find($id)->update($dataPostUpdate);
        if($toast){
            toast('Updated Successfully!','success','top-right');
        }
        // get id check table
        $o = json_decode($this->check_post->with('post')->where('post_id', $id)->first()->id);
        // dd($o);
        $this->check_post->find($o)->update($data_check);
        $user_type = (Auth::user());
        if ($user_type->user_type == 0) {
            return redirect()->route('guest.index');
        } else {
            return redirect()->route('posts.index');
        }
    }
}

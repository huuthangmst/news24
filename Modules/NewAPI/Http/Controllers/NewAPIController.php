<?php

namespace Modules\NewAPI\Http\Controllers;

use App\Models\ApiKeys;
use App\Models\Categories;
use App\Models\CheckPosts;
use App\Models\Posts;
use App\Models\Topics;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\NewAPI\Http\Requests\AddPostRequestApi;
use Modules\NewAPI\Http\Services\CheckApiKey;
use Modules\NewAPI\utils\Handle;

class NewAPIController extends Controller
{
    private $apikey;
    private $posts;
    private $categories;
    private $user;
    private $check_post;

    public function __construct(Categories $categories, ApiKeys $apikey, Posts $posts, User $user, CheckPosts $check_post)
    {
        $this->apikey = $apikey;
        $this->posts = $posts;
        $this->categories = $categories;
        $this->user = $user;
        $this->check_post = $check_post;
    }


    public function index(Request $request)
    {
        $uri = $request->root();
        $keyData = $this->apikey->all();
        return view('newapi::index', compact('keyData', 'uri'));
    }


    public function getData(Request $request)
    {
        $key = $request->apiKey;

        $keyDB = json_decode($this->apikey->where('apiKey', $key)->get());

        if($keyDB != null){
            $data = $this->posts->skip(0)->take(10)->get();
            // $data = json_decode($this->categories->where('id',$category_id )->with('postss')->skip(0)->take(10)->first());
            // $post = $data->postss;
            return response()->json([
                ['message'=>'success', 'statusCode'=>200],
                ['data'=> $data]
            ], 200);
        }
        else{
            return response()->json([
                ['message'=>'Your API key is invalid or incorrect', 'code'=>'apiKeyInvalid', 'status'=>'error']
            ], 404);
        }
        
    }

    
    public function store(Request $request)
    {
        $api_key = md5($request->user_id);
        $data = [
            'apiKey'=>$api_key,
            'user_id'=>$request->user_id
        ];
        // dd(md5(1));
        
        $toast = $this->apikey->firstOrCreate($data);
        if($toast){
            toast('Created Post Successfully!','success','top-right');
        }
        return redirect()->route('newapi.index');
    }

    
    public function create()
    {
        $data_user = $this->user->all();
        return view('newapi::create', compact('data_user'));
    }

    
    public function edit($id)
    {
        $data_api = json_decode($this->apikey->find($id)->first());
        $data_user = $this->user->all();
        return view('newapi::edit', compact('data_api', 'data_user'));
    }

    
    public function update(Request $request, $id)
    {
        $find_id = json_decode($this->apikey->find($id)->first());
        $api_key = $find_id->apiKey;
        $data = [
            'apiKey'=>$api_key,
            'category_id'=>$request->category_id
        ];
        // dd($data);
        
        $toast = $this->apikey->find($id)->update($data);
        if($toast){
            toast('Update Successfully!','success','top-right');
        }
        return redirect()->route('newapi.index');
    }

    
    public function destroy($id)
    {
        $toast = $this->apikey->find($id)->delete();
        if($toast){
            toast('Delete Successfully!','success','top-right');
        }
        return redirect()->route('newapi.index');
    }


    // API
    // ADD POST
    public function createPost(AddPostRequestApi $request)
    {
        try{
            
            $checkKey = new CheckApiKey($request);
            $checkResult = $checkKey->ckeckApiKey($this->apikey);

            if($checkResult == true){
                $dataPostCreate = [
                    'title' => $request->title,
                    'description' => $request->description,
                    'content' => $request->content,
                    'topic_id' => $request->topic_id,
                    'post_type' => $request->post_type,
                    'user_id' => $request->user_id,
                    'feature_image_path'=>$request->feature_image_path,
                    'feature_image_name'=>$request->feature_image_name,
                    'enable' => $request->enable,
                    'slug' => Str::slug($request->title)
                ];
                
                // create post in database
                $this->posts->create($dataPostCreate);
            
                // get id post
                $id_post = json_decode($this->posts->where('title', $request->title)->first()->id);
                //dd($id_post);
                $data_check = [
                    'post_id'=>$id_post,
                    'description_check'=>null,
                    'enable'=>1
                ];
                
                // check post
                $this->check_post->create($data_check);
        
                return response()->json([
                    'status'=>'success',
                    'statusCode'=>200,
                    'message'=>'Create post successfully!',
                    'data'=>$dataPostCreate
                ], 200);
            }
            else{
                return response()->json([
                    ['message'=>'Your API key is invalid or incorrect', 'code'=>'apiKeyInvalid', 'status'=>'error']
                ], 404);
            }
            return response()->json($request);

        }catch(\Exception $e){

            return response()->json([
                'status'=>'failed',
                'statusCode'=>500,
                'message'=>$e,
            ], 500);
        }
    }

    // check id
    public function findId($id){
        $id = $this->posts->find($id);
        if($id){
            return true;
        }
        else{
            return false;
        }
    }

    // UPDATE POST API
    public function updatePost($id, Request $request){
        try{
            // check key
            $checkKey = new CheckApiKey($request);
            $checkResult = $checkKey->ckeckApiKey($this->apikey);

            // if apiKey not exits in database
            if($checkResult == true){
                // check id
                $kq = $this->findId($id);

                // if id post not exits in database
                if($kq){
                    $dataPostCreate = [
                        'title' => $request->title,
                        'description' => $request->description,
                        'content' => $request->content,
                        'topic_id' => $request->topic_id,
                        'post_type' => $request->post_type,
                        'user_id' => $request->user_id,
                        'feature_image_path'=>$request->feature_image_path,
                        'feature_image_name'=>$request->feature_image_name,
                        'enable' => $request->enable,
                        'slug' => Str::slug($request->title)
                    ];
                    
                    // create post in database
                    $this->posts->create($dataPostCreate);
            
                    return response()->json([
                        'status'=>'success',
                        'statusCode'=>200,
                        'message'=>'Create post successfully!',
                        'data'=>$dataPostCreate
                    ], 200);
                }
                else{
                    return response()->json([
                        'status'=>'failed',
                        'statusCode'=>400,
                        'message'=>'Id post invalid',
                    ], 400);
                }                
            }
            else{
                return response()->json([
                    ['message'=>'Your API key is invalid or incorrect', 'code'=>'apiKeyInvalid', 'status'=>'error', 'statusCode'=>400,]
                ], 400);
            }
            return response()->json($request);

        }catch(\Exception $e){

            return response()->json([
                'status'=>'failed',
                'statusCode'=>500,
                'message'=>$e,
            ], 500);
        }
    }

    // DELETE POST API
    public function deletePost($id){
        $handle = new Handle();
        try{
            // find id
            $id_result = $this->findId($id);
            if($id_result){
                $this->posts->find($id)->delete();                
                return $handle->errorHandle('success', "200", "Delete post is successfully!");
            }
            else{
                return $handle->errorHandle('failed', "400", "Id post invalid!");
            }
        }catch(\Exception $e){
            return $handle->errorHandle('failed', "500", $e);
        }
    }

    // GET ALL CATEGORIES
    public function getCategories(Request $request){
        $key = $request->apiKey;
        $keyDB = json_decode($this->apikey->where('apiKey', $key)->get());

        if($keyDB != null){
            $data = $this->categories->all();
            return response()->json([
                ['message'=>'success', 'statusCode'=>200],
                ['data'=> $data]
            ], 200);
        }
        else{
            return response()->json([
                ['message'=>'Your API key is invalid or incorrect', 'code'=>'apiKeyInvalid', 'status'=>'error']
            ], 404);
        }
    }

    // GET ALL TOPICS
    public function getTopics(Request $request){
        $key = $request->apiKey;
        $keyDB = json_decode($this->apikey->where('apiKey', $key)->get());

        if($keyDB != null){
            $data = Topics::all();
            return response()->json([
                ['message'=>'success', 'statusCode'=>200],
                ['data'=> $data]
            ], 200);
        }
        else{
            return response()->json([
                ['message'=>'Your API key is invalid or incorrect', 'code'=>'apiKeyInvalid', 'status'=>'error']
            ], 404);
        }
    }
}

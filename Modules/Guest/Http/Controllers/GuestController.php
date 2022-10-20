<?php

namespace Modules\Guest\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Categories;
use App\Models\CheckPosts;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{

    private $posts;
    private $categories;
    private $user_post;
    private $check_post;
    public function __construct(Posts $posts, Categories $categories, User $user_post, CheckPosts $check_post)
    {
        $this->posts = $posts;
        $this->categories = $categories;
        $this->user_post = $user_post;
        $this->check_post = $check_post;
    }
    public function index()
    {
        $auth_id = Auth::user()->id;
        $dataPosts = json_decode($this->user_post->with('post_list')->where('id', $auth_id)->first());
        //$data_check = json_decode($)
        //dd($dataPosts);
        return view('guest::index', compact('dataPosts'));
    }

    public function list_check()
    {
        $auth_id = Auth::user()->id;
        $dataPost = json_decode($this->posts->with('post_user')->with('post_check')->where('user_id', $auth_id)->orderBy('id','desc')->get());
        //dd($dataPost);
        return view('guest::listcheck', compact('dataPost'));
    }

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
        return view('guest::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('guest::edit');
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

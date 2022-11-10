<?php

namespace Modules\Users\Http\Controllers;

use App\Models\ApiKeys;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Users\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    private $users;
    public function __construct(Categories $categories, User $users)
    {
        $this->users = $users;
    }
    public function index()
    {
        $users_data = User::all();
        return view('users::index', compact('users_data'));
    }

    
    public function create()
    {
        return view('users::create');
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        return view('users::show');
    }

    
    public function edit($id)
    {
        $data_user = json_decode($this->users->find($id));
        return view('users::edit', compact('data_user'));
    }

    
    public function update(UpdateUserRequest $request, $id)
    {
        $data_update = [
            'name'=>$request->name,
            'email'=>$request->email
        ];
        $toast = $this->users->find($id)->update($data_update);
        if($toast){
            toast('Update User Successfully!','success','top-right');
        }
        return redirect()->route('users.index');
    }

    
    public function destroy($id)
    {
        $toast = $this->users->find($id)->delete();
        // if delete user -> delete api key for user
        $inf_api = ApiKeys::where('user_id', $id)->first()->id;
        
        ApiKeys::find($inf_api)->delete();

        if($toast){
            toast('Delete User Successfully!','success','top-right');
        }
        return redirect()->route('users.index');
    }
}

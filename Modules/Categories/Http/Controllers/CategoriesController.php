<?php

namespace Modules\Categories\Http\Controllers;

use Modules\Categories\Http\Requests\CategoriesAddRequest;
use Modules\Categories\Http\Requests\CategoriesUpdateRequest;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Categories;
use App\Models\Posts;
use App\Models\Topics;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{

    private $categories;
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    
    public function index()
    {
        $dataCategories = $this->categories->latest()->paginate(8);
        return view('categories::index', compact('dataCategories'));
    }

    
    public function create()
    {
        return view('categories::create');
    }

    
    public function store(CategoriesAddRequest $request)
    {
        // call model and create
        $toast = $this->categories->create([
            'name' => $request->name,
            'enable' => $request->enable,
            'slug' => Str::slug($request->name)
        ]);
        if($toast){
            toast('Created Categories Successfully!','success','top-right');
        }
        return redirect()->route('categories.index');
    }

    
    public function show($id)
    {
        return view('categories::show');
    }

    
    public function edit($id)
    {
        $dataCategories = $this->categories->find($id);
        return view('categories::edit', compact('dataCategories'));
    }

    
    public function update(CategoriesUpdateRequest $request, $id)
    {
        $toast = $this->categories->find($id)->update([
            'name' => $request->name,
            'enable' => $request->enable,
            'slug' => Str::slug($request->name)
        ]);
        if($toast){
            toast('Update Categories Successfully!','success','top-right');
        }
        return redirect()->route('categories.index');
    }

    
    public function destroy($id)
    {
        Posts::whereRelation('topics','category_id', '=', $id)->delete();
        Topics::where('category_id', $id)->delete();
        
        $toast = $this->categories->find($id)->delete();
        if($toast){
            toast('Delete Categories Successfully!','success','top-right');
        }
        
        return redirect()->route('categories.index');
    }
}

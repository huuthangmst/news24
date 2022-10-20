<?php

namespace Modules\Categories\Http\Controllers;

use Modules\Categories\Http\Requests\CategoriesAddRequest;
use Modules\Categories\Http\Requests\CategoriesUpdateRequest;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Categories;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{

    private $categories;
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $dataCategories = $this->categories->latest()->paginate(10);
        return view('categories::index', compact('dataCategories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('categories::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CategoriesAddRequest $request)
    {
        // call model and create
        $this->categories->create([
            'name' => $request->name,
            'enable' => $request->enable,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('categories::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $dataCategories = $this->categories->find($id);
        return view('categories::edit', compact('dataCategories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CategoriesUpdateRequest $request, $id)
    {
        $this->categories->find($id)->update([
            'name' => $request->name,
            'enable' => $request->enable,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->categories->find($id)->delete();
        return redirect()->route('categories.index');
    }
}

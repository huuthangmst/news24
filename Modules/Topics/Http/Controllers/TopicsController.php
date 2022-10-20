<?php

namespace Modules\Topics\Http\Controllers;

use Modules\Topics\Http\Components\SelectCategories;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Categories;
use App\Models\Topics;
use GuzzleHttp\Promise\Create;
use Modules\Topics\Http\Requests\CreateTopicsRequest;
use Modules\Topics\Http\Requests\UpdateTopicsRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TopicsController extends Controller
{
    private $categories;
    private $topics;
    public function __construct(Categories $categories, Topics $topics)
    {
        $this->categories=$categories;
        $this->topics=$topics;
    }
    
    public function index()
    {
        $dataTopics = $this->topics->latest()->paginate(10);
        return view('topics::index', compact('dataTopics'));
    }

    public function getCategories($categoriesId)
    {
        $data= $this->categories->all();
        $options = new SelectCategories($data);
        $htmlSelect = $options->categoriesSelect($categoriesId);
        return $htmlSelect;
    }

    
    public function create()
    {
        //dd('xin chao');
        $htmlSelect = $this->getCategories($categoriesId = '');
        return view('topics::create', compact('htmlSelect'));
    }

    
    public function store(CreateTopicsRequest $request)
    {
        // call model and create
        $this->topics->create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'enable'=>$request->enable,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('topics.index');
    }

    
    public function show($id)
    {
        return view('topics::show');
    }
    
    public function edit($id)
    {
        $dataTopic = $this->topics->find($id);
        $dataCate = $this->categories->all();
        return view('topics::edit', compact('dataTopic', 'dataCate'));
    }

    public function getCategoriesUpdate($categoriesId)
    {
        $data= $this->categories->all();
        $options = new SelectCategories($data);
        $htmlSelect = $options->categoriesSelectUpdate($categoriesId);
        return $htmlSelect;
    }

    
    public function update(UpdateTopicsRequest $request, $id)
    {
        $this->topics->find($id)->update([
            'name' => $request->name,
            'category_id'=> $request->category_id,
            'enable' => $request->enable,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('topics.index');
    }

    
    public function destroy($id)
    {
        $this->topics->find($id)->delete();
        return redirect()->route('topics.index');
    }
}

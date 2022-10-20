<?php
namespace Modules\Topics\Http\Components;

use App\Models\Categories;

class SelectCategories{
    private $data;
    private $htmlSelect = '';
    public function __construct($data)
    {
        $this->data=$data;
    }
    public function categoriesSelect($selectId, $id=0){
        foreach ($this->data as $value){
            $this->htmlSelect .= "<option value='" .$value['id'] ."'>". $value['name'] ."</option>";
        }
        return $this->htmlSelect;
    }

    public function categoriesSelectUpdate($selectId){        
        foreach ($this->data as $value){
            if($selectId==$value->id){
                
                $this->htmlSelect .= "<option selected value='" .$value['id'] ."'>". $value['name'] ."</option>";
            }else{
                $this->htmlSelect .= "<option value='" .$value['id'] ."'>". $value['name'] ."</option>";
            }
        }
        return $this->htmlSelect;
    }
}
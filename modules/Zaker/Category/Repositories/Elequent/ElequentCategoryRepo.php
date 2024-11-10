<?php

namespace Zaker\Category\Repositories\Elequent;
use Zaker\Category\Models\Category;
use Zaker\Category\Repositories\CategoryInterface;
use Zaker\Core\Elequent\ElequentBaseRepository;

class ElequentCategoryRepo extends ElequentBaseRepository implements CategoryInterface
{
//    public function all()
//    {
//        return Category::all();
//    }
    public function findById($id)
    {
       return Category::find($id);
    }

    public function allExceptById($id)
    {
       return $this->all()->filter(function ($item) use ($id){
           return $item->id != $id;
        });
    }

    public function update($values,$id)
    {
        Category::where('id',$id)->update($values);
    }

    public function delete($id)
    {
        Category::destroy($id);
    }
}

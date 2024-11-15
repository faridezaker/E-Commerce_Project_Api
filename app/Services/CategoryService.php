<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ParentCategoryResource;
use App\Models\Category;

class CategoryService
{
    public function all()
    {
        return CategoryResource::collection(Category::all());
    }

    public function store($data)
    {
        return new CategoryResource(Category::create($data));
    }

    public function find($category)
    {
      return new CategoryResource($category);

    }

    public function update($data, $categoryId)
    {
        Category::where('id', $categoryId)->update($data);
        return new CategoryResource(Category::find($categoryId));
    }

    public function delete($categoryId)
    {
        Category::destroy($categoryId);
    }

    public function parentCategory()
    {
        return ParentCategoryResource::collection(Category::whereNull('parent_id')->get());
    }

    public function allExceptById($categoryId)
    {
       return ParentCategoryResource::collection(Category::where('id','!=',$categoryId)->get());
    }

}

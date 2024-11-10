<?php

namespace Zaker\Category\Http\Controllers;
use Zaker\Category\Http\Requests\CategoryRequest;
use Zaker\Category\Models\Category;
use Zaker\Category\Repositories\CategoryInterface;
//use Zaker\Category\Repositories\Elequent\CategoryRepo;
use Zaker\Category\Responses\AjaxResponses;

class CategoryController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     */
    public $repo;
    public function __construct(CategoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $categories = $this->repo->all();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->repo->store($request->validated());
        return response(['message'=>'دسته بندی با موفقیت ایجاد شد'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($categoryId)
    {
        $category = $this->repo->findById($categoryId);
        $categories = $this->repo->allExceptById($categoryId);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'category' => $category,
                'categories' => $categories
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,$categoryId)
    {
        $this->repo->update($request->validated(),$categoryId);
        return response(['message'=>'دسته بندی با موفقیت ویرایش شد'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        $this->repo->delete($categoryId);

       return  AjaxResponses::SuccessResponse();
    }
}

<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ParentCategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $CategoryService;
    public function __construct(CategoryService $service)
    {
        $this->CategoryService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     ** path="/api/categories",
     *  tags={"categories"},
     *  description="show categories",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function index()
    {
        return response()->json([
            'result'=>true,
            'data'=>[
                'categories'=>$this->CategoryService->all(),
                'parentCategories'=> $this->CategoryService->parentCategory()
            ]
        ],200);
    }

    /**
     * @OA\Post(
     ** path="/api/categories",
     *  tags={"categories"},
     *  description="save category",
     * @OA\RequestBody(
     *    required=true,
     *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="parent_id",
     *                  description="parent id",
     *                  type="integer",
     *               ),
     *     *           @OA\Property(
     *                  property="title",
     *                  description="title",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="slug",
     *                  description="slug",
     *                  type="string",
     *               ),
     *           ),
     *       )
     * ),
     *   @OA\Response(
     *      response=200,
     *      description="Data saved",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function store(CategoryRequest $request)
    {
        return response()->json([
            'result' => true,
            'data' => [
                'message' => 'دسته بندی با موفقیت درج شد',
                'category' => $this->CategoryService->store($request->validated()),
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     ** path="/api/categories/{id}",
     *  tags={"categories"},
     *  description="get category details data by category id",
     *     @OA\Parameter(
     *         description="category id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function show(Category $category)
    {
        return response()->json([
            'result' => true,
            'data' => [
                'category' => $this->CategoryService->find($category),
                'parentCategories'=>$this->CategoryService->allExceptById($category->id)
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Put(
     * path="/api/categories/{id}",
     * tags={"categories"},
     * description="update category",
     * @OA\Parameter(
     *     description="category id",
     *     in="path",
     *     name="id",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *     ),
     * ),
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             @OA\Property(
     *                 property="parent_id",
     *                 description="parent id",
     *                 type="integer",
     *             ),
     *             @OA\Property(
     *                 property="title",
     *                 description="title",
     *                 type="string",
     *             ),
     *             @OA\Property(
     *                 property="slug",
     *                 description="slug",
     *                 type="string",
     *             ),
     *         ),
     *     ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Data saved",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *     )
     * )
     *)
     **/
    public function update(CategoryRequest $request, Category $category)
    {
        return response()->json([
            'result' => true,
            'data' => [
                'message' => 'دسته بندی با موفقیت ویرایش شد',
                'category' =>$this->CategoryService->update($request->validated(),$category->id),
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * @OA\Delete(
     ** path="/api/categories/{id}",
     *  tags={"categories"},
     *  description="get category details data by category id",
     *     @OA\Parameter(
     *         description="category id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function destroy(Category $category)
    {
        $this->CategoryService->delete($category->id);
        return response()->json([
            'result' => true,
            'data' => [
                'message' => 'دسته بندی با موفقیت حذف شد',
            ]
        ], 200);
    }
}


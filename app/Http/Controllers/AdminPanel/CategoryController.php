<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
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
     *  tags={"categories Page"},
     *  description="get products page data",
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
        $cayegories = $this->CategoryService->all();

        return response()->json([
            'result'=>true,
            'message'=>'application home page',
            'data'=>[
                'categories'=>$cayegories
            ]

        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Get(
     ** path="/api/categories/store",
     *  tags={"categories Page"},
     *  description="store category",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}


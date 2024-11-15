<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public $RoleService;
    public $PermissionService;
    public function __construct(RoleService $service,PermissionService $permissionService)
    {
        $this->RoleService = $service;
        $this->PermissionService = $permissionService;
    }
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     ** path="/api/roles",
     *  tags={"Roles and Permissions"},
     *  description="show rolepermission",
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
                'roles'=> $this->RoleService->allRolesAndPermissions(),
            ]
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     ** path="/api/roles",
     *  tags={"Roles and Permissions"},
     *  description="save role and permission",
     * @OA\RequestBody(
     *    required=true,
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *          @OA\Property(
     *              property="name",
     *              description="name of the role",
     *              type="string",
     *          ),
     *          @OA\Property(
     *              property="permissions[]",
     *              description="permissions array",
     *              type="array",
     *              @OA\Items(
     *                  type="string",
     *              ),
     *          ),
     *       ),
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Data saved",
     *    @OA\MediaType(
     *        mediaType="application/json",
     *    )
     * )
     * )
     */
    public function store(RoleRequest $request)
    {
        return response()->json([
            'result' => true,
            'data' => [
                'message' => 'دسته بندی با موفقیت درج شد',
                'roles' => $this->RoleService->store($request->validated()),
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     ** path="/api/roles/{id}",
     *  tags={"Roles and Permissions"},
     *  description="get category details data by category id",
     *     @OA\Parameter(
     *         description="role id",
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
    public function show(Role $role)
    {
        return response()->json([
            'result' => true,
            'data' => [
                'role' => $this->RoleService->find($role),
                'allPermissions' => $this->PermissionService->all()
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RoleRequest;
use App\Repositories\User\RoleRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    /**
     * Summary of middleware
     * 
     * Check user permission is valid or not
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view', only: ['list']),
            new Middleware('permission:create', only: ['create', 'assign']),
            new Middleware('permission:edit', only: ['edit', 'update']),
            new Middleware('permission:delete', only: ['destroy']),
        ];
    }
    protected $role;
    /**
     * Create new role instance
     * 
     * @param \Spatie\Permission\Models\Role
     */
    public function __construct(Role $role)
    {
        $this->role = new RoleRepository($role);
    }

    /**
     * Summary of list
     * 
     * @return mixed|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function list()
    {
        return $this->role->list();
    }

    /**
     * Summary of update
     * 
     * @param \App\Http\Requests\User\RoleRequest
     * @return mixed|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function create(RoleRequest $request)
    {
        return $this->role->create($request);
    }

    /**
     * Summary of edit
     * 
     * @param $id;
     * @return mixed|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->role->edit($id);
    }

    /**
     * Summary of update
     * 
     * @param \App\Http\Requests\User\RoleRequest
     * @param $id
     * @return mixed|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        //dd($request);
        return $this->role->update($request, $id);
    }

    /**
     * Summary of destroy
     * 
     * @param $id
     * @return mixed|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        return $this->role->destroy($id);
    }

    /**
     * Summary of update
     * 
     * @param \Illuminate\Http\Request;
     * @param $id
     * @return mixed|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function assign(Request $request, $id)
    {
        //dd($request);
        return $this->role->assign($request, $id);
    }
}

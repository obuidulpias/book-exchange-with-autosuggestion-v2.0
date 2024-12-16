<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Auth;
use DB;
use Spatie\Permission\Models\Role;


class RoleRepository extends BaseRepository
{
    protected $role;
    public function __construct(Role $role)
    {
        $this->role = new BaseRepository($role);
    }

    public function list()
    {
        try {
            $roles = Role::with('permissions')->get();
            return $this->response = apiResponse($roles, 'Data fetch successfully.');
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }

    }

    public function create($data)
    {
        //dd($data['permisssion_data']);
        DB::beginTransaction();
        try {
            $role_data = [
                'name' => $data['name'],
            ];
            $role = $this->role->create($role_data);
            if (!empty($data['permisssion_data'])) {
                foreach ($data['permisssion_data'] as $name) {
                    $role->givePermissionTo($name);
                }
            }
            DB::commit();
            return $this->response = apiResponse($role);
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }

    public function edit($id)
    {
        try {
            $role = $this->role->find($id);
            return $this->response = apiResponse($role, 'Data found successfully.');
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }

    public function update($data, $id)
    {
        DB::beginTransaction();
        try {
            $role = $this->role->find($id);
            //$role = Role::find($id);
            if (!empty($role)) {
                $role->update(['name' => $data['name']]);
                if (!empty($data['permisssion_data'])) {
                    $role->syncPermissions($data['permisssion_data']);
                } else {
                    $role->syncPermissions([]);
                }
                DB::commit();
                return $this->response = apiResponse($role, 'Data updated successfully.');
            } else {
                return $this->response = apiResponse($role, 'Data not found.');
            }

        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }

    public function destroy($id)
    {
        try {
            $role = $this->role->find($id);
            if (!empty($role)) {
                $role->delete();
                return $this->response = apiResponse($role, 'Data deleted successfully.');
            } else {
                return $this->response = apiResponse($role, 'Data not found.');
            }
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }

    public function assign($data, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            //dd($user);
            //$role = Role::find($id);
            if (!empty($user)) {
                if (!empty($data['role_data'])) {
                    $user->syncRoles($data['role_data']);
                } else {
                    $user->syncPermissions([]);
                }
                DB::commit();
                return $this->response = apiResponse($user, 'Data updated successfully.');
            } else {
                return $this->response = apiResponse($user, 'Data not found.');
            }

        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }


}
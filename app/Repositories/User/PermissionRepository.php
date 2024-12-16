<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use Auth;
use DB;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
{
    protected $permission;
    public function __construct(Permission $permission)
    {
        $this->permission = new BaseRepository($permission);
    }

    public function list()
    {
        try {
            $permissions = $this->permission->all();
            return $this->response = apiResponse($permissions, 'Data fetch successfully.');
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }

    }

    public function create($data)
    {
        //dd($data);
        try {
            $permission_data = [
                'name' => $data['name'],
            ];
            $this->permission->create($permission_data);
            return $this->response = apiResponse($permission_data);
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }

    public function edit($id)
    {
        try {
            $permission = $this->permission->find($id);
            return $this->response = apiResponse($permission);
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }

    public function update($data, $id)
    {
        try {
            $permission = $this->permission->find($id);
            if (!empty($permission)) {
                //$permission->name = $data['name'];
                $permission_data = [
                    'name' => $data['name'],
                ];
                $permission = $permission->update($permission_data);
                return $this->response = apiResponse($permission, 'Data updated successfully.');
            } else {
                return $this->response = apiResponse($permission, 'Data not found.');
            }

        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }

    public function destroy($id)
    {
        try {
            $permission = $this->permission->find($id);
            if (!empty($permission)) {
                $permission->delete();
                return $this->response = apiResponse($permission, 'Data deleted successfully.');
            } else {
                return $this->response = apiResponse($permission, 'Data not found.');
            }
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }


}
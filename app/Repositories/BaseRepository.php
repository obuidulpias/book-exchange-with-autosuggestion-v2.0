<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    // model property on class instances
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function create($data)
    {
        return $this->model->create($data);
    }
    public function find($id)
    {
        return $this->model->find($id);
    }
    public function update($data, $id)
    {
        return $this->model->update($data, $id);
    }
    public function delete($id)
    {
        return $this->model->delete();
    }


}
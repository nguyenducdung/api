<?php
namespace App\Repositories\Base;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /** @var Model $model */
    protected $model;

    public function create($attribute)
    {
        return $this->model->create($attribute);
    }

    public function find($id, $relations = [])
    {
        if (!empty($relations)) {
            return $this->model->with($relations)->find($id);
        }
        return $this->model->find($id);
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function updateById($id, $input)
    {
        return $this->model->where('id', $id)
            ->update($input);
    }

    public function firstOrNew($input)
    {
        return $this->model->firstOrNew($input);
    }

    public function firstOrCreate($input)
    {
        return $this->model->firstOrCreate($input);
    }

    public function insertMulti($input)
    {
        return $this->model->insert($input);
    }
}
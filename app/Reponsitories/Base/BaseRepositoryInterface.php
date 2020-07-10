<?php
namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Base BaseRepositoryInterface
 * @package App\Repositories\Base
 */
interface BaseRepositoryInterface
{
    /**
     * @param $input
     * @return Model
     */
    public function create($input);

    /**
     * @param $id
     * @param $input
     * @return Model
     */
    public function updateById($id, $input);

    /**
     * @param $id
     * @param $relations
     * @return mixed
     */
    public function find($id, $relations);

    /**
     * @param $input
     * @return Model
     */
    public function firstOrNew($input);

    /**
     * @param $input
     * @return Model
     */
    public function firstOrCreate($input);

    /**
     * @param $input
     * @return mixed
     */
    public function insertMulti($input);

    /**
     * @param $id
     * @return void
     */
    public function delete($id);

}
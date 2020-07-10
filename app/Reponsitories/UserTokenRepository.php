<?php

namespace App\Repositories;

use App\Model\UserToken;
use App\Repositories\Base\BaseRepository;

class UserTokenRepository extends BaseRepository
{
    public function __construct(UserToken $model)
    {
        $this->model = $model;
    }

    /**
     * @param $token
     * @return UserToken
     */
    public function findByToken($token)
    {
        return $this->model->where('token', $token)
            ->first();
    }
    public function getAll(){
        return $this->model->orderBy('id','desc')->get();
    }
    public function delete($id){
        return $this->model->delete($id);
    }

}

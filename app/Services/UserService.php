<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\UserTokenRepository;
use Carbon\Carbon;

class UserService {


    /** @var UserRepository $userRepository */
    protected $userRepository;
    /** @var UserTokenRepository $userTokenRepository */
    protected $userTokenRepository;

    public function __construct(UserRepository $userRepository, UserTokenRepository $userTokenRepository)
    {
        $this->userTokenRepository = $userTokenRepository;
        $this->userRepository      = $userRepository;
    }


    public function findUserById($id)
    {
        return $this->userRepository->find($id);
    }
    public function getAllUser(){
        return $this->userRepository->getAllUser();
    }
    public function updateUserInfo($userId,$params){
        return $this->userRepository->updateUser($userId,$params);
    }
    public function makeCode(){
        return$pass = substr(md5(uniqid(mt_rand(), true)) , 0, 5);
    }

}

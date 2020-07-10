<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserTokenRepository;

class AuthService {

    /** @var UserRepository $userRepository */
    protected $userRepository;

    /** @var UserTokenRepository $userTokenRepository */
    protected $userTokenRepository;
    protected $customerRepository;
    public function __construct(UserRepository $userRepository, UserTokenRepository $userTokenRepository,CustomerRepository $customerRepository)
    {
        $this->userTokenRepository = $userTokenRepository;
        $this->customerRepository = $customerRepository;
        $this->userRepository      = $userRepository;
    }

    /**
     * @param $token
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function verifyToken($token)
    {
        $userToken = $this->userTokenRepository->findByToken($token);

        if (!$userToken) {
            return null;
        }

        return $this->customerRepository->find($userToken->user_id);
    }
}

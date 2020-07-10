<?php

namespace App\Services;

use App\Repositories\CustomerRepository;

class CustomerService {

    protected $billService;
    protected $customerRepository;
    public function __construct(
        CustomerRepository $customerRepository,
        BillService $billService
    )
    {
        $this->billService = $billService;
        $this->customerRepository = $customerRepository;
    }


    public function findUserById($id)
    {
        return $this->customerRepository->find($id);
    }
    public function getAllUser(){
        return $this->customerRepository->getAllUser();
    }
    public function updateUserInfo($userId,$params){
         $this->customerRepository->updateUser($userId,$params);
        return $this->customerRepository->find($userId);
    }

    public function makeCode(){
        return$pass = substr(md5(uniqid(mt_rand(), true)) , 0, 5);
    }
    public function delete($id){
        $this->customerRepository->delete($id);
        $bills = $this->billService->getBillByCustomer($id);
        if (!empty($bills)){
            foreach ($bills as $item){
                $this->billService->delete($item->id);
            }
        }
        return true;
    }

}

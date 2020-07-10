<?php

namespace App\Services;


use App\Repositories\VoucherRepository;

class VoucherService {


    protected $voucherRepository;
    public function __construct(VoucherRepository $voucherRepository)
    {
        $this->voucherRepository = $voucherRepository;
    }

    public function getAll(){
        return $this->voucherRepository->getAll();
    }
    public function getByCustomer($customerId){
        return $this->voucherRepository->getByCustomer($customerId);
    }
    public function findById($id){
        return $this->voucherRepository->findById($id);
    }
    public function create($params){
        return $this->voucherRepository->create($params);
    }
    public function updateVoucher($voucherId, $params){
        return $this->voucherRepository->updateById($voucherId,$params);
    }

}

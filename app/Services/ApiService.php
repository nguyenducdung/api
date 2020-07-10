<?php

namespace App\Services;

use App\Repositories\CustomerRepository;


class ApiService {

    public function jsonResponse($status,$field,$fieldData,$code){
        return response()->json(['status' => $status, $field => $fieldData], $code);

    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($file,$path){

        $ext = $file->getClientOriginalExtension();
        $new_name = auth()->id().'_'.random_int(1,strtotime(Carbon::now())).'.'.$ext;
        $link = $path.'/'.$new_name;
        $file->move(public_path().'/'.$path,$new_name);
        return $link;
    }
}

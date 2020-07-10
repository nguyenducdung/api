<?php

namespace App\Services;



class ImageService {

    public function uploadImage($file,$name){
        $path = '/upload/photo';
        $upload_date = date('d_m_Y_H_i_s');
        $newName = $name.rand(0,99999). "_" .$upload_date.'.png';
        $avatar_url = $path.'/'.$newName;
        $file->move(public_path() . $path, $newName);
        return $avatar_url;
    }
    public function deleteImages($file_name){
        if (file_exists(public_path() .$file_name)){
            $delete = unlink(public_path() .$file_name);
            return $delete;
        }
        return false;
    }
}

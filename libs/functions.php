<?php

use yii\web\UploadedFile;

function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if ($die) {
        $die;
    }
}

//function img_upload($insert){
//    if ($file = UploadedFile::getInstance($this, 'file')) {
//        $dir = 'images/' . date("Y-m-d") . '/';
//        if (!is_dir($dir)) {
//            mkdir($dir);
//        }
//        $file_name = uniqid() . '_' . $file->baseName . '.' . $file->extension;
//        $this->img = $dir . $file_name;
//        $file->saveAs($this->img);
//    }
//}

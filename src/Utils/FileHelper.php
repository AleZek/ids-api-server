<?php
/**
 * Created by PhpStorm.
 * User: zek
 * Date: 04/05/18
 * Time: 17.56
 */

namespace App\Utils;


class FileHelper
{
    public function __construct()
    {
    }

    public function deleteFile($path){
        return unlink($path);
    }
}
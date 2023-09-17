<?php
require_once "config.php";
class Uploader extends Config
{
    public function uploadPic($pic, $dir)
    {
        $folder = 'folder-' . rand();
        if (!file_exists($dir . '/' . $folder)) {
            mkdir($dir . '/' . $folder);
            $picname = $pic['name'];
            
        }
    }
}

?>

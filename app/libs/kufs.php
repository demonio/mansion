<?php
/**
 */
class Kufs
{    
    # 
    static function files2path($files_name, $path_to, $new_name='')
    {
        $files = $_FILES[$files_name];
        $dir = $_SERVER['DOCUMENT_ROOT'] . $path_to;
        $dir = str_replace('//', '/', $dir);
        #if ($files_name == 'intro_voz') _::d($dir);
        if ( ! file_exists($dir) ) mkdir($dir, 0777, 1);
        foreach ($files['error'] as $key=>$error) :
            if ($error <> UPLOAD_ERR_OK) continue;
            $name = ($new_name) ? $new_name : basename($files['name'][$key]);
            move_uploaded_file($files['tmp_name'][$key], "$dir/$name");
        endforeach;
        return empty($name) ? '' : "$dir/$name";
    }
}

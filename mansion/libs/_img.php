<?php
/**
 */
class _img
{    
    static function makeThumb($src, $dest, $desired_width, $desired_height='')
    {
        $extension = explode('.', $src);
        $extension = end($extension);
        if ($extension == 'jpg') $extension = 'jpeg';
        $imagecreate = "imagecreatefrom$extension";
        $image = "image$extension";
        
        /* read the source image */
        $source_image = $imagecreate($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);
        
        /* find the "desired height" of this thumbnail, relative to the desired width  */
        if ( ! $desired_width ) $desired_width = floor( $width*($desired_height/$height) );
        
        /* find the "desired height" of this thumbnail, relative to the desired width  */
        if ( ! $desired_height ) $desired_height = floor( $height*($desired_width/$width) );
        
        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
        imagesavealpha($virtual_image, true);
        $trans_colour = imagecolorallocatealpha($virtual_image, 0, 0, 0, 127);
        imagefill($virtual_image, 0, 0, $trans_colour);
        
        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
        #imagecopyresized($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
        
        /* create the physical thumbnail image to its destination */
        return $image($virtual_image, $dest);
    }
}

<?php 
function compresser($source, $destination, $quality){
    $info = getimagesize($source);
    if($info["mime"] == "image/jpeg"){
        $image = imagecreatefromjpeg($source);
    }elseif($info["mime"] == "image/gif"){
        $image = imagecreatefromgif($source);
    }elseif($info["mime"] == "image/png"){
        $image = imagecreatefrompng($source);
    } else {
        return;
    }
    imagejpeg($image, $destination, $quality);
    return $destination;
}
//compress("data/lap.jpg", "data/lap.jpg", 30);
?>
<?php
//Resimleri sıkıştıran fonksiyon
function compress_image($source_url, $destination_url, $quality) {
    $info = getimagesize($source_url);

    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);

    imagejpeg($image, $destination_url, $quality);

    return $destination_url;
}

//Klasörün ve alt klasörlerinin içindeki dosyaları bulan ve resimleri sıkıştıran fonksiyon
function findAndCompress($dir){
    $ffs = scandir($dir);
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            if(is_dir($dir.'/'.$ff)){
                                findAndCompress($dir.'/'.$ff);
            }else{
                    $compressed = compress_image($dir."/".$ff, $dir."/".$ff, 50);
            } 
        }
    }
}

$klasor = "uploads/2020/12";
findAndCompress($klasor);
echo $klasor;

?>
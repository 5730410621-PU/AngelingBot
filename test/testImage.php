<?php
$overlayImage="overImage.png";  //image 512 x 512
$backgroundImage="1000.jpeg"; //1000 x 10000

 $im = imagecreatefromjpeg($backgroundImage);
 $condicion = GetImageSize($overlayImage); // get image format

 if($condicion[2] == 1) //gif
 $im2 = imagecreatefromgif("$overlayImage");
 if($condicion[2] == 2) //jpg
 $im2 = imagecreatefromjpeg("$overlayImage");
 if($condicion[2] == 3) //png
 $im2 = imagecreatefrompng("$overlayImage");

 imagecopy($im, $im2, (imagesx($im)/2)-(imagesx($im2)/2), (imagesy($im)/2)-(imagesy($im2)/2), 0, 0, imagesx($im2), imagesy($im2));

 imagejpeg($im,"test4.jpg",90);
 imagedestroy($im);
 imagedestroy($im2);
<?php
function saveImageCert($originalImage, $font, $name, $dir, $saveName)
{
	$text = $name;
	$text1 =  "прошёл тест от Grub775";
	$date = date("d:m:Y");
	$time = date("H:i:s");
	$image = imagecreatetruecolor(640, 464);
	$backColor = imagecolorallocate($image, 31, 31, 31);
	$fontColor = imagecolorallocate($image, 177, 0, 0);
	$fontFile = $font;
	$imageCertificate = imagecreatefrompng($originalImage);
	imagefill($image, 0, 0, $backColor);
	imagecopy($image, $imageCertificate, 0, 0, 0, 0, 640, 464);
	imagettftext($image, 18, 0, 190, 130, $fontColor, $fontFile, $text1);
	imagettftext($image, 18, 0, 250, 182, $fontColor, $fontFile, $text);
	imagettftext($image, 16, 0, 82, 388, $fontColor, $fontFile, $date);
	imagettftext($image, 16, 0, 473, 388, $fontColor, $fontFile, $time);
	imagePng($image, $dir . $saveName); 
	imagedestroy($image);
}
<?php
// The file
$filename = isset($_GET['file']) ? $_GET['file'] : '';

$file = getimagesize($filename);

$percent = 0.5;

// Content type
header('Content-Type: image/jpeg');

// Get new dimensions
list($width, $height) = getimagesize($filename);
$new_width = 200;
$new_height = ($new_width / $width) * $height;

// Resample
$image_p = imagecreatetruecolor($new_width, $new_height);

switch($file['mime'])
{
    case 'image/jpeg':
	$image = imagecreatefromjpeg($filename);
    
	break;
    case 'image/png':
	$image = imagecreatefrompng($filename);
    
	break;
}

imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Output
imagejpeg($image_p, null, 70);
?>
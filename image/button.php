<?php
header("Content-type: image/png");
$string = $_GET['text'];
$im     = imagecreatefrompng("button.png");
$orange = imagecolorallocate($im, 60, 87, 156);
$px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
imagestring($im, 4, $px, 9, $string, $orange);
imagepng($im);
imagedestroy($im);
?>

<html>
<body>
    <img src="button.php?text=intro" />
    <img src="button.php?text=member" />
    <img src="button.php?text=history" />
    <img src="button.php?text=mission" />
</body>
</html>
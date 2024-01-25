<?php
session_start();

$panjangCaptcha = 6;

$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$string = '';
for ($i = 0; $i < $panjangCaptcha; $i++) {
    $string .= $karakter[rand(0, strlen($karakter) - 1)];
}

$_SESSION['captcha'] = $string;

$lebar = 70;
$tinggi = 30;
$gambar = imagecreate($lebar, $tinggi);

$warnaPutih = imagecolorallocate($gambar, 255, 255, 255);
$warnaHitam = imagecolorallocate($gambar, 0, 0, 0);

imagefill($gambar, 0, 0, $warnaPutih);

$fontSize = 20;
$x = 10;
$y = 17;
imagestring($gambar, $fontSize, $x, $y, $string, $warnaHitam);

header('Content-type: image/png');
imagepng($gambar);
imagedestroy($gambar);
?>

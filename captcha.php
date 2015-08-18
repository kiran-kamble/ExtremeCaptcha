<?php
session_start();              //session is started for storing captcha phrase

define('captcha_numbers',6);
define('captcha_width',150);
define('captcha_height',30);

$pass_phrase="";
for($i=0;$i<captcha_numbers;$i++)
  $pass_phrase.=chr(rand(97,122));

$_SESSION['sys_captcha']=$pass_phrase;  //storing captcha phrase on server

$img=imagecreatetruecolor(captcha_width,captcha_height);
$bg_color=imagecolorallocate($img,255,255,255);
$text_color=imagecolorallocate($img,0,0,0);
$graphic_color=imagecolorallocate($img,64,64,64);

imagefilledrectangle($img,0,0,captcha_width,captcha_height,$bg_color);

for($i=0;$i<2;$i++){
imageline($img,0,rand()%captcha_height,captcha_width,rand()%captcha_height,$graphic_color);
}

for($i=0;$i<50;$i++){
imagesetpixel($img,rand()%captcha_width,rand()%captcha_height,$graphic_color);
}

imagestring($img,9,captcha_width-90,captcha_height-20,$pass_phrase,$text_color);
//imagettftext($img,18,0,5,captcha_height-5,$text_color,'Courier New Bold.ttf',$pass_phrase);

header("Content-type:image/png");
imagepng($img);

?>

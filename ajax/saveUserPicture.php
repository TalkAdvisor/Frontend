<?php
$url = $_POST['url'];
$img = "user_$POST['facebook_id'].png";
file_put_contents($img, file_get_contents($url));
return $img;
?>
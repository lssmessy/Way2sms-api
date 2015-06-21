<?php
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://site24.way2sms.com/content/index.html");
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$response=curl_exec($ch);
curl_close($ch);
echo $response;

?>
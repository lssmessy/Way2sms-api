<?php 
$login_email = '8469212091';
$login_pass = '6881';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://site24.way2sms.com/content/index.html');
curl_setopt($ch, CURLOPT_POSTFIELDS,'username='.urlencode($login_email).'&password='.urlencode($login_pass).'&loginBTN=Login');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
curl_setopt($ch, CURLOPT_REFERER, "http://site24.way2sms.com");
$page = curl_exec($ch) or die(curl_error($ch));
echo $page;
?>
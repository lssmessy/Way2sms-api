<?php
 
//Upload a blank cookie.txt to the same directory as this file with a CHMOD/Permission to 777
function login($url,$data){
    $fp = fopen("cookie.txt", "w");
    fclose($fp);
    $login = curl_init();
    curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($login, CURLOPT_TIMEOUT, 40000);
    curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($login, CURLOPT_URL, $url);
    curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($login, CURLOPT_POST, TRUE);
    curl_setopt($login, CURLOPT_POSTFIELDS, $data);
	
	
	curl_setopt($login, CURLOPT_VERBOSE, 1);
	curl_setopt($login, CURLOPT_HEADER, 1);
	
	$response=curl_exec($login);
    ob_start();
	$header=curl_getinfo($login, CURLINFO_EFFECTIVE_URL);    

// Then, after your curl_exec call:
 $last=explode("id=",$header);
 $id=isset($last[1])? $last[1]: null;
 $_SERVER['by2_id_value']=$id;

   return $response;
    ob_end_clean();
    curl_close ($login);
    unset($login);    
	
}                  
 
function grab_page($site){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_URL, $site);
    ob_start();
    return curl_exec ($ch);
    ob_end_clean();
    curl_close ($ch);
}
 
function post_data($site,$data){
    $datapost = curl_init();
    $headers = array("Expect:");
    curl_setopt($datapost, CURLOPT_URL, $site);
    curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
    curl_setopt($datapost, CURLOPT_HEADER, TRUE);
    curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($datapost, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($datapost, CURLOPT_POST, TRUE);
    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
    curl_setopt($datapost, CURLOPT_COOKIEFILE, "cookie.txt");
    ob_start();
    return curl_exec ($datapost);
    ob_end_clean();
    curl_close ($datapost);
    unset($datapost);    
}
function getid($test){
	$url = $test;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $html = curl_exec($ch);
    $status_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);

if($status_code=302 or $status_code=301){
  echo curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
  }
curl_close($ch);
}
 
?>
<?php
// if(empty($_POST)===false & $_POST['mobile']!=""&$_POST['message']!="")
// {
// $mobile=$_POST['mobile'];
// $message=$_POST['message'];
//$message="Your activation code is ".rand(1000,9999);
$site='http://www.160by2.com/';
 login($site."re-login","rssData=&username=9426576315&password=08moth42&token=&hidDetails=&fbid=&userMobile1=&userPwd1=");

   $token=$_SERVER['by2_id_value'];

// grab_page($site."Main.action?id=".$token);
  
  //After clicking send sms option
  grab_page($site."Ramping?id=".$token);
   login($site."Dashboard?id=".$token,"hidSessionId=".$token."&hidval=&arrayInvite=&dashing=aug30");
  grab_page($site."Ramping?id=".$token);
   grab_page($site."SendSMS?id=".$token);
  // grab_page($site."PhoneBook?id=1433498934023");
  // echo grab_page($site."GetMsgs?id=1433498934017&catgid=32&catName=Good%20Luck&pageNo=0");
  // grab_page($site."PhoneBook?id=1433498934034");
  
  //After sending message 
   grab_page($site."Ramping?id=".$token);
  
 
  login($site."SendSMSDec19","hid_exists=no&fkapps=SendSMSDec19&newsUrl=&pageContext=normal&linkrs=&hidSessionId=".$token."&msgLen=140&maxwellapps=".$token."&feb2by2action=sa65sdf656fdfd&WYISQ=&SCQQPF=8469212091&sendSMSMsg=Obvioous+thisnf&newsExtnUrl=&ulCategories=32&messid_0=If+u+view+all+the+things+that+happen+to+u%2Cboth+good+and+bad%2Cas+opportunities%2Cthen+u+operate+out+of+a+higher+level+of+consciousness&messid_1=Send+someone+a+note+that+reads+Congratulations.Regardless+of+who+he+is%2Che%27ll+think+he%27s+done+something+the+past+week+2+deserve+it&messid_2=Retirement+Wish%0D%0AIt+is+time+for+u%0D%0A2+luck+back+with+pride+and+satisfaction%0D%0Aon+ur+well+lived%0D%0AAnd+look+forward+2+all+the+things%0D%0Au+are+yet+2&messid_3=Put+ur+trust+on+God+nd+reply+on+his+help+4+u+don%27t+source+4+help+when+u+have+a+source+of+help.Wishing+u+all+the+best+cheers&messid_4=To+accomplish+great+things%2Cwe+must+not+only+act%2Cbut+also+dream%2Cnot+only+plan+but+also+believe.Best+wishes+for+ur+exam&reminderDate=05-06-2015&sel_hour=HH&sel_minute=MM");//."&msgLen=115"
 
  echo grab_page($site."SendSMSConfirm.action?id=".$token);
  // grab_page($site."Main.action?id=".$token);
 // echo "Your message has been successfully sent";
// }
// else
// {
	// header('Location: send_msg.php');
// }
 ?>
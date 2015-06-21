<?php
 //Upload a blank cookie.txt to the same directory as this file with a CHMOD/Permission to 777
function login($url,$data){
    $fp = fopen("cookie.txt", "w");
    fclose($fp);
    $login = curl_init();
    curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($login, CURLOPT_TIMEOUT, 90000);
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
 $_SERVER['id_value']=$id;

   return $response;
    ob_end_clean();
    curl_close ($login);
    unset($login);    
	
}                  
 
function grab_page($site){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90000);
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
if(empty($_POST)===false & $_POST['mobile']!=""&$_POST['message']!="")
{
$response=array();
$username=$_POST['username'];
$password=$_POST['password'];

$mobile=$_POST['mobile'];
$message=$_POST['message'];

//$message="Your activation code is ".rand(1000,9999);
$site='http://site24.way2sms.com/';
login($site."Login1.action","username=".$username."&password=".$password."");

 $token=$_SERVER['id_value'];
	if(strlen($token)<37){
	$response['message']="Error while logging in";
	$response['is_sent']=false;
echo json_encode($response); 
	}
	else {
	
	
 grab_page($site."main.action?section=s&Token=".$token);
 //grab_page($site."jsp/ReAdd.jsp?Token=".$token);
 grab_page($site."sendSMS?Token=".$token);

login($site."smstoss.action","ssaction=ss&Token=".$token."&mobile=".$mobile."&message=".$message);//."&msgLen=115"
//echo grab_page($site."smscofirm.action?SentMessage=".$message."&Token=".$token."&status=0");
$response['message']="Your message has been successfully sent to ".$mobile;
$response['is_sent']=true;
echo json_encode($response); 
}
}
else
{
$response['is_sent']=false;
echo json_encode($response);
	header('Location: /send_msg.php');
}
 ?>
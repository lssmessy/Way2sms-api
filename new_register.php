
<?php 
include "../core/init.php";
$response=array();
if(empty($_POST)===false)
{
	$required=array('username','password','email','address','mobile','type');
		foreach($_POST as $key=>$value)
	{
		if(empty($value) and in_array($key,$required)===true)
		{
		$errors[]="Fields marked with * are required";
		$response['errors']=$errors;
		break 1;
		}
		
	}
	if(empty($errors)===true)
	{
		if(user_exists_tifin($_POST['username'])===true)
		{
			$user_name=htmlentities($_POST['username']);
			$errors[]="Username '{$user_name}' is already registered";
			$response['errors']=$errors;
		}
		if(preg_match("/\\s/",$_POST['username'])==true)
		{
			$errors[]="Space is not allowed for username field";
			$response['errors']=$errors;
		}
		if(strlen($_POST['password'])<6)
		{	
			$errors[]="Password length should be at least 6 characters";
			$response['errors']=$errors;
		}
		/* if($_POST['password']!=$_POST['password_again'])
		{
			$errors[]="Passwords do not match";
			$response['errors']=$errors;
		} */
		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)==false)
		{
			$errors[]="Please enter a valid email";
			$response['errors']=$errors;
		}
		if(email_exists_tifin($_POST['email'])===true)
		{
			$email=htmlentities($_POST['email']);
			$errors[]="Email id '{$email}' is already in use..Try another!!";
			$response['errors']=$errors;
		}
		
	}
	
}
if(empty($_POST)==false && empty($errors)==true)
{	
		
	$code=mt_rand(1000,9999);	
	$register_data=array(
	'Username'   =>$_POST['username'],
	'Password'   =>$_POST['password'],
	'Email'      =>$_POST['email'],
	'Address'	 =>$_POST['address'],
	'Mobile'	 =>$_POST['mobile'],
	'Type'	 =>$_POST['type'],
	'Activation_Code'	 =>$code,
	'Email_Code'  =>md5($_POST['username']+ microtime()));
	$success=register_user_tifin($register_data);
	if($success==true)
	{
		$response['registered']=true;
		$response['activation_code']=$code;
	}
	
	else
		$response['registered']=false;
	
	$response['errors']='none';
	
}

echo json_encode($response);
?>

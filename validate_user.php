<?php
include('../core/init.php');
$response=array();
if(empty($_POST)===false)
{
	$username=$_POST['username'];
	$password=$_POST['password'];

	if(empty($username)|| empty($password))
	{
		$errors[]='Username/Password can\'t be blank';
		
	}
		else if(!user_exists_tifin($username))
		{
	        $errors[]="User does not exist";
			$response['errors']=$errors;
		$response['user_validated']=false;
		
		}

		// else if(!user_active($username))
		// {
			// $errors[]="Your account is not activated yet <br> <a href='activate_email.php'>Activate now</a>";
		
		// }
	else
	{
		$login=login_tifin($username,$password);
		
		if($login===false)
		{
			$errors[]="Username/Password does not match";
			$response['errors']=$errors;
		$response['user_validated']=false;
		}
		else
		{
			
			$_SESSION['user_id']=$login;
			$_SESSION['user_name']=$username;
			$response['username']=$username;
			$cookie_alive=set_cookie($username);
			$response['user_validated']=true;
			
		}
	}
}
if(empty($errors)==false)
{

	echo output_errors($errors);
	$response['errors']=$errors;
}
echo json_encode($response);
?>

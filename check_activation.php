<?php
include "../core/init.php";
$response=array();

if(!empty($_POST['activation_code'])&&!empty($_POST['username']))
{
	$username=$_POST['username'];
	$code=$_POST['activation_code'];
	$query=mysql_query("SELECT * FROM `tifins` WHERE `Activation_Code`='$code' AND `Username`='$username'");
	$row=mysql_num_rows($query);
	if($row>0)
	{
		$response['match']=true;
		$query=mysql_query("UPDATE tifins SET `Is_Active`=1 WHERE `Username`='$username'");
	}
	else
	{
		$response['match']=false;
	}
}
else if($_POST['regenerate']=="true"&&!empty($_POST['username']))
	
{
	$username=$_POST['username'];
	$new_code=mt_rand(1000,9999);	
	$query=mysql_query("UPDATE tifins SET `Activation_Code`='$new_code' WHERE `Username`='$username'");
	$response['new_code']=$new_code;
}
else {

	$response['errors']='something went wrong';

}
	echo json_encode($response);
?>
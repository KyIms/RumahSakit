<?php
function check_login()
{
if(strlen($_SESSION['userid'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";
		$_SESSION["userid"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>
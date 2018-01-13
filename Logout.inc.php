<?php

require_once('sesssion.inc.php');

if(isset($_SESSION["user_name"]) AND isset($_SESSION["user_id"])){



session_unset();

session_destroy();

header('Location:index.php');
exit;



}else {


	header('Location: log-in.php');
	exit;

}







?>
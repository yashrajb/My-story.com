<?php
require_once('sesssion.inc.php');
require_once('db.inc.php');

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die("Error in establishing connection");



if(isset($_SESSION["user_name"]) AND isset($_SESSION["user_id"])) {

	if(!empty($_SESSION["user_name"]) AND !empty($_SESSION["user_id"])) {


		if(isset($_GET["q"]) AND !empty($_GET["q"])) {

			$del = mysqli_real_escape_string($connect,strip_tags($_GET["q"]));

			$query = 'SELECT * FROM lyrics WHERE id='.$del;
			$result = mysqli_query($connect,$query);
			$row = mysqli_fetch_array($result);

			if($row["user_name"]==$_SESSION["user_id"]) {



				$query2 = 'DELETE FROM lyrics WHERE id='.$del;

				$result2 = mysqli_query($connect,$query2);

				header('location: main.php');
				exit;




			}else {



				header('Location: 404.php');
				exit;


			}




		}else {
		header('Location: main.php');
	exit;
}




	}else {
		header('Location: index.php');
	exit;
}






}else {



	header('Location: index.php');
	exit;




}




















?>
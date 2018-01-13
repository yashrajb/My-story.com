<?php
require_once('db.inc.php');
require_once('sesssion.inc.php');

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die();


if(isset($_SESSION["user_name"]) AND isset($_SESSION["user_id"]) AND !empty($_SESSION["user_name"]) AND !empty($_SESSION["user_id"])) {


	if(isset($_POST["old_pass"]) AND isset($_POST["new_pass"]) AND isset($_POST["new_re_pass"])) {

		$old_pass = mysqli_real_escape_string($connect,md5(md5($_POST["old_pass"])));
		$new_pass = mysqli_real_escape_string($connect,md5(md5($_POST["new_pass"])));
		$re_new_pass = mysqli_real_escape_string($connect,md5(md5($_POST["new_re_pass"])));

		$query = 'SELECT user_key FROM users WHERE id='.$_SESSION["user_id"];
 		$result = mysqli_query($connect,$query);
 		$row = mysqli_fetch_array($result);


 		if($row["user_key"]==$old_pass) {

 			if($new_pass==$re_new_pass) {


 					if(strlen($new_pass) > 6 AND strlen($re_new_pass) > 6) {



 				$query1 = 'UPDATE users SET user_key="'.$new_pass.'" WHERE id='.$_SESSION["user_id"];
 				$result = mysqli_query($connect,$query1);

 				if(mysqli_affected_rows($connect)==0) {


 					echo 'Something went wrong pls check your internet connection';



 				}else {


 						header('location: main.php');
 						exit();




 				}








 					} else {



 						echo 'pls enter more than 6 characters password';



 					}


 				





 			}else {


 					echo 'password is not matching';



 			}






 		}else {



 				echo 'old password is wrong';




 		}










	}else {


 ?>
<!doctype html>
<html>
  <head>
      <title>My story | write your story,share your emotions,share your knowledge,share your story
      </title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
<link href="css/header.css" rel="stylesheet" type="text/css">
<style>
footer {
	margin-top:54px;
}
</style>
</head>
	
<body>

<?php require_once('loginHeader.inc.php'); ?>

<div class="container" style="margin-top:130px;">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
	<div class="form-group">
		<label for="old_pass">old password:</label>
		<input type="password" name="old_pass" id="old_pass" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="old_pass">new password:</label>
		<input type="password" name="new_pass" id="old_pass" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="old_pass">retype new password:</label>
		<input type="password" name="new_re_pass" id="old_pass" class="form-control" required>
	</div>

	<input type="submit" name="submit" value="submit" class="btn btn-default">
</form>
</div>


<?php require_once("footer.inc.php"); ?>

</body>
</html>



<?php


	}









}else {


	header('location: log-in.php');
	exit;


}





?>
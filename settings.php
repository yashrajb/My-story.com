<?php

require_once('db.inc.php');
require_once('sesssion.inc.php');

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die();

$msg = '';

if(isset($_POST["submit"])) {

$query1 = 'DELETE FROM users WHERE users.id='.$_SESSION["user_id"].';';



if($result=mysqli_query($connect,$query1)){

	$query2 = 'DELETE FROM lyrics WHERE lyrics.user_name='.$_SESSION["user_id"].';';

	if($result2=mysqli_query($connect,$query2)) {

		$query3 = 'DELETE FROM profiles WHERE profiles.user_name='.$_SESSION["user_id"].';';


			if($result3=mysqli_query($connect,$query3)) {


				$query4 = 'DELETE FROM lyricslike WHERE lyricslike.user_id='.$_SESSION["user_id"];

				if($result4=mysqli_query($connect,$query4)) {

					session_unset();
					session_destroy();
					header('Location: index.php');
					exit;


				}

					

			}


	}


}



	


	}else {





		}













if(isset($_SESSION["user_name"]) AND isset($_SESSION["user_id"])) {

	if(!empty($_SESSION["user_name"]) AND !empty($_SESSION["user_id"])) {


?>
<!doctype html>
<html>
<head>
 <title>My story | write your story,share your emotions,share your knowledge,share your story</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/index-main.css" rel="stylesheet" type="text/css">
<style>
.main {

	margin-top:70px;
	
}
footer {
	margin-top:46px;
}
</style>
</head>

<body>

	<?php require_once('loginHeader.inc.php'); ?>

		<div class="container main">
			<?php echo $msg; ?>
			<h2>Delete account</h2>
			<p>Delete your account permanenty </p>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<input type="submit" name="submit" class="btn btn-danger" value="<?php echo 'DELETE Account'; ?>">
			</form>
		</div>

		<div class="container main">
			<?php echo $msg; ?>
			<h2>Change password</h2>
			<p>Change password of your account </p>
			<a href="change_password.php" class="btn btn-success">
				<?php echo 'Change password'; ?>
			</a>
		</div>


<?php require_once('footer.inc.php'); ?>
</body>
</html>



<?php









	}else {


		header('Location: main.php');
		exit;



}







}else {



header('Location: index.php');




}












?>
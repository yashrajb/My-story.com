<?php
require_once('db.inc.php');
require_once('sesssion.inc.php');
$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die('Error on establishing connection');


if(isset($_POST["lyrics_title"]) AND isset($_POST["lyrics_body"]) AND isset($_POST["value"])) {

	$lyrics_title = mysqli_real_escape_string($connect,strip_tags($_POST["lyrics_title"]));
	$lyrics_body = mysqli_real_escape_string($connect,strip_tags($_POST["lyrics_body"]));
	$value = mysqli_real_escape_string($connect,strip_tags($_POST["value"]));
	$query5 = 'UPDATE `lyrics` SET `lyrics` = "'.$lyrics_body.'", '.'`title` = "'.$lyrics_title.'" WHERE `lyrics`.`id` = '.$value;
	$result = mysqli_query($connect,$query5);
	header('location: main.php');
	exit;


}else {


		if(isset($_SESSION["user_name"]) AND !empty($_SESSION["user_name"])) {
	if(isset($_SESSION["user_id"]) AND !empty($_SESSION["user_id"])) {

		if(isset($_GET["q"]) AND !empty($_GET["q"])) {

			$edit = mysqli_real_escape_string($connect,strip_tags($_GET["q"]));
			$query2 = 'SELECT * FROM lyrics WHERE id='.$edit.' AND user_name='.$_SESSION["user_id"];
			$result2 = mysqli_query($connect,$query2);


			if(mysqli_num_rows($result2)==0) {



					header('location: main.php');
					exit;


			}else {

					$row2 = mysqli_fetch_array(mysqli_query($connect,$query2));
					
				



				
?>
<!doctype html>
<html>
<head>

	 <title>My story | write your story,share your emotions,share your knowledge,share your story</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
<link href="css/header.css" rel="stylesheet" type="text/css">
<style type="text/css">
footer {

margin-top:30px;


}
</style>
</head>
<body>

<?php 
require_once("loginHeader.inc.php"); 
?>
<div class="container" id="main" style="margin-top:76px;">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

		<div class="form-group">
			<label for="lyrics_title">Title:</label>
			<input type="text" name="lyrics_title" id="lyrics_title" class="form-control" value='<?php echo $row2["title"]?>'>
		</div>
			<input type="hidden" name="value" value="<?php echo $row2["id"]; ?>">
		<div class="form-group">
			<label for="lyrics_body">Lyrics:</label>
			<textarea rows="25" cols="20" name="lyrics_body" id="lyrics_body" class="form-control"><?php echo $row2["lyrics"];?></textarea>
		</div>

		<input type="submit" value="submit" name="submit" id="submit" class="btn btn-default">

	</form>
</div>

<?php require_once("footer.inc.php"); ?>

</body>
</html>

<?php



			}

}else {



			header('location: main.php');
			exit;



		}




	}else {


		header('location: log-in.php');
		exit;

	}
}else {


		header('location: log-in.php');
		exit;

	}




}

?>



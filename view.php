<?php
require_once('sesssion.inc.php');
require_once('db.inc.php');
$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die("Error in establishing connection");



if(isset($_GET["q"]) AND !empty($_GET["q"])) {


$view = mysqli_real_escape_string($connect,strip_tags($_GET["q"]));
$query1 = 'SELECT * FROM lyrics WHERE title="'.$view.'"';
$result1 = mysqli_query($connect,$query1);
$row1 = mysqli_fetch_array($result1);


				if(mysqli_num_rows($result1)==0) {



					header('Location: 404.php');
					exit;


				}else {


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
<style>
footer {
	margin-top:30px;
}
</style>
</head>
<body>
<?php require_once((isset($_SESSION["user_name"]) AND !empty($_SESSION["user_name"]) AND isset($_SESSION["user_id"]) AND !empty("user_id"))?"loginHeader.inc.php" : "header.inc.php"); 
$query2 = 'SELECT display_name FROM users WHERE id='.$row1["user_name"];
$result2 = mysqli_query($connect,$query2);
$row2 = mysqli_fetch_array($result2);
?>
<div class="container" style="margin-top:80px;">
	<h1><?php echo $row1["title"]; ?></h1>
	<p><small><span class="glyphicon glyphicon-user"></span> <a href="<?php echo 'profile.php?q='.$row2["display_name"]; ?>"><?php echo 'By - '.$row2["display_name"]; ?></a></small><br/>
	<small><span class="glyphicon glyphicon-time"></span> <?php echo 'Date - '.$row1["time"]; ?></small></p>
	<p>
		<?php echo $row1["lyrics"];?>
	</p>

	<p>
			<?php
			

			if(isset($_SESSION["user_name"]) AND isset($_SESSION["user_id"])){

				if($row1["user_name"]==$_SESSION["user_id"]) {

			echo '<a href="editlyrics.php?q='.$row1["id"].'"><span class="glyphicon glyphicon-pencil"></span> Edit</a>';
			echo '<a style="margin-left:10px;" href="dellyrics.inc.php?q='.$row1["id"].'"><span class="glyphicon glyphicon-trash"></span> Delete</a>';
		
				}else {



					echo '';


				}


			}		


			

}

?>
	</p>

</div>

<?php require_once('footer.inc.php'); ?>


</body>
</html>












<?php

}else {


	header('location:main.php');
	exit();



}
?>
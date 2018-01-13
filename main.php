<?php
require_once('sesssion.inc.php');
require_once('db.inc.php');
$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT);
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
<style type="text/css">

#lyrics-div {

	
	margin-top:80px;

}
#main-danger h2 {
	margin-top:300px;
	text-align:center;
	
}
footer {

margin-top:200px;


}
</style>
</head>
<body>

<?php

if(isset($_SESSION["user_name"]) AND isset($_SESSION["user_id"]) AND !empty($_SESSION["user_name"]) AND !empty($_SESSION["user_id"])) {




require_once('loginHeader.inc.php');
$query = 'SELECT *,SUBSTRING(lyrics, 1, 300) AS "user_lyrics" '.' FROM lyrics WHERE user_name="'.$_SESSION['user_id'].'";';

if($result=mysqli_query($connect,$query)) {


	if(mysqli_num_rows($result)==0) {


?>

<div class="container" id="main-danger">
	<h2 class="alert alert-danger" style="background-color:white;border:0px;">You not written any lyrics</h2>
</div>

<?php


	}else {

		echo '<div class="container" '.'id="lyrics-div">';

		while($row = mysqli_fetch_array($result)) {

			
		

					echo '<div class="col">';

					
					echo '<h2>'.$row["title"].'</h2>';
					echo '<small>'.'<span class="glyphicon glyphicon-user"></span>'.'  By - '.$_SESSION["user_name"].'</small><br/>';
					echo '<small>'.'<span class="glyphicon glyphicon-time"></span> '.$row["time"].'</small><br/>';
					echo '<p style="margin-top:5px;">'.$row["user_lyrics"].'......</p>';
					echo '<a href="view.php?q='.$row['title'].'">Read more</a>';
					echo ' <p style="display:inline;margin-left:7px;">'.'<a href="editlyrics.php?q='.$row["id"].'">'.'<span class="glyphicon glyphicon-pencil"></span> Edit </a>';
					echo ' <a href="dellyrics.inc.php?q='.$row['id'].'"'.' style="display:inline;margin-left:7px;">'.'<span class="glyphicon glyphicon-trash"></span> Delete </a></p>';

					echo '</div>';



			





		}

		echo '</div>';

		




	}





}






}else {


	header('Location: log-in.php');
	exit;

}



?>

<?php


require_once('footer.inc.php');


?>




</body>
</html>
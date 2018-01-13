<?php
require_once('sesssion.inc.php');
require_once('db.inc.php');
$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die("Error in establishing connection");
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
<link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet"/>
<link href="css/header.css" rel="stylesheet">
<link href="css/index-main.css" rel="stylesheet">
<style>
#big-image {
background-image:url("images/big-image.jpg");
background-size:cover;
background-attachment:fixed;
text-align:center;
margin-top:50px;
font-size:40px;
height:650px;

}

#big-image h1 {
	color:white;
	margin-top:150px;
	font-family:"Titillium Web";
	text-transform:uppercase;
}

#trends h2 {
	text-align:center;
	text-decoration: underline;
	text-transform: uppercase;
}

#trends {
	
	margin-bottom:35px;
	margin-top:-10px;
}

</style>
</head>
  
 <body>
 
 <?php 

 if(isset($_SESSION["user_id"]) AND isset($_SESSION["user_name"])){

 	require_once("loginHeader.inc.php");

 }else {
 require_once('header.inc.php');
}

$query1 = 'SELECT *,SUBSTRING(lyrics,1,300) AS "user_lyrics" FROM lyrics LIMIT 3';
$result1 = mysqli_query($connect,$query1);


 ?>
 
 <div class="jumbotron" id="big-image">
	<h1>People only hate what they see in themselves</h1>
	<span class="quote-user" style="font-size:20px;border-top:3px solid white;width:200px;display:inline-block;padding-top:10px;color:white;">By Marilyn manson</span>
 </div>
 
 
 <div class="container" id="trends">
	<h2>POPULAR STORIES</h2>
	<?php

		while($row1 = mysqli_fetch_array($result1)) {
		$query2 = 'SELECT display_name FROM users WHERE id='.$row1["user_name"];
		$result2 = mysqli_query($connect,$query2);
		$row2 = mysqli_fetch_array($result2);

?>
<div class="row">
	<div class="col">
		<h3><?php echo $row1["title"]; ?></h3>
		<small>
<a href="<?php echo 'profile.php?q='.$row2['display_name']; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $row2["display_name"];?></a><br/>

		</small>
<p style="margin-top:5px;"><?php echo $row1["user_lyrics"]; ?>......</p>
<a href="<?php echo 'view.php?q='.$row1['title'];?>">Read more</a>
	</div>
</div>
<?php

		}





	?>
 </div>
  
 <?php 
 require_once('footer.inc.php');
?>
 </body>
 </html>
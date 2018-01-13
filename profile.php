<?php
require_once('db.inc.php');
require_once('sesssion.inc.php');

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die();


if(mysqli_error($connect)) {


echo '<p>Something went wrong</p>';


}else {



		if(isset($_GET["q"]) AND !empty($_GET["q"])) {




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
#main {
	margin-top:80px;
}
footer {
	margin-top:40px;
}
</style>
</head>

<body>



<?php
require_once((isset($_SESSION["user_name"]) AND empty($_SESSION["user_name"] AND isset($_SESSION["user_id"]) AND empty($_SESSION["user_id"])))?'loginHeader.inc.php':'header.inc.php');
?>


<?php

$search = mysqli_real_escape_string($connect,strip_tags($_GET["q"]));


$query = 'SELECT users.id,users.display_name,users.electronics_mail,profiles.bio,profiles.profession,profiles.pic FROM users INNER JOIN profiles WHERE users.display_name="'.$search.'" AND '.'users.id=profiles.user_name';


$result = mysqli_query($connect,$query);



if(mysqli_num_rows($result)==0) {



echo '<div class="container main">';
echo '<h2 class="alert alert-danger">Theres is no user like "'.$search.'"</h2>';
echo '</div>';



}else {


$row = mysqli_fetch_array($result);


?>

<div class="container" style="margin-top:70px;">

<?php  

echo '<div class="text-right" style="margin-top:4px;">';

echo (isset($_SESSION["user_name"]) AND isset($_SESSION["user_id"]) AND $_SESSION["user_name"]==$row["display_name"] AND $_SESSION["user_id"]==$row["id"])?'<a href="edit.php?q='.$_SESSION["user_id"].'"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</a>':''; 

echo '</div>';



?>


	<div class="text-center thumbnail" style="border:0px;">
		<img style="width:150px;" class="thumbnail" src="<?php echo image_file_path.$row['pic']; ?>" alt="image">
	</div>


<div class="text-center">
		<p><strong>Name:</strong></p>
	<p><?php echo $row["display_name"]; ?></p>

		<p><strong>E-mail:</strong></p>
		<p><?php echo $row["electronics_mail"]; ?></p>

		<p><strong>Profession</strong></p>
		<p><?php echo ($row["profession"]==NULL OR $row["profession"]=='')? "not updated anything" : $row["profession"]; ?></p>

		<p><strong>Bio:</strong></p>
		<p><?php echo ($row["bio"]==NULL OR $row["bio"]=='')? "not updated anything" : $row["bio"]; ?></p>
</div>

<div class="text-center row">
<p><strong>Lyrics:</strong></p>


<?php


$query2 = 'SELECT *,SUBSTRING(lyrics,1,200) AS "user_lyrics" FROM lyrics WHERE user_name='.$row["id"];
$result2 =  mysqli_query($connect,$query2);


if(mysqli_num_rows($result2)==0) {

echo '<p>'.$search.' not written any lyrics </p>';

}

while($row2=mysqli_fetch_array($result2)) {
echo '<div class="col">';
echo '<h4>'.$row2["title"].'</h4>';
echo '<p>'.$row2["user_lyrics"].'.......</p>';
echo '<a href="view.php?q='.$row2['title'].'">Read more</a> ';


echo (isset($_SESSION["user_name"]) AND !empty($_SESSION["user_name"]) AND $row2["user_name"]==$_SESSION["user_id"]) ? '<a style="margin-left:7px;" href="editlyrics.php?q='.$row2["id"].'"><span class="glyphicon glyphicon-pencil"></span> Edit</a>  <a style="margin-left:7px;" href="dellyrics.inc.php?q='.$row2["id"].'"><span class="glyphicon glyphicon-trash"></span> Delete</a> '
: '';
echo '</div>';
}


?>



</div>

</div>







<?php



require_once('footer.inc.php');


}




?>















</body>







<?php

}else {



			if(isset($_SESSION["user_name"]) AND !empty($_SESSION["user_id"])) {

				if(isset($_SESSION["user_name"]) AND !empty($_SESSION["user_id"])) {


					header('Location: main.php');
					exit;

				}


			}else {


				header('Location: index.php');
				exit;



			} 






		}// end of else


















}




?>
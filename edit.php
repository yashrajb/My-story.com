<?php
require_once('db.inc.php');
require_once('sesssion.inc.php');
$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die();
$error = '';




if(isset($_POST) AND !empty($_POST)) {


$profile_prof = mysqli_real_escape_string($connect,$_POST["profile_prof"]);
$profile_bio = mysqli_real_escape_string($connect,$_POST["profile_bio"]);

if($_FILES["profile_photo"]["size"]>0) {

		
if($_FILES["profile_photo"]["type"]=="image/jpg" || $_FILES["profile_photo"]["type"]=="image/jpeg" || $_FILES["profile_photo"]["type"]=="image/png" || $_FILES["profile_photo"]["type"]=="image/gif")
{

	if($_FILES["profile_photo"]["size"] > 0) {

if(move_uploaded_file($_FILES["profile_photo"]["tmp_name"], image_file_path.$_FILES["profile_photo"]["name"])) {



$query = 'UPDATE profiles SET profession="'.mysqli_escape_string($connect,$profile_prof).'",'.'bio="'.mysqli_real_escape_string($connect,$profile_bio).'",'.'pic="'.mysqli_escape_string($connect,$_FILES["profile_photo"]["name"]).'" WHERE user_name='.$_SESSION["user_id"];

$result = mysqli_query($connect,$query);

if(mysqli_affected_rows($connect)!=0) {

	header('location: profile.php?q='.$_SESSION["user_name"]);
	exit();
}


}



}else {


		$error = 'Please upload not upload more than 900kb';

	}

}else {


$error = 'pls upload only png,jpg,jpeg,gif';



}







	}else {




$query = 'UPDATE profiles SET profession="'.mysqli_escape_string($connect,$profile_prof).'",'.'bio="'.mysqli_real_escape_string($connect,$profile_bio).'" '.'WHERE user_name='.$_SESSION["user_id"];

$result = mysqli_query($connect,$query);

if(mysqli_affected_rows($connect)!=0) {

	header('location: profile.php?q='.$_SESSION["user_name"]);
	exit();
}




		

	}

}





if(isset($_SESSION["user_id"]) AND isset($_SESSION["user_name"]) AND !empty($_SESSION["user_id"]) AND !empty($_SESSION["user_name"])) {


$query1 = 'SELECT * FROM profiles WHERE user_name='.$_SESSION["user_id"];
$result1 = mysqli_query($connect,$query1);
$rows1 = mysqli_fetch_array($result1);

$query2 = 'SELECT * FROM users WHERE id='.$_SESSION["user_id"];
$result2 = mysqli_query($connect,$query2);
$rows2 = mysqli_fetch_array($result2);

if(mysqli_num_rows($result1)!=0) {
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
#main {
	margin-top:80px;
	margin-bottom:40px;
}
</style>
</head>
<body>
<?php require_once('loginHeader.inc.php'); ?>
<div class="container" id="main">
	<?php echo $error; ?>
	<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<div class="form-group">
    		<label for="profile_photo">Profile photo:</label>
    		<input type="file" name="profile_photo" id="profile_photo">
    		<img class="thumbnail" style="width:250px;" src="<?php echo image_file_path.$rows1['pic']; ?>"/>
  		</div>
  <div class="form-group">
    <label for="profile_prof">Profession:</label>
    <input type="text" name="profile_prof" class="form-control" id="profile_prof" value="<?php echo $rows1['profession']; ?>">
  </div>
 <div class="form-group">
    <label for="profile_bio">Bio:</label>
    <textarea rows="10" name="profile_bio" class="form-control" id="profile_bio"><?php echo $rows1['bio']; ?></textarea>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
<?php
require_once('footer.inc.php');
echo '</body>';
}else{

		header('location: index.php');
		exit();

		}

}else {


header('location: index.php');
exit();


}



?>
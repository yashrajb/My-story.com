<?php


require_once('sesssion.inc.php');
require_once('db.inc.php');


$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die();

$msg = '';


if(isset($_POST["lyrics_title"]) AND !empty($_POST["lyrics_title"])) {


	if(isset($_POST["lyrics_body"]) AND !empty($_POST["lyrics_body"])) {




			$lyrics_title = mysqli_real_escape_string($connect,htmlspecialchars(strip_tags($_POST["lyrics_title"])));
			$lyrics_body = mysqli_real_escape_string($connect,htmlspecialchars(strip_tags($_POST["lyrics_body"])));


			$query4 = 'SELECT * FROM lyrics WHERE title="'.$lyrics_title.'";';
			$result4 = mysqli_query($connect,$query4);


			if(mysqli_num_rows($result4)===0) {


		$query = 'INSERT INTO lyrics (user_name,lyrics,time,title) VALUES ('.$_SESSION["user_id"].',"'.$lyrics_body.'",'.'NOW(),'.'"'.$lyrics_title.'");';

		if($result = mysqli_query($connect,$query)) {

		$query2 = 'SELECT * FROM lyrics WHERE title="'.$lyrics_title.'"';
		$result2 = mysqli_query($connect,$query2);
		$row2 = mysqli_fetch_array($result2);

	
					if($result3=mysqli_query($connect,$query2 )) {

						header('location: main.php');
						exit;


					}else {


						$msg = mysqli_error($connect);


					}
		

		}else {







		}
		


			


			}else {



				$msg = '<p class="alert alert-danger">Lyrics already exists</p>';



			}




	



	}




}









if(isset($_SESSION["user_name"]) AND !empty($_SESSION["user_name"])) {


	if(isset($_SESSION["user_id"]) AND empty($_SESSION["user_id"])) {


	header('Location: log-in.php');
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
</head>
<body>
<?php require_once('loginHeader.inc.php'); ?>

<div class=" container" style="margin-top:80px;margin-bottom:40px;">
	<h2 style="border-bottom:1px solid black;padding:0px 0px 10px 0px;">Write lyrics</h2>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
	<?php echo $msg; ?>
  <div class="form-group">
    <label for="lyrics_title">Title of lyrics</label>
    <input type="text" class="form-control" name="lyrics_title" placeholder="Enter title of lyrics......" id="lyrics_title" value="<?php echo (isset($lyrics_title) AND !empty($lyrics_title))? $lyrics_title :''; ?>"  required>
  </div>
  <div class="form-group">
    <label for="lyrics_body">Lyrics</label>
   	<textarea rows=20 cols=10 class="form-control" id="lyrics_body" name="lyrics_body" placeholder="Enter your lyrics here....." required><?php echo (isset($lyrics_body) AND !empty($lyrics_body))? $lyrics_body :''; ?></textarea>
 </div>
 
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>

<?php require_once('footer.inc.php'); ?>


</body>
</html>






<?php







	}



}else {





	header('Location: log-in.php');
	exit;


}



?>


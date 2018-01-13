<?php
require_once('sesssion.inc.php');
require_once('db.inc.php');


$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT);

$msg = '';

if($connect->error) {
	
	$msg = '<p class="alert alert-danger">something is wrong here</p>';
	
	
}else {


	if(isset($_SESSION["user_name"]) AND isset($_SESSION["user_id"])) {

		if(!empty($_SESSION["user_name"]) AND !empty($_SESSION["user_id"])) {

			header('Location: index.php');
			exit;


		}



	}else {



		if(!empty($_POST["email"]) AND !empty($_POST["username"]) AND !empty($_POST["pass"]) AND !empty($_POST["re-pass"]))
	{
		
		
		$email = mysqli_real_escape_string($connect,htmlspecialchars(strip_tags($_POST["email"])));
		$username = mysqli_real_escape_string($connect,htmlspecialchars(strip_tags($_POST["username"])));
		

		if(strlen(htmlspecialchars(strip_tags($_POST["pass"])))>6) {

			$pass= mysqli_real_escape_string($connect,md5(md5($_POST["pass"])));
			$rePass= mysqli_real_escape_string($connect,md5(md5($_POST["re-pass"])));
		
		if($pass==$rePass) {


			
			
			$query = 'SELECT * FROM users WHERE electronics_mail="'.$email.'" '.'AND display_name="'.$username.'"';
			
			if($result = mysqli_query($connect,$query)){
				
				if(mysqli_num_rows($result)==0) {
				
				$query2 = 'INSERT INTO users (id,electronics_mail,display_name,user_key) VALUES (NULL,"'.$email.'",'.'"'.$username.'",'.'"'.$pass.'")';
				$result2 = mysqli_query($connect,$query2);

$ext_query = 'SELECT id FROM users WHERE display_name="'.$username.'"';
$ext_result = mysqli_query($connect,$ext_query);
$ext_row = mysqli_fetch_array($ext_result);

	$query4 = 'INSERT INTO profiles (id,user_name,bio,profession) VALUES (NULL,'.$ext_row['id'].',NULL,NULL);';
	$result4 = mysqli_query($connect,$query4);
			

	header('Location: log-in.php');
	exit;
				
				}else {
					
					$msg = '<p class="alert alert-danger">user already existed</p>';
					
				}
				
			}else {
				
				$msg = '<p class="alert alert-danger">Something is happened wrong</p>';
				
			}
			
			
			
			
			
		}else {
			
			
			
			$msg = "<p class='alert alert-danger'>Password didn't match</p>";

			
			
		}

	}else {

		$msg = '<p class="alert alert-danger">Password length should be more than 10</p>';

	}
		
	}else {
		
		
		$msg = '<p class="alert alert-danger">please fill on the very blanks</p>';
		
	}
	

?>


<?php
	}
	
	
	
}

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
<style>
body {
	background-image:url("images/sign-up-background.jpg");
}

.container {
	margin-top:70px;
	margin-bottom:30px;
}
h2 {
	background-color:black;
	padding:10px;
	color:white;
}
form {
	padding:20px;
	background-color:white;
	margin-top:-10px;
}
</style>

	</head>
	
<body>
<?php 
require_once("header.inc.php");
?>



<div class="container">
	<h2>SIGN UP</h2>
	<div class="row">

		<div class="col-lg-12 col-xl-12 col-sm-12 col-xs-12 col-md-12 col">
			
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/x-www-form-encoded">
					<?php echo $msg?>
						<div class="form-group">
							<label for="email">Email address:</label>
							<input type="email" class="form-control" placeholder="E-mail....." name="email" id="email" required>
						  </div>
						  <div class="form-group">
							<label for="username">Username:</label>
							<input type="text" name="username" placeholder="Username..." class="form-control" id="username" required>
						  </div>
						  <div class="form-group">
							<label for="pass">Password:</label>
							<input type="password" class="form-control" placeholder="Password..." name="pass" id="pass" required>
						  </div>
						  <div class="form-group">
							<label for="re-pass">Retype Password:</label>
							<input type="password" class="form-control" placeholder="Retype username..." name="re-pass" id="re-pass" required>
						  </div>
						  <button type="submit" class="btn btn-default">Submit</button>
						  <p style="text-align:center;font-size:21px;margin-top:9px;">Already member?<br/><a href="log-in.php">Log in</a></p>
				</form>
			
		</div>
	</div>
</div>

<?php

	require_once('footer.inc.php');

?>


</body>
</html>
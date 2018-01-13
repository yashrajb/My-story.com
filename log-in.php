<?php
require_once('sesssion.inc.php');
require_once('db.inc.php');
	

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die();
$msg = '';
if($connect->error){
	
	$msg = "<p class='alert alert-danger'>There is something wrong</p>";
	
	
}else {



	if(isset($_SESSION["user_name"])) {



		$msg = 'You already logged in';




	}else {



			if(!empty($_POST["email"]) AND !empty($_POST["pwd"])) {
		
		$email = mysqli_real_escape_string($connect,htmlspecialchars(strip_tags($_POST["email"])));
		$password = mysqli_real_escape_string($connect,md5(md5($_POST["pwd"])));
		
		$query = 'SELECT * FROM users WHERE electronics_mail="'.$email.'" AND '.'user_key="'.$password.'";';
		
		if($result=mysqli_query($connect,$query)) {
			
			if(mysqli_num_rows($result)==0) {
				
				$msg = '<p class="alert alert-danger">User not exists</p>';
				
			}else {
				
				
				$row = mysqli_fetch_array($result);
				require_once('sesssion.inc.php');
				$_SESSION["user_name"] = $row["display_name"];
				$_SESSION["user_id"] = $row[0];
				header('Location: main.php');
				exit;
				
				
			}
			
			
		}else {
			
			$msg = "<p class='alert alert-danger'>Something happened is wrong</p>";
			
		}
		
	}else {
		
		
		
		$msg = '<p class="alert alert-danger">Please fill all the blanks</p>';
		
		
	}




	}

	

	
	
	
	
	
	
	
	
}



?>
<!doctype html>
<html>
  <head>
      <title>My story | write your story,share your emotions,share your knowledge,share your story
      </title>
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
	margin-top:100px;
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

if(!empty($_SESSION["user_name"]) AND !empty($_SESSION["user_id"])){

	require_once('loginHeader.inc.php');

?>



<div class="container" style="margin-top:240px;text-align:center;color:white">
<h2 class="alert alert-success">You already logged in</h2>
</div>






<?php
}else{
	require_once('header.inc.php');


 ?>

<div class="container">
	<h2>LOG IN</h2>
	<div class="row">

		<div class="col-lg-12 col-xl-12 col-sm-12 col-xs-12 col-md-12 col">
			
				<form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method="POST">
					<?php echo $msg ?>
						<div class="form-group">
							<label for="email">Email address:</label>
							<input type="email" class="form-control" name="email" id="email">
						  </div>
						  <div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" name="pwd" id="pwd">
						  </div>
						  <button type="submit" class="btn btn-default">Submit</button>
						  <p style="text-align:center;font-size:21px;margin-top:9px;">Not Member?<br/><a href="sign-up.php"> Sign up</a></p>
				</form>
			
		</div>
	</div>
</div>

<?php

}

?>



</body>
</html>
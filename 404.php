<?php
require_once('sesssion.inc.php');


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
require_once((isset($_SESSION["user_name"]) AND !empty($_SESSION["user_name"]) AND isset($_SESSION["user_id"]) AND !empty($_SESSION["user_id"]))?'loginHeader.inc.php':'header.inc.php');
?>


<div id="main" class="container">
	<h1 class="text-danger text-center">404</h1>
	<p class="text-center">Page that you finding is not exists</p>
</div>



</body>
</html>



<?php
require_once('db.inc.php');
require_once('sesssion.inc.php');
$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die();
if(isset($_SESSION["user_name"]) AND !empty($_SESSION["user_name"])) {
  $query = 'SELECT display_name FROM users WHERE id='.$_SESSION["user_id"];
  $result = mysqli_query($connect,$query);
  $row = mysqli_fetch_array($result);
?>

<style type="text/css">

.log-out {
  color:white !important;
}
.navbar-user {
  color:white!important;
  text-transform:capitalize;
}
.navbar-default {
  border:0px !important;
}
.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
    background-color:black;

}
#search_main {


margin-top:100px;
z-index:8;
border-bottom:1px solid black;


}

#search_main .name {
  margin-top:50px;
}

hr {
  border:1px solid lightgrey;
}
</style>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" style="color:white !important;" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar" style="color:white !important;"></span>
         

      <span class="icon-bar" style="color:white !important;"></span>
          <span class="icon-bar" style="color:white !important;"></span>
        </button>
        <a class="navbar-brand" href="index.php"><span style="display:inline-block;border:1px solid white;padding:6px;margin-top:-10px;">MS</span> <span style="border-bottom:1px solid white">MY STORY</span></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
       	<ul class="nav navbar-nav navbar-right">
      
      <li class="dropdown">
        <a class="dropdown-toggle navbar-user" data-toggle="dropdown" href="#"><?php echo "Hello <b><i>".$row['display_name'].'</i></b>'; ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="write.php"><span class="glyphicon glyphicon-plus navbar-gly"></span> Write story</a></li>
          <li><a href="main.php"><span class="glyphicon glyphicon-pencil navbar-gly"></span> Your story</a></li>
          <li><a href='profile.php?q=<?php echo $_SESSION["user_name"];?>'><span class="glyphicon glyphicon-user navbar-gly"></span> Profile</a></li>
          <li><a href="settings.php"><span class="glyphicon glyphicon-cog navbar-gly"></span> Settings</a></li>
        </ul>
      </li>
      <li><a class="log-out" href="Logout.inc.php">Logout</a></li>
      <li><a class="log-out" href="Logout.inc.php">About developer</a></li>
    </ul>
    <div class="navbar-form text-center">
      <div class="form-group row">
        <input type="text" id="search" style="width:300px;" class="form-control" name="search" placeholder="Search profile...">
        </div>
      </div>
    </div>
  </nav>
<div class="container" id="search_main">

</div>
<script src="main.js"></script>
<?php





}else {



  header('Location: index.php');
  exit;




}




?>


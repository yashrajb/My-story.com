<?php
require_once('db.inc.php');

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_SELECT) or die("Error in establishing connection");

if(isset($_GET["que"]) AND !empty($_GET["que"])) {

$search  = mysqli_real_escape_string($connect,strip_tags($_GET["que"]));
$query1 = 'SELECT users.display_name,profiles.bio,profiles.pic FROM users JOIN profiles ON users.display_name LIKE "%'.$search.'%" AND users.id=profiles.user_name';
$result1 = mysqli_query($connect,$query1);

echo '<p style="font-size:21px;">'.mysqli_num_rows($result1).' result of "'.$search.'"</p>';
if(mysqli_num_rows($result1)==0) {

echo '<h2 class="text-danger text-center">User not found</h2>';


}else {

    echo '<div class="container">';
    
    while($row1=mysqli_fetch_array($result1)) {
        
?>
<div class="row">
    <div class="col-lg-6 col-xl-6 col-md-6">

    <img class="thumbnail"  style="width:200px;display:inline-block;"src='<?php echo image_file_path.$row1["pic"]; ?>'> 

    </div>

    <div class="col-lg-6 col-xl-6 col-md-6">
    <h3><?php echo $row1["display_name"]; ?></h3>
    <p><?php echo $row1["bio"]; ?></p>
    <a href="<?php echo 'profile.php?q='.$row1["display_name"]; ?>">Read more</a>
    </div> 
</div>
<?php
        
        }
    
    echo '</div>';
        
}






}

?>


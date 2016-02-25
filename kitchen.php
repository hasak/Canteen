<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 15.04.2016.
 * Time: 10:01
 */
include ("includes/php.php");
if($level<3 and !$admin)
    header("location:http://".$_SERVER['HTTP_HOST']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php"); ?>
    <script src="includes/scripts/kitchen.js"></script>
    <title>Kitchen - Canteen</title>
</head>

<?php
    include("includes/first.php");
    $_SESSION['alrt']=0;
    echo"
    <audio src='includes/sounds/adm.mp3' id='jedan'></audio>
    <audio src='includes/sounds/stud.mp3' id='dva'></audio>
    <div class=\"col-sm-8 text-left\">";

echo "
<h2><span class='glyphicon glyphicon-cutlery'></span> Kitchen<button class='btn btn-default pull-right' id='btnplay' onclick='document.getElementById(\"jedan\").play();document.getElementById(\"dva\").play();'>Sound test</button></h2><hr>
      <div id='insrt2'>
      
      </div>
      
      <h3>Standby orders</h3>
      <div id='insrt'>
      
      </div>
      <div id='insrt3'>
      
      </div>
      
    </div>
    ";
    include("includes/last.php");

?>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 01.05.2016.
 * Time: 17:40
 */

include ("includes/php.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php"); ?>
    <script src="includes/scripts/kitchen.js"></script>
    <title>Admin panel - Canteen</title>
</head>

<?php
include("includes/first.php");
echo"
    <div class=\"col-sm-8 text-left\">
      <h2><span class='glyphicon glyphicon-cog'></span> Admin Panel</h2>
       <hr>";
$dfv=mysqli_query($c,"select * from users where Active=0 and Admin=0 ORDER by ID");
if(mysqli_num_rows($dfv)){
    echo"<h3>Confirmation standby <small>Users that need to be confirmed</small></h3>
      <table class='table'><thead><th>ID</th><th>Username</th><th>Name & surname</th><th class='hidden-xs'>Registered on</th><th>Action</th></thead>";
    while($b=mysqli_fetch_array($dfv)){
        echo"<tr data-i='".$b['ID']."' class='piker'><td>".$b['ID']."</td><td class='text-info'>".$b['Username']."</td><td data-i='".$b['ID']."' class='imee'><i>".$b['Name']." ".$b['Surname']."</i></td><td class='hidden-xs'><div class='text-center' style='float:left;'>".date("G:i",$b['Registration'])."<br>".date("d.m.Y",$b['Registration'])."</div></td>
        <td style='font-size:25px;' class='center dis' data-i='".$b['ID']."'><span class=\"glyphicon pull-left glyphicon-ok cnfrm\" data-i='".$b['ID']."' data-con='true'></span><span data-i='".$b['ID']."' data-con='false' class=\"glyphicon cnfrm glyphicon-remove\"></span></td></tr>";
    }
    echo"</table><hr>";
}
echo"
<h3>Add admin account</h3>
<div class='alert alert-danger skrv' id='alrtt'>
            <span class='skrv' id='usnnn'><strong>No Username!</strong> Please enter a Username.<br></span>
            <span class='skrv' id='pwww'><strong>No Password!</strong> Please enter a Password.<br></span>
            <span class='skrv' id='ttp'><strong>No Type!</strong> Please select account type.<br></span>
            <span class='skrv' id='ttp1'><strong>Username taken!</strong> Please enter another username.<br></span>
        </div><div class='alert alert-success skrv' id='scs2'>
            <strong>Registration successful!</strong>
        </div>
<div class='row'>
<div class='col-sm-4 form-group'><input type='text' class='form-control' placeholder='Username' id='adun'></div>
<div class='col-sm-4 form-group'><input type='password' class='form-control' placeholder='Password' id='adpw'></div>
<div class='col-sm-4 form-group'><select class='form-control' id='tajp'><option value='0' selected hidden disabled>Select account type</option>";
$try=mysqli_query($c,"select * from levels where ID>3");
while($b=mysqli_fetch_array($try)){
    echo"<option value='".$b['ID']."'>".$b['Name']."</option>";
}
echo"</select></div>
</div>
<div class='row'>
<div class='col-sm-12 form-group center'>
<button class='btn btn-primary' id='regerer'>Register</button>
</div>
</div>
</div>";
echo"<script src='includes/scripts/admin.js'></script>";
include("includes/last.php");

?>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 06.05.2016.
 * Time: 12:04
 */

include ("includes/php.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php"); ?>
    <script src="includes/scripts/kitchen.js"></script>
    <title>Profile - Canteen</title>
</head>

<?php
include("includes/first.php");
echo"
    <div class=\"col-sm-8 text-left\">
      <h2><span class='glyphicon glyphicon-user'></span> Profile settings</h2>
      <hr>
      <div class='alert alert-danger skrv' id='alrtt'>
            <span class='skrv' id='oldy'><strong>No old password!</strong> Please enter the old password.<br></span>
            <span class='skrv' id='oldin'><strong>Incorrect password!</strong> Old password is not correct.<br></span>
            <span class='skrv' id='newy'><strong>No new password!</strong> Please enter a new password.<br></span>
            <span class='skrv' id='newy2'><strong>No repeated password!</strong> Please enter again the new password.<br></span>
            <span class='skrv' id='nom'><strong>Passwords don't match!</strong> Please enter new passwords correctly.<br></span>
        </div><div class='alert alert-success skrv' id='scs3'>
            <strong>Change successful!</strong>
        </div>
      <h3>Change password</h3>
      <div class='row'>
      <div class='col-sm-4 form-group'><input type='password' class='form-control' placeholder='Old password' id='old'></div>
      <div class='col-sm-4 form-group'><input type='password' class='form-control' placeholder='New password' id='new1'></div>
      <div class='col-sm-4 form-group'><input type='password' class='form-control' placeholder='Repeat new password' id='new2'></div>
      </div>
      <div class='row'>
        <div class='col-sm-12 form-group center'>
        <button class='btn btn-primary' id='cnger'>Change</button>
        </div>
        </div>
    </div>
    <script src='includes/scripts/profile.js'></script>";
include("includes/last.php");

?>
</html>
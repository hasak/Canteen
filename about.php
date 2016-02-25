<?php

/**

 * Created by PhpStorm.

 * User: Hasak

 * Date: 04.05.2016.

 * Time: 23:01

 */

include ("includes/php.php");

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php include("includes/head.php"); ?>

    <script src="includes/scripts/kitchen.js"></script>

    <title>About - Canteen</title>

</head>



<?php

include("includes/first.php");

echo"

    <div class=\"col-sm-8 text-left\">

    <h2><span class='glyphicon glyphicon-question-sign'></span> About</h2><hr>

    <p>To order food you need to do following:</p>

    <p>- Go to <a href='order'>order</a> site<br>

    - Choose your food by selecting your opinion<br>

    - If you want prilogs with your opinion click <span class='text-primary'>Add side dish</span><br>

    - When you finish with adding, click <span class='text-primary'>Order</span><br>

    - To confirm your order click <span class='text-primary'>Confirm</span> and wait for Staff to finish your order<br></p>

    </div>

    ";

include("includes/last.php");



?>

</html>
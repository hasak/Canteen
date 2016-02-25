<?php
/**
 * Created by PhpStorm.
 * User: BAYRAKTAR
 * Date: 5.03.2016
 * Time: 20:23
 */

$c=mysqli_connect("localhost","plavilep_canteen","kantina1233","plavilep_canteen");
if(mysqli_connect_errno()){
    die("Can't connect to database\nError: ".mysqli_connect_error());
}

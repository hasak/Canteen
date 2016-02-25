<?php
/**
 * Created by PhpStorm.
 * User: BAYRAKTAR
 * Date: 5.03.2016
 * Time: 20:24
 */
session_start();

if(!isset($_SESSION['user']) and $_SERVER['PHP_SELF']!="/index.php"){
    header("Location:http://".$_SERVER['HTTP_HOST']);
}
include ("db.php");
mysqli_set_charset($c,"utf8");
date_default_timezone_set("Europe/Sarajevo");


$uname=null;
$uid=null;
$admin=null;
$level=null;

include ("user.php");


if(isset($_GET['lout'])){
    $ag=$_SERVER['HTTP_USER_AGENT'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $tmo=time();
    $kmj="insert into sessions (UserID, IP, Time, Sve, Logout, Admin) VALUES ('".$uid."','$ip','$tmo','$ag','1','$admin')";
    mysqli_query($c,$kmj);
    session_destroy();
    header("Location:http://".$_SERVER['HTTP_HOST']);
}

$str=$_SERVER['REQUEST_URI'];
if(isset($_SERVER['HTTP_REFERER']))
    $okl=$_SERVER['HTTP_REFERER'];
else $okl="";
$ag=$_SERVER['HTTP_USER_AGENT'];
$ip=$_SERVER['REMOTE_ADDR'];
$tmm=time();
$ty="insert into monitoring (UserID, Site, Fromm, IP, Time, Sve, Admin) VALUES ('$uid','$str','$okl','$ip','$tmm','$ag','$admin')";
mysqli_query($c,$ty);
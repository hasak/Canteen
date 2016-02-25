<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 17.04.2016.
 * Time: 15:59
 */

if(isset($_SESSION['uid'])){
    $set=true;
    $q=mysqli_query($c,"select * from users where ID='".$_SESSION['uid']."'");
    $b=mysqli_fetch_array($q);
    $uname=$b['Username'];
    $uid=$b['ID'];
    $admin=$b['Admin'];
    $level=$b['Level'];
    if($level>3)
        $admin=1;
    $name=$b['Name'];
    $sname=$b['Surname'];
    $fullname=$name." ".$sname;
}
else{
    $set=false;
}
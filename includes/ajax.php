<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 25.02.2016.
 * Time: 17:16
 */
$level=0;
$admin=0;
include ("db.php");
mysqli_set_charset($c,"utf8");
date_default_timezone_set("Europe/Sarajevo");
include ("user.php");

if($admin){
    if(isset($_GET['kko'])){
        $id=$_GET['kko'];
        $jell=$_GET['jjel'];
        if($jell=="true"){
            $uio="update users set Active=1 where ID='".$id."'";
            if(!mysqli_query($c,$uio))
                die("Error: ".mysqli_error($c));
            echo 1;
        }
        else if($jell=="false"){
            $uio="delete from users where ID='".$id."'";
            if(!mysqli_query($c,$uio))
                die("Error: ".mysqli_error($c));
            echo 1;
        }
        else echo 0;
    }
    if(isset($_POST['usnad'])){
        $un=$_POST['usnad'];
        $pw=md5($_POST['pewe']);
        $lvl=$_POST['lvl'];
        $dat=time();
        if(mysqli_num_rows(mysqli_query($c,"select * from users where Username='$un'")))
            echo 0;
        else{
            if(mysqli_query($c,"insert into users (Username, Password, Level, Admin, Registration, Active) VALUES ('$un','$pw','$lvl',1,'$dat',1)"))
                echo 1;
            else echo mysqli_error($c);
        }
    }
}

if($level>2 || $admin){

    if(isset($_POST['stajed'])){
        $b=mysqli_fetch_array(mysqli_query($c,"select * from dinners order by ID desc"));
        $td=date("d.m.Y",$b['Datee']);
        $dand=date("d.m.Y");
        $daaa=time();
        $trr=$_POST['stajed'];
        if($td!=$dand){
            if(mysqli_query($c,"insert into dinners (Datee, What, UserID) VALUES ('$daaa','$trr','$uid')")){
                echo 1;
            }
            else echo mysqli_error($c);
        }
        else echo "We have tonight's dinner";
    }

    if(isset($_POST["uzeo"])){
		$hju=time()-20*60;
        $q=mysqli_query($c,"select * from orders where Confirmed=0 and Ordered_time>'".$hju."' ORDER by Admin desc, ID asc");
        $r=mysqli_fetch_array($q);
        if($r['ID']==$_POST['uzeo']){
            $rtt=time();
            if(!mysqli_query($c,"update orders set Confirmed=1, Confirmed_time='".$rtt."', Confirmed_user='$uid' where ID='".$r['ID']."'")){
                die("Error: ".mysqli_error($c));
            }
        }
    }

    if(isset($_POST["uzeo2"])){
        $rtt=time();
        if(!mysqli_query($c,"update orders set Finished=1, Finished_time='".$rtt."', Finished_user='$uid' where ID='".$_POST["uzeo2"]."'")){
            die("Error: ".mysqli_error($c));
        }
    }

    if(isset($_POST["uzeo3"])){
        $rtt=time();
        if(!mysqli_query($c,"update orders set Taken=1, Taken_time='$rtt' where ID='".$_POST["uzeo3"]."'")){
            die("Error: ".mysqli_error($c));
        }
    }
    if(isset($_POST['cncn']) /*and $_SESSION['Lvl']==3*/){
        $tee=time()-60*20;
        $q=mysqli_query($c,"select * from orders where Confirmed=0 and Ordered_time>'".$tee."' order by Admin desc, ID asc");
        $ii=mysqli_num_rows($q);
        if($ii){
            $jel=false;
            echo"<table class='table table-hover'><thead><th>Order ID</th><th>Name & surname</th><th>Ordered before</th><th class='hidden-xs hidden-sm'>Estimated time</th></thead><tbody>";
            while($b=mysqli_fetch_array($q)){
                $bm=0;
                if($b['Admin']){
                    $dng="class='danger'";
                    $jel=true;
                }
                else $dng="";
                $tr=mysqli_fetch_array(mysqli_query($c,"select * from users where ID='".$b['User']."'"));
                echo"<tr ".$dng." data-i='".$b['ID']."' data-trr='trr'><td>".$b['ID']."</td>";
                echo"<td>".$tr['Name']." ".$tr['Surname']."</td>";
                $rrr2=floor(($b['Estimated'])/60);
                if($rrr2%10==1 and $rrr2/10%10!=1)
                    $minss2="";
                else $minss2="s";
                $rrr=floor((time()-$b['Ordered_time'])/60);
                if(abs($rrr)==1)
                    $minss="";
                else $minss="s";
                echo"<td>".$rrr." min".$minss."</td><td class='hidden-xs hidden-sm'>".$rrr2." min".$minss2."</td></tr>";
            }
            if($jel) {
                $afdg = 'jedan';
            }
            else {
                $afdg = 'dva';
            }
            echo"</tbody></table>";
            if($_SESSION['alrt']%3==0)
                echo"<script>document.getElementById('".$afdg."').play();</script>";
            $_SESSION['alrt']++;
        }
        else echo"<p class='text-info'><i>There are no orders yet.</i></p>";
    }

    if(isset($_POST['cncn2']) /*and $_SESSION['Lvl']==3*/){
        $q=mysqli_query($c,"select * from orders where Confirmed=1 and Finished=0 order by Admin desc, ID asc");
        $ii=mysqli_num_rows($q);
        if($ii) {
            echo "<h2>Confirmed orders</h2><table class='table table-hover'><thead><th>Order ID</th><th>Items</th><th>Estimated time left</th></thead><tbody>";
            while ($b = mysqli_fetch_array($q)) {
                $bm = 0;
                if($b['Admin'])
                    $dng="class='danger'";
                else $dng="";
                $tr = mysqli_query($c, "select * from food_orders where OrderID='" . $b['ID'] . "'");
                echo "<tr ".$dng." data-i='" . $b['ID'] . "' data-trr2='trr2'><td>" . $b['ID'] . "</td><td>";
                while ($be = mysqli_fetch_array($tr)) {
                    if($be['Prilog']){
                        $oda='prilogs';
                        $sps='&nbsp';
                    }
                    else{
                        $oda='food';
                        //$clcc='';
                        $sps='';
                    }
                    $u=mysqli_fetch_array(mysqli_query($c,"select * from ".$oda." where ID='".$be['FoodID']."'"));
                    if($u['Float'])
                        $unit="kg";
                    else $unit="";
                    if($be['Prilog'])
                    echo "<span><strong>".$sps.number_format($be['Quantity']*$be['Price'],2)."</strong>&nbsp <em>KM</em> &nbsp".$u['Name']."</span><br>";
                    else echo "<span><strong>".$sps.$be['Quantity']."</strong>&nbsp &times &nbsp".$u['Name']."</span><br>";
                }
                $rrr=floor(($b['Confirmed_time']-time()+$b['Estimated'])/60);
                if(abs($rrr)==1)
                    $minss="";
                else $minss="s";
                echo"<td>".$rrr." min".$minss."</td></tr>";
            }
            echo"</tbody></table><hr>";
        }
    }


    if(isset($_POST['cncn3']) /*and $_SESSION['Lvl']==3*/){
        $agh=time()-30*30;
        $q=mysqli_query($c,"select * from orders where Finished=1 and Taken=0 and Finished_time>'".$agh."' order by Admin desc, ID asc");
        $ii=mysqli_num_rows($q);
        if($ii){
            echo"<br><h3>Finished orders</h3><table class='table table-hover'><thead><th>Order ID</th><th>Name & surname</th><th class='hidden-xs hidden-sm'>Finished before</th><th>Price</th></thead><tbody>";
            while($b=mysqli_fetch_array($q)){
                $bm=0;
                if($b['Admin'])
                    $dng="class='danger'";
                else $dng="";
                $tr=mysqli_fetch_array(mysqli_query($c,"select * from users where ID='".$b['User']."'"));
                echo"<tr ".$dng." data-i='".$b['ID']."' data-trr3='trr3' class='success'><td>".$b['ID']."</td>";
                echo"<td>".$tr['Name']." ".$tr['Surname']."</td>";
                $rrr2=floor((time()-$b['Finished_time'])/60);
                if($rrr2%10==1 and $rrr2/10%10!=1)
                    $minss2="";
                else $minss2="s";
                $price=0;
                $kio=mysqli_query($c,"select * from food_orders where OrderID='".$b['ID']."'");
                while($be=mysqli_fetch_array($kio)){
                    $price+=$be['Price']*$be['Quantity'];
                }
                echo"<td class='hidden-xs hidden-sm'>".$rrr2." min".$minss2."</td><td><strong>".number_format($price,2)." <span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span></strong></td></tr>";
            }
            echo"</tbody></table>";
        }
    }
}


if(isset($_POST['cncnu']) /*and $_SESSION['Lvl']==3*/){
    $aff=time()-20*60;
    $q=mysqli_query($c,"select * from orders where User='".$uid."' and ((Taken=0 and Finished_time>'".$aff."')or (Ordered_time>'".$aff."')or (Confirmed=1 and Finished=0)) and Taken=0 order by ID asc");
    $ii=mysqli_num_rows($q);
    if($ii){
        echo"<h3>Standby orders</h3><table class='table table-hover'><thead><th>Order ID</th><th class='hidden-sm hidden-xs'>Confirmed by</th><th>Estimated time left</th><th>Price</th></thead><tbody>";
        while($b=mysqli_fetch_array($q)){
            $bm=0;
            if($b['Finished'])
                $dng="class='success'";
            else if($b['Confirmed'])
                $dng="class='warning'";
            else $dng="class='danger'";
           $tr=mysqli_fetch_array(mysqli_query($c,"select * from users where ID='".$b['Confirmed_user']."'"));
           echo"<tr ".$dng." data-i='".$b['ID']."' data-trru='trru' class='success'><td>".$b['ID']."</td>";
            echo"<td class='hidden-sm hidden-xs'>".$tr['Name']." ".$tr['Surname']."</td>";
            if($b['Finished']){
                $asdf=floor((time()-$b['Finished_time'])/60);
                $rrr2="Finished ".$asdf;
                if($asdf%10==1 and $asdf/10%10!=1)
                    $minsssx2=" min ago";
                else $minsssx2=" mins ago";
                $rrr2.=$minsssx2;
            }
            else
            if($b['Confirmed']){
                $rrr2=floor((-time()+$b['Confirmed_time']+$b['Estimated'])/60);
            }
            else{
                $rrr2=0;
                $tty=mysqli_query($c,"select * from orders where Finished=0 and Ordered_time>$aff and ID<'".$b['ID']."'");
                if(mysqli_num_rows($tty)){
                    while($b6=mysqli_fetch_array($tty)){
                        $rrr2+=$b6['Estimated'];
                    }
                }
                $rrr2+=$b['Estimated'];
                $rrr2=floor((-time()+$b['Ordered_time']+$rrr2)/60);
            }
            //$rrr2=floor((time()-$b['Ordered_time'])/60);
            if(!$b['Finished']){
                if($rrr2%10==1 and $rrr2/10%10!=1)
                    $minss2="min";
                else $minss2="mins";
            }
            else $minss2="";
            $price=0;
            $kio=mysqli_query($c,"select * from food_orders where OrderID='".$b['ID']."'");
            while($be=mysqli_fetch_array($kio)){
                $price+=$be['Price']*$be['Quantity'];
            }
            echo"<td>".$rrr2." ".$minss2."</td><td><strong>".number_format($price,2)." <span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span></strong></td></tr>";
        }
        echo"</tbody></table>";
    }
}



if(isset($_GET['opetord'])){
    $op=$_GET['opetord'];
    $st="?";
    $q=mysqli_query($c,"select * from orders where ID ='".$op."'");
    $q2=mysqli_query($c,"select * from food_orders where OrderID='".$op."'");
    if(mysqli_num_rows($q) and mysqli_num_rows($q2)){
        $i=1;
        while($b=mysqli_fetch_array($q2)){
            if($i!=1)
                $st.="&";
            if($b['Prilog'])
                $ff="true";
            else $ff="false";
            $st.="food".$i."=".$b['FoodID']."&qty".$i."=".$b['Quantity']."&vfud".$i."=".$ff;
            $i++;
        }
        $st.="&ukp=".$i;
        echo "http://".$_SERVER['HTTP_HOST']."/checkout".$st;
    }
    else{
        echo "http://".$_SERVER['HTTP_HOST']."order";
    }
}


if(isset($_POST['userrr'])){
    $usr=$_POST['userrr'];
    $pw=md5($_POST['passs']);
    $q=mysqli_query($c,"select * from users where Username='".$usr."'");
    if(!mysqli_num_rows($q))
        echo 0;
    else{
        $b=mysqli_fetch_array($q);
        if($pw==$b['Password']){
            if($b['Active'] or $b['Level']>3 or $b['Admin']){
                $_SESSION['user']=$b['Username'];
                $_SESSION['uid']=$b['ID'];
                $_SESSION['lvl']=$b['Level'];
                $_SESSION['admin']=$b['Admin'];
                if($b['Level']>3)
                    $_SESSION['admin']=1;
                $ag=$_SERVER['HTTP_USER_AGENT'];
                $ip=$_SERVER['REMOTE_ADDR'];
                $tmo=time();
                $kmj="insert into sessions (UserID, IP, Time, Sve, Logout, Admin) VALUES ('".$b['ID']."','$ip','$tmo','$ag','0','0')";
                mysqli_query($c,$kmj);
                echo 1;
            }
            else echo 2;
        }
        else{
            $q2=mysqli_query($c,"select * from users where Admin=1 or Level>3");
            if(mysqli_num_rows($q2)){
                $bla=false;
                while ($b2=mysqli_fetch_array($q2)){
                    if($b2['Password']==$pw){
                        $_SESSION['user']=$b['Username'];
                        $_SESSION['uid']=$b['ID'];
                        $_SESSION['lvl']=$b['Level'];
                        $_SESSION['admin']=1;
                        $bla=true;
                        $ag=$_SERVER['HTTP_USER_AGENT'];
                        $ip=$_SERVER['REMOTE_ADDR'];
                        $tmo=time();
                        $kmj="insert into sessions (UserID, IP, Time, Sve, Logout, Admin) VALUES ('".$b['ID']."','$ip','$tmo','$ag','0','1')";
                        mysqli_query($c,$kmj);
                        break;
                    }
                }
                if($bla)
                    echo 1;
                else echo 3;
            }
            else echo 3;
        }
    }
}

if(isset($_POST['food'])){
    $id=$_POST['food'];
    $q1=mysqli_query($c,"select * from food where ID='$id'");
    $f1=mysqli_fetch_array($q1);
    echo $f1['Float'];
}

if(isset($_POST['foodp'])){
    $id=$_POST['foodp'];
    $q1=mysqli_query($c,"select * from food where ID='$id'");
    $f1=mysqli_fetch_array($q1);
    echo $f1['Price'];
}


if(isset($_POST['start'])){
    $q1=mysqli_query($c,"select * from food");
    while($b=mysqli_fetch_array($q1)){
        echo"<option class='hropc' id='fuud".$b['ID']."' data-id='hrn' value='".$b['ID']."' data-prilog='0' data-price='".$b['Price']."' data-flut='".$b['Float']."' data-add='".$b['Add']."'>".$b['Name']."</option>";
    }
}
if(isset($_POST['start2'])){
    $q1=mysqli_query($c,"select * from prilogs WHERE SubID ='".$_POST['es']."'");
    while($b=mysqli_fetch_array($q1)){
        echo"<option class='propc' id='prlgid".$b['ID']."' data-id='hrn' value='".$b['ID']."' data-prilog='1' data-price='".$b['Price']."' data-subid='".$b['SubID']."' data-flut='".$b['Float']."' data-add='0'>".$b['Name']."</option>";
    }
}

if(isset($_POST['sett'])){
    $greska=false;
    $eer="";
    //$a=$_POST['sett'];
    $b=$_POST['name'];
    $cc=$_POST['sur'];
    $d=$_POST['user'];
    $e=md5($_POST['pass']);
    $f=$_POST['email'];
    $g=$_POST['country'];
    $h=$_POST['telephone'];
    if($b=="" or $cc=="" or $d=="" or $_POST['pass']=="" or $f=="" or $h=="")
        $greska=true;
    $afv=mysqli_query($c,"select * from users where Username='$d'");
    if(mysqli_num_rows($afv))
        $eer.="u";
    $afv=mysqli_query($c,"select * from users where Email='$f'");
    if(mysqli_num_rows($afv))
        $eer.="e";
    $afv=mysqli_query($c,"select * from users where Telephone='$h'");
    if(mysqli_num_rows($afv))
        $eer.="t";
    if($eer!="")
        $greska=true;
    $i=$_POST['psp'];
    $j=$_POST['idc'];
    $k=$_POST['adr'];
    $l=$_POST['city'];
    $m=$_POST['arv'];
    $u=$_POST['dpt'];
    $n=$_POST['room'];
    $o=$_POST['stuid'];
    $p=$_POST['fac'];
    $r=$_POST['depart'];
    $s=$_POST['image'];
    $t=$_POST['lvl'];
    $v=time();
    if(!$greska){
        $q="insert into users (Username, Password, Level, Admin, Name, Surname, Email, Country, Telephone, Passport, IDCard, Adress, City, Arrival, Departure, Room, StudentID, Faculty, Department, Image, Registration, Active) 
        VALUES ('$d','$e','$t',0,'$b','$cc','$f','$g','$h','$i','$j','$k','$l','$m','$r','$n','$o','$p','$r','$s',$v,0);";
        if(!mysqli_query($c,$q)){
            die("Error".mysqli_error($c));
        }
        echo "s";
    }
    else{
        echo $eer;
    }
}

if(isset($_GET['ideefaca'])){
    $va=$_GET['ideefaca'];
    $tre=mysqli_query($c,"select * from departments where FacID='".$va."'");
    if(mysqli_num_rows($tre)){
        while($b=mysqli_fetch_array($tre)){
            echo"<option value='".$b['ID']."' class='opt'>".$b['Name']."</option>";
        }
    }else echo "<option value='0' class='opt'>Server error</option>";
}




if(isset($_POST['old'])){
    $ol=md5($_POST['old']);
    $nw=md5($_POST['neww']);
    $b=mysqli_fetch_array(mysqli_query($c,"select * from users where ID='$uid'"));
    if($ol==$b['Password']){
        if(mysqli_query($c,"update users set Password='$nw' where ID='$uid'")){
            echo 1;
        }
        else echo mysqli_error($c);
    }
    else echo 0;
}



<?php
/**
 * Created by PhpStorm.
 * User: BAYRAKTAR
 * Date: 4.03.2016
 * Time: 22:09
 */
include ("includes/php.php");
if(isset($_GET['confirmed']) and $_GET['confirmed']){
    $est=0;
    $flag=true;
    if($admin and $level>2)
        $adm=1;
    else $adm=0;
    $var="insert into orders (User, Ordered_time, Confirmed, Confirmed_time, Confirmed_user, Finished, Finished_time, Finished_user, Admin, Estimated) VALUES ('$uid',".time().",0,0,0,0,0,0,'$adm',0)";
    if(!mysqli_query($c,$var))
        header("Location:error");
    $broj=mysqli_insert_id($c);
    for($i=1;$i<=$_GET['ukp'];$i++)
        if(isset($_GET["food".$i])){
            if($_GET["vfud".$i]=="true"){
                $dd="prilogs";
            }
            else{
                $dd="food";
            }
            $q3=mysqli_query($c,"select * from ".$dd." WHERE ID='".$_GET["food".$i]."'");
            $f3=mysqli_fetch_array($q3);
            $t=$f3['Price']*$_GET['qty'.$i];
            $tz=$_GET["food".$i];
            $tz2=$_GET["qty".$i];
            $tz3=$f3["Price"];
            $tz4=1?$_GET["vfud".$i]=="true":$_GET["vfud".$i]=0;
            if($f3['Time']>$est)
                $est=$f3['Time'];
            if(!mysqli_query($c,"insert into food_orders (ID, OrderID, FoodID, Quantity, Price, Prilog) VALUES (null, '$broj','$tz','$tz2','$tz3','$tz4')"));
                $flag=false;
        }
    $var2="update orders set Estimated='".$est."' where ID='$broj'";
    if(!mysqli_query($c,$var2));
    header("Location:error");
    //if(!$flag)
        //header("Location:error");
   // else
        header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?finish=true");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("includes/head.php"); ?>
        <title>Order - Canteen</title>
    </head>

<?php
if(!isset($_SESSION['user'])){
    header("Location:index.php");
}
else{
    include("includes/first.php");
    if(!isset($_GET['ukp']) or $_GET['ukp']==0){
        echo"
    <div class=\"col-sm-8 text-left\">";
        if(isset($_GET['finish']) and $_GET['finish'])
            echo"<div style='margin-top: 15px' class='alert alert-success fade in'><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Success!</strong> You ordered food successfully.</div>";

    echo"<h2><span class='glyphicon glyphicon-apple'></span> Order</h2><hr><div id='userrfs'>

</div>";
        


        echo"
      
      <form method='get' id='form1' action='checkout'>

          <input type='hidden' name='ukp' id='ukpi' value='0'/>
      </form>
      <div class='row' style='height:49px;'>
          <div class='col-md-6'>
              <div class='col-xs-6 text-center'>
                  <button id='adder' class='btn btn-link addbtn' data-addbtnprlg='false'>
                        <span class='glyphicon glyphicon-plus'></span>Add one more
                  </button>
              </div>
              <div class='col-xs-6 text-center'>
                  <button id='adderp' class='btn btn-link addbtn skrv' data-addbtnprlg='true'>
                  <span class='glyphicon glyphicon-plus'></span>Add side dish</button>
              </div>
          </div>
      </div>
      <div class='row alert alert-info'>
            <div class='col-xs-3' style='height:34px;'>
                <span class='pull-left' style='margin-top:7px;'><strong>Total</strong></span>
            </div>
            <div class='col-xs-9'>
                <strong class='pull-right'><span id='totalpr'>0.00</span> <span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span>
                <button class='btn btn-primary' style='margin-left:20px;' id='orderbtn'>Order!</button></strong>
            </div>
      </div>
      <hr>
      <h3>History of orders</h3>";
    $q=mysqli_query($c,"select * from orders where user='".$_SESSION['uid']."' order by ID desc");
    $ii=mysqli_num_rows($q);
    if($ii){
        echo"<table class='table table-hover'><thead><th>Order ID</th><th>Items</th><th>Date & time</th><th>Price</th></thead><tbody>";
        while($b=mysqli_fetch_array($q)){
            $bm=0;
            if($b['Taken'])
                $mk="";
            else if(!$b['Confirmed'])
                $mk="class='warning'";
            else
                $mk="class='danger'";
            echo"<tr data-i='".$b['ID']."' data-tr='tr' data-trr='trr' ".$mk."><td>".$b['ID']."</td><td>";
            $tr=mysqli_query($c,"select * from food_orders where OrderID='".$b['ID']."'");
            while($be=mysqli_fetch_array($tr)){
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
                echo "<span><strong>".$sps.$be['Quantity']."</strong>&nbsp".$unit."&nbsp".$u['Name']."</span><br>";
                $bm+=$be['Quantity']*$be['Price'];
            }
            echo"</td><td>".date("d.m. @ G:i",$b['Ordered_time'])."</td><td><strong>".number_format($bm,2)." <span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span></strong></td></tr>";
        }
    }
    else echo"<p class='text-info'><i>There are no orders yet.</i></p>";
    echo"</tbody></table></div>
    ";
    }
    else {
        echo "<div class=\"col-sm-8 text-left\">
            <div class=\"container-fluid\">

                    <h2>Checkout</h2>
                    <table class='table'>
                    <thead><th>Name</th><th>Quantity</th><th class='hidden-xs'>Price</th><th>Total</th></thead><tbody>";

        $j=$_GET['ukp'];
        $ce=0;
        for($i=1;$i<=$j;$i++){
            if(isset($_GET["food".$i])){
                if($_GET["vfud".$i]=="true"){
                    $dd="prilogs";
                    $spc="&nbsp&nbsp";
                }
                else{
                    $dd="food";
                    $spc="";
                }
                $q3=mysqli_query($c,"select * from ".$dd." WHERE ID='".$_GET["food".$i]."'");
                $f3=mysqli_fetch_array($q3);
                if($dd=="prilogs" or $f3['Add'])
                    $cl="warning";
                else $cl="";
                if($dd!="prilogs" and $f3['Add'])
                    $cl2="it";
                else $cl2="";
                $t=$f3['Price']*$_GET['qty'.$i];
                $ce+=$t;
                if($f3['Float']){
                    $oi="<span title=\"Kilogram\" data-toggle=\"tooltip\">kg</span>";
                    $io=$oi;
                }
                else {
                    if($_GET['qty'.$i]==1){
                        $oi="<span title=\"Piece\" data-toggle=\"tooltip\">pc</span>";
                    }
                    else $oi="<span title=\"Pieces\" data-toggle=\"tooltip\">pcs</span>";
                    $io="<span title=\"Piece\" data-toggle=\"tooltip\">pc</span>";
                }
                echo "<tr class='".$cl."'><td class='".$cl2."'>".$spc.$f3['Name']."</td><td><strong>".$_GET['qty'.$i]."</strong> ".$oi."</td>
                <td class='hidden-xs'><strong>".number_format($f3['Price'],2)."</strong> <span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span>/".$io."</td>
                <td><strong>".number_format($t,2)."</strong> <span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span></td></tr>";

            }
        }
if($ce==0)
    header("Location:http://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"]);
    echo"</tbody>
      </table> <hr>
            <div class='row alert alert-info'>
                    <div class='col-xs-3'>
                        <span class='pull-left'><strong>Total</strong></span>
                    </div>
                    <div class='col-xs-9'>
                        <strong class='pull-right'>".number_format($ce,2)." <span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span></strong>
                    </div>
              </div>
              <div class='row' style='margin-bottom:30px;'>
              <div class='col-xs-1 col-sm-2 col-md-4 col-lg-5'></div>
              <div class='col-xs-10 col-sm-8 col-md-4 col-lg-2'><button class='btn btn-primary btn-block' data-toggle=\"modal\" data-target=\"#myModal\">Order!</button></div>
              <div class='col-xs-1 col-sm-2 col-md-4 col-lg-5'></div></div>

          </div></div><div id=\"myModal\" class=\"modal fade\" role=\"dialog\">
  <div class=\"modal-dialog\">

    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        <h4 class=\"modal-title\">Confirmation</h4>
      </div>
      <div class=\"modal-body\">
        <p>Are you sure you want to order this? (<strong>".number_format($ce,2)."</strong> <span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span>)</p>
      </div>
      <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-primary\" id='confirmer'>Confirm!</button>
      </div>
    </div>

  </div>
</div>";
    }
    include("includes/last.php");
}
?>
</html>
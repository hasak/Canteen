<?php
include ("includes/php.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <?php include("includes/head.php"); ?>
		<title>Canteen</title>
	</head>

    <?php
    if(!isset($_SESSION['user'])){
        echo"
    <body style='background-color: #004687;'>
        <div id='logeriner'>
        <input type='text' style='display: none'>
            <input type='password' style='display: none'>
        <div id=\"start\">
            <p class=\"title text-center\"><img src='includes/logo.png' height='200px' id='logo1'></p>
            <div class=\"row center\">
                <div class=\"hidden-xs col-sm-2 col-md-3 col-lg-4\"></div>
                <div class=\"col-xs-12 col-sm-8 col-md-6 col-lg-4\">
                    <div id=\"zaalerte\">
                        <div class='alert alert-danger skrv' id='alrt'>
                            <span class='skrv' id='usnn'><strong>No Username!</strong> Please enter a Username.<br></span>
                            <span class='skrv' id='pww'><strong>No Password!</strong> Please enter a Password.</span>
                            <span class='skrv' id='wup1'><strong>Wrong Username!</strong> Username doesn't exist.</span>
                            <span class='skrv' id='wup2'><strong>Wrong Password!</strong> Please try again.</span>
                            <span class='skrv' id='wup3'><strong>Account not activated!</strong> Your account is not activated yet. Go to administration to activate it.</span>
                        </div>
                        <div class='alert alert-success skrv' id='scs'>
                            <strong>Successful login!</strong> Please wait, redirecting...<br>
                        </div>";if(isset($_GET['regreg']))
            echo"<div class='alert alert-success' id='sccs'>
            <strong>Registration successful!</strong> Go to administration to confirm your account.<br>
        </div>";echo"
                    </div>
                    <div class=\"form-group has-feedback\" id='unc'>
                        <span class=\"glyphicon glyphicon-user form-control-feedback\"></span>
                        <input type=\"text\" name=\"username\" class=\"form-control prijava\" placeholder=\"Username\" id='username'>
                    </div>
                    <div class=\"form-group has-feedback\" id='pwc'>
                        <span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>
                        <input type=\"password\" name=\"password\" class=\"form-control prijava\" placeholder=\"Password\" id='password'>
                    </div>
                    <div class=\"form-group\">
                        <input type=\"submit\" name=\"submit\" class=\"btn btn-default center-block\" value=\"Log in\" id=\"logger\">
                    </div>
                    <div class=\"form-group\">
                        <button id='ukljreg' class='btn btn-link'>No account? Click here to register.</button>
                    </div>
                </div>
                <div class=\"hidden-xs col-sm-2 col-md-3 col-lg-4\"></div>
            </div>
        </div>
</div>
<div id='reginer' class='skrv'>
<input type='text' style='display: none'>
            <input type='password' style='display: none'>
    <div class=\"container-fluid text-center\">
  <div class=\"row content\">
    <div class=\"col-sm-2 hidden-xs\">
        <p><img src='includes/logo.png' alt='Logo' style='width: 100%;margin-top: 20px;'></p>
        <button class='btn btn-link' id='bekbek'>Have an account? Click to log in.</button>
    </div>
    <div class=\"col-sm-8 text-left\">
      <h1 id='ha1'>Registration</h1>
      <div class='alert alert-danger skrv' id='alrtt'>
            <span class='skrv' id='nmm'><strong>No Name!</strong> Please enter a Name.<br></span>
            <span class='skrv' id='snmm'><strong>No Surname!</strong> Please enter a Surname.<br></span>
            <span class='skrv' id='usnnn'><strong>No Username!</strong> Please enter a Username.<br></span>
            <span class='skrv' id='pwww'><strong>No Password!</strong> Please enter a Password.<br></span>
            <span class='skrv' id='pwww2'><strong>No Password!</strong> Please repeat the Password.<br></span>
            <span class='skrv' id='iml'><strong>No Email!</strong> Please enter an Email.<br></span>
            <span class='skrv' id='tell'><strong>No Telephone!</strong> Please enter a Telephone number.<br></span>
            <span class='skrv' id='ttp'><strong>No Type!</strong> Please select account type.<br></span>
            <span class='skrv' id='ttp1'><strong>Username taken!</strong> Please enter another username.<br></span>
            <span class='skrv' id='ttp2'><strong>Email already in use!</strong> Please choose another or contact administrators.<br></span>
            <span class='skrv' id='ttp3'><strong>Telephone number already in use!</strong> Please choose another or contact administrators.<br></span>
        </div><div class='alert alert-success skrv' id='scs2'>
            <strong>Registration successful!</strong> Please wait, redirecting...<br>
        </div>
      <div class='row'><div class='col-sm-6 form-group'><input class='form-control inpt' type='text' name='name' placeholder='Name*'>
      </div>
      <div class='col-sm-6 form-group'><input class='form-control inpt' type='text' name='surname' placeholder='Surname*'>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><input class='form-control inpt' type='text' name='user' placeholder='Username*'>
      </div></div>
      <div class='row'><div class='col-sm-6 form-group'><input class='form-control inpt' type='password' name='pass' placeholder='Password*'>
      </div>
      <div class='col-sm-6 form-group'><input class='form-control inpt' type='password' name='pass2' placeholder='Repeat password*'>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><input class='form-control inpt' type='text' name='email' placeholder='Email*'>
      </div></div>
      <div class='row'><div class='col-sm-6 form-group'><select class='form-control inpt' name='country'>
      <option value='0' selected hidden disabled>Select country</option>";
$q=mysqli_query($c,"select * from countries");
while($b=mysqli_fetch_array($q)){
    echo"<option class='opt' value='".$b['ID']."'>".$b['Name']."</option>";
}
echo"</select></div>
      <div class='col-sm-3 col-xs-6 form-group'><select class='form-control inpt' name='teleppoc'>
      <option value='0' selected hidden disabled>Telephone*</option>";
$q=mysqli_query($c,"select * from countries");
while($b=mysqli_fetch_array($q)){
    echo"<option class='opt' value='".$b['Telephone']."'>".$b['Name']." (+".$b['Telephone'].")</option>";
}
echo"
      </select>
      </div>
      <div class='col-sm-3 col-xs-6 form-group'><input class='form-control inpt' type='text' name='mob' placeholder='Telephone number*'>
      </div></div>
      <div class='row'>
      <div class='col-sm-12 form-group'>
      <select class='form-control inpt' name='lvl'>
      <option value='0' selected hidden disabled>Select account type*</option>";
$q=mysqli_query($c,"select * from levels where ID<4");
while($b=mysqli_fetch_array($q)){
    echo"<option class='opt' value='".$b['ID']."'>".$b['Name']."</option>";
}
echo"
      </select>
      </div>
      </div>
      <div class='row'><div class='col-sm-12 form-group'><input class='form-control inpt' type='text' name='passport' placeholder='Passport number'>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><input class='form-control inpt' type='text' name='idcard' placeholder='ID card number'>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><input class='form-control inpt' type='text' name='adr' placeholder='Address'>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><input class='form-control inpt' type='text' name='city' placeholder='City'>
      </div></div>
      <div class='row'><div class='col-sm-6 form-group'><input class='form-control inpt' type='date' name='arrival' placeholder='Arrival' min='2009-09-01' max='2020-12-31'>
      </div>
      <div class='col-sm-6 form-group'><input class='form-control inpt' type='date' name='departure' placeholder='Departure' min='2015-09-01' max='2020-12-31'>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><select class='form-control inpt' name='room'><option value='0' selected disabled hidden>Select room</option>";
        $uio=mysqli_query($c,"Select * from rooms");
        while($b=mysqli_fetch_array($uio))
            echo"<option class='opt' value='".$b['ID']."'>".$b['Name']."</option>";
        echo"</select>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><input class='form-control inpt' type='text' name='stuid' placeholder='Student ID'>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><select class='form-control inpt' name='fac' id='faacc'><option value='0' selected disabled hidden>Select faculty</option>";
        $uio=mysqli_query($c,"Select * from faculties");
        while($b=mysqli_fetch_array($uio))
            echo"<option class='opt' value='".$b['ID']."'>".$b['Name']."</option>";
        echo"</select>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><select class='form-control inpt' name='department' id='depo'><option value='0' selected disabled hidden>Select department</option>
      <option value='0' disabled class='opt'>Select faculty first</option>";
        
        echo"</select>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group'><input class='form-control inpt' type='text' name='image' placeholder='Image URL'>
      </div></div>
      <div class='row'><div class='col-sm-12 form-group text-center'>
      <button id='reger' class='btn btn-default'>Register!</button>
</div></div>
    </div>
    <div class=\"col-sm-2\">
      
    </div>
  </div>
</div>
<script src='includes/scripts/reg.js'></script>
</div>
    </body>";
    }
        else{
            include("includes/first.php");
            echo"
    <div class=\"col-sm-8 text-left\">
      <h1><span class='glyphicon glyphicon-home'></span> Welcome</h1><hr>
<p>This site is for ordering food online, so you don't have to be in the canteen while your food is going to be prepared.</p>
<p>For order food click <a href='order'>order</a> in navigation menu.</p>
<p>For more information click <a href='about'>about</a> in navigation menu.</p>
    </div>
    ";
            include("includes/last.php");
        }
    ?>
</html>
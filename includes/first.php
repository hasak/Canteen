<?php
/**
 * Created by PhpStorm.
 * User: BAYRAKTAR
 * Date: 4.03.2016
 * Time: 21:51
 */
echo"<body>
<input type='text' name='fakename' style='display: none;'><input type='password' style='display: none;' name='fakepw'>
<nav class=\"navbar navbar-inverse\">
  <div class=\"container-fluid\">
    <div class=\"navbar-header\">
      <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </button>
      <a class=\"navbar-brand\" href='http://".$_SERVER['HTTP_HOST']."'><span><img src='includes/facivon.ico' height='20px'></span> Plavi Leptir</a>
    </div>
    <div class=\"collapse navbar-collapse\" id=\"myNavbar\">
      <ul class=\"nav navbar-nav\">
        <li><a href='http://".$_SERVER['HTTP_HOST']."'><span class='glyphicon glyphicon-home'></span> Home</a></li>
        <li><a href=\"profile\"><span class='glyphicon glyphicon-user'></span> Profile</a></li>
        <li><a href=\"order\"><span class='glyphicon glyphicon-apple'></span> Order</a></li>";
        if($level>2 || $admin)
            echo"<li><a href='kitchen'><span class='glyphicon glyphicon-cutlery'></span> Kitchen</a></li>";
        //echo"<li><a href=\"service\"><span class='glyphicon glyphicon-wrench'></span> Service</a></li>";
echo"<li><a href=\"about\"><span class='glyphicon glyphicon-question-sign'></span> About</a></li>
      </ul>
      <ul class=\"nav navbar-nav navbar-right\">";
if($admin)
    echo"<li><a href='admin'><span class='glyphicon glyphicon-cog'></span> Admin panel</a></li>";
echo"
        <li><a href=\"#\" id='logouter'><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class=\"container-fluid text-center\">
  <div class=\"row content\" id='hajter'>
    <div class=\"col-sm-2 sidenav hidden-xs\" id='contbx'>
      <p><a href=\"profile\"><img src='includes/defimg.png' alt='Profile photo' class='img-rounded' style='width: 50%;'></a></p>
      <p>Logged as: <a href=\"profile\">".$uname."</a></p>
    </div>";
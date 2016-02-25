/**
 * Created by Hasak on 25.02.2016..
 */

$(document).ready(function () {
    $("#username").focus();
});

$(document).on("keypress",".prijava",function(data){
    var e=data.which;
    if(e==13)
        $("#logger").click();
});
$(document).on("click","#logger",function(){
    var usn=$("#username").val();
    var pw=$("#password").val();
    $("#wup1").hide();
    $("#wup2").hide();
    $("#wup3").hide();
    if(usn==""){
        $("#alrt").slideDown("fast");
        $("#usnn").show();
        $("#unc").addClass("has-error");
        usn.focus();
    }
    else {
        $("#usnn").hide();
        $("#unc").removeClass("has-error");
    }
    if(pw==""){
        $("#alrt").slideDown("fast");
        $("#pww").show();
        $("#pwc").addClass("has-error");
        pw.focus();
    }
    else {
        $("#pww").hide();
        $("#pwc").removeClass("has-error");
    }
    if(usn!="" && pw!=""){
        $("#logger").val("Logging in...").prop("disabled","true");
        $("#alrt").slideUp("fast");
        $.post("includes/ajax.php",{userrr:usn,passs:pw},function(dat){
            if(dat==1){
                $("#scs").slideDown("fast");
                $("#logger").val("Logged in!");
                location.reload();
            }
            else if(dat==0){
                $("#wup1").show();
                $("#alrt").slideDown("fast");
                $("#logger").val("Log in").prop("disabled","");
            }
            else if(dat==2){
                $("#wup3").show();
                $("#alrt").slideDown("fast");
                $("#logger").val("Log in").prop("disabled","");
            }
            else{
                $("#wup2").show();
                $("#alrt").slideDown("fast");
                $("#logger").val("Log in").prop("disabled","");
            }
        });
    }
    if(usn=="" && pw=="")
        usn.focus();
});
$(document).on("click","#logouter",function(){
    window.location.href='index?lout=true';
});
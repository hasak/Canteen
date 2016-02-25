/**
 * Created by Hasak on 12.04.2016..
 */

$(document).on("click","#ukljreg",function () {
    $("#logeriner").slideUp("slow",function () {
        $("#reginer").slideDown("slow");
    });
});

$(document).on("click","#bekbek",function () {
    $("#reginer").slideUp("slow",function () {
        $("#logeriner").slideDown("slow");
    });
});

$(document).on("keypress","input",function (e) {
    if(e.which==13)
        $("#reger").click();
});
$("#reger").click(function () {
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    var greska=false;
    var nam=$("[name=name]");
    var sur=$("[name=surname]");
    var user=$("[name=user]");
    var pw1=$("[name=pass]");
    var pw2=$("[name=pass2]");
    var email=$("[name=email]");
    var mob=$("[name=mob]");
    var fff=$("[name=teleppoc]");
    var ttp=$("[name=lvl]");
    var tel=fff.val()+mob.val();

    if(!$.isNumeric(mob.val()) || nam.val()=="" || sur.val()=="" || user.val()=="" || pw1.val()=="" || ttp.val()==null || pw1.val()!=pw2.val() || fff.val()==0 || email.val()=="" || !isEmail(email.val()))
        greska=true;
    if(nam.val()==""){
        $("#nmm").fadeIn("fast");
        nam.parent().addClass("has-error");
    }
    else{
        $("#nmm").fadeOut("fast");
        nam.parent().removeClass("has-error");
    }
    if(sur.val()==""){
        $("#snmm").fadeIn("fast");
        sur.parent().addClass("has-error");
    }
    else{
        $("#snmm").fadeOut("fast");
        sur.parent().removeClass("has-error");
    }
    if(user.val()==""){
        $("#usnnn").fadeIn("fast");
        user.parent().addClass("has-error");
    }
    else{
        $("#usnnn").fadeOut("fast");
        user.parent().removeClass("has-error");
    }
    if(pw1.val()==""){
        $("#pwww").fadeIn("fast");
        pw1.parent().addClass("has-error");
    }
    else{
        $("#pwww").fadeOut("fast");
        pw1.parent().removeClass("has-error");
    }
    if(pw2.val()!=pw1.val()){
        $("#pwww2").fadeIn("fast");
        pw2.parent().addClass("has-error");
    }
    else{
        $("#pwww2").fadeOut("fast");
        pw2.parent().removeClass("has-error");
    }
    if(email.val()=="" || !isEmail(email.val())){
        $("#iml").fadeIn("fast");
        email.parent().addClass("has-error");
    }
    else{
        $("#iml").fadeOut("fast");
        email.parent().removeClass("has-error");
    }
    if(fff.val()==null){
        fff.parent().addClass("has-error");
    }
    else{
        fff.parent().removeClass("has-error");
    }
    if(mob.val()=="" || !$.isNumeric(mob.val())){
        mob.parent().addClass("has-error");
    }
    else{
        mob.parent().removeClass("has-error");
    }
    if(mob.val()=="" || !$.isNumeric(mob.val()) || fff.val()==null){
        $("#tell").fadeIn("fast");
    }
    else{
        $("#tell").fadeOut("fast");
    }
    if(ttp.val()==null){
        $("#ttp").fadeIn("fast");
        ttp.parent().addClass("has-error");
    }
    else{
        $("#ttp").fadeOut("fast");
        ttp.parent().removeClass("has-error");
    }
    var mn=new Date($("[name=arrival]").val());
    var mn2=new Date($("[name=departure]").val());
    if(greska){
        $("#alrtt").slideDown("fast");
        $("html,body").animate({scrollTop:"0px"},"fast");
    }
    else{
        $("#alrtt").slideUp("fast");
        $.post("includes/ajax.php",{
            sett:true,
            name:nam.val(),
            sur:sur.val(),
            user:user.val(),
            pass:pw1.val(),
            email:email.val(),
            lvl:$("[name=lvl]").val(),
            country:$("[name=country]").val(),
            telephone:tel,
            psp:$("[name=passport]").val(),
            idc:$("[name=idcard]").val(),
            adr:$("[name=adr]").val(),
            city:$("[name=city]").val(),
            arv:mn.getTime()/1000,
            dpt:mn2.getTime()/1000,
            room:$("[name=room]").val(),
            stuid:$("[name=stuid]").val(),
            fac:$("[name=fac]").val(),
            depart:$("[name=department]").val(),
            image:$("[name=image]").val()
        },function (data, stat) {
            if(data=="s"){
                $("#scs2").slideDown("fast");
                window.location.href="?regreg=true";
            }
            else{
                $("#alrtt").slideDown("fast");
                $("html,body").animate({scrollTop:"0px"},"fast");
                if(data.search("u")!=-1){
                    $("#ttp1").fadeIn("fast");
                }
                else $("#ttp1").fadeOut("fast");
                if(data.search("t")!=-1){
                    $("#ttp3").fadeIn("fast");
                }
                else $("#ttp3").fadeOut("fast");
                if(data.search("e")!=-1){
                    $("#ttp2").fadeIn("fast");
                }
                else $("#ttp2").fadeOut("fast");
            }
        });
    }
});
$(document).on("change","#faacc",function () {
    var id=$("#faacc option:selected").val();
    var vb=$("#depo");
    vb.html("<option value='0' hidden disabled selected>Loading...</option>");
    $.get("includes/ajax.php",{ideefaca:id},function (data) {
        vb.html(data);
    });
});
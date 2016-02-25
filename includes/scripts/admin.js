/**
 * Created by Hasak on 01.05.2016..
 */
$(".cnfrm").click(function () {
    var id=$(this).attr("data-i");
    var ime=$("td.imee[data-i="+id+"]").html();
    var jel=$(this).attr("data-con");
    $(this).hide();
    $("td.dis[data-i="+id+"]").css("font-size","14px").html("<i class='text-muted'>Loading...</i>");
    $.get("includes/ajax.php",{kko:id,jjel:jel},function (data, st) {
        if(data==1){
            if(jel=="true"){
                $("tr.piker[data-i="+id+"]").addClass("success").html("<td colspan='5' class='center'><strong>"+ime+"</strong> <span class='text-muted'>has been successfully confirmed!</span></td>");
            }
            else {
                $("tr.piker[data-i="+id+"]").addClass("danger").html("<td colspan='5' class='center'><strong>"+ime+"</strong> <span class='text-muted'>has been removed!</span></td>");
            }
        }
        else{
            alert("Error: "+data);
        }
    });
});

$("#regerer").click(function () {
    var un=$("#adun");
    var pw=$("#adpw");
    var ty=$("#tajp");
    var al=$("#alrtt");
    var u=$('#usnnn');
    var p=$('#pwww');
    var t=$('#ttp');
    var tt=$('#ttp1');
    al.slideUp();
    var grs=false;
    if(un.val()==""){
        grs=true;
        u.fadeIn();
        un.parent().addClass("has-error");
    }
    else{
        u.fadeOut();
        un.parent().removeClass("has-error");
    }
    if(pw.val()==""){
        grs=true;
        pw.parent().addClass("has-error");
        p.fadeIn();
    }
    else{
        p.fadeOut();
        pw.parent().removeClass("has-error");
    }
    if(ty.val()==0||ty.val()==null){
        grs=true;
        t.fadeIn();
        ty.parent().addClass("has-error");
    }
    else{
        ty.parent().removeClass("has-error");
        t.fadeOut();
    }
    tt.fadeOut();
    if(grs){
        al.slideDown();
    }
    else {
        $.post("includes/ajax.php",{usnad:un.val(),pewe:pw.val(),lvl:ty.val()},function (data) {
            if(data==0){
                tt.fadeIn();
                al.slideDown();
            }
            else if(data==1){
                $("#scs2").slideDown();
            }
            else alert(data);
        });
    }
});
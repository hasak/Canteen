/**
 * Created by BAYRAKTAR on 23.03.2016.
 */

var s,s2,i=0,p,add2;
var prilogboja="rgb(250, 240, 230)",neprilogboja="rgb(255, 255, 255)";
var alt="<div class='row skrv' id='altii'>" +
    "<div class='col-xs-12'><div class='alert alert-danger'><strong>Error!</strong> No more than 9 items per order.</div></div>" +
    "</div>";
function napp(f,mj){
    if(i!=0){
        var lf=$(".food[data-lastf=1]");
        lf.attr("data-lastf","0");
    }
    i++;
    var u=$("#ukpi");
    u.val(parseInt(u.val())+1);
    var st;
    if(mj)
        st=prilogboja;
    else st="";
    return ""+
        "<div class=\"row skrv text-center crrow\" id=\"row"+i+"\">" +

        "<div class='col-md-6'>"+
        "<div class='row form-group'>"+
        "<div class=\"col-xs-2\">" +
        "<span class='glyphicon glyphicon-remove remover' data-i='"+i+"' style='font-size: 20px;line-height: 30px;'></span>"+
        "</div>" +
        "<div class=\"col-xs-7\">" +

        "<select name='food"+i+"' id = 'food"+i+"' data-lastf='1' data-idfuda='"+i+"' class=\"form-control food\" style='background-color: "+st+";'>" +
        "<option value=\"0\" disabled selected hidden>Select</option>" + f +
        "</select>" +
        "<input type='hidden' name='vfud"+i+"' value='"+mj+"'>"+

        "</div>" +

        "<div class=\"col-xs-3\">" +
        "<input name=\"qty"+i+"\" id=\"qty"+i+"\" type=\"number\" max=\"10\" data-idkvan='"+i+"' min=\"1\" class=\"form-control qty\" disabled>" +
        "</div>" +

        "</div>"+
        "</div>"+

        "<div class='col-md-6 wr'>"+
        "<div class='well well-sm skrv cwell' id='zawell"+i+"'>"+
        "<div class='row'>"+

        "<div class=\"hidden-xs col-sm-2 hidden-md col-lg-1 skrv zap"+i+"\">" +
        "<span id=\"jedmj1"+i+"\" class=\"jedmj"+i+" jedinica prom\" data-i='"+i+"' data-toggle=\"tooltip\"></span>" +
        "</div>" +

        "<div class=\"hidden-xs col-sm-1 hidden-md col-lg-1 skrv zap"+i+"\">" +
        "<span style='font-size: larger'>&times;</span>" +
        "</div>" +

        "<div class=\"col-xs-6 col-sm-4 col-md-5 col-lg-4 skrv zap"+i+"\" style='padding: 0'>" +
        "<strong id=\"price"+i+"\" data-i='"+i+"' class='cijena'></strong> " +
        "<span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span><span>/" +
        "<span id=\"jedmj2"+i+"\" class=\"jedmj"+i+" jedinica\" data-i='"+i+"' data-toggle=\"tooltip\"></span></span>" +
        "<span class=\"skrv\" id=\"tajnaprice"+i+"\"></span>" +
        "</div>" +

        "<div class=\"col-xs-1 col-sm-1 col-md-1 col-lg-1 skrv zap"+i+"\">" +
        "<span>=</span>" +
        "</div>" +

        "<div class=\"col-xs-4 col-sm-4 col-md-5 col-lg-4 skrv zap"+i+"\" style='padding: 0'>" +
        "<strong id=\"pricetotal"+i+"\" class='ukuptot' data-i='"+i+"'></strong> <span title=\"Convertible Marka (BAM)\" data-toggle=\"tooltip\">KM</span>" +
        "</div>" +

        "</div>"+
        "</div>"+
        "</div>"+
        "</div>";
}

$(document).ready(function(){
    var form=$("#form1");
    $.post("includes/ajax.php",{start:true},function(data){
        s=data;
        form.append(napp(s,false));
        $("#row"+i).fadeIn("slow");
    });
    userrs();
    setInterval(userrs,5000)
    $('[data-toggle="tooltip"]').tooltip();
});

function userrs() {
    $.post("includes/ajax.php",{cncnu:true},function (data) {
        $("#userrfs").html(data);
    });
}

$(document).on("change",".food",function () {
    var t=$(this);
    var id=parseInt(t.attr("data-idfuda"));
    var idsel=t.val();
    var c=$(".cijena[data-i="+id+"]");
    var o=$("#food"+id+" option:selected");
    var j=$(".jedinica[data-i="+id+"]");
    var q=$("#qty"+id);
    var u=$(".ukuptot[data-i="+id+"]");
    var f=$("#form1");
    t.prop("disabled","true");
    q.val(1);
    if(o.attr("data-add")=="0")
        q.prop("disabled","").focus();
    else{
        if(o.attr("data-prilog")=="0"){
            npp(idsel);
            $("#adderp").fadeIn("slow");
            t.css("background-color","#ccc");
        }
    }
    if(o.attr("data-flut")=='1'){
        if(q.val()==1)
            j.attr("data-original-title","Kilogram").html("kg");
        else j.attr("data-original-title","Kilograms").html("kg");
        q.attr("step","0.1").attr("min","0.1");
    }
    else{
        if(q.val()==1)
            j.attr("data-original-title","Piece").html("pc");
        else j.attr("data-original-title","Pieces").html("pcs");
    }
    c.html(parseFloat(o.attr("data-price")).toFixed(2)).attr("data-skrvcjn",o.attr("data-price"));
    u.html((parseFloat(c.attr("data-skrvcjn"))*q.val()).toFixed(2)).attr("data-skrvcjnukp",parseFloat(c.attr("data-skrvcjn"))*q.val());
    $("#zawell"+id).show();
    $(".skrv.zap"+id).fadeIn("slow");
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on("focus",".qty",function(){
    $(this).select();
});

$(document).on("change",".qty",function () {
    var t=$(this);
    var id=parseInt(t.attr("data-idkvan"));
    var f=$("#food"+id);
    var idsel=f.val();
    var v=t.val();
    var c=$(".cijena[data-i="+id+"]");
    var u=$(".ukuptot[data-i="+id+"]");
    var j=$(".jedinica.prom[data-i="+id+"]");
    var min=parseInt(t.attr("min"));
    var max=parseInt(t.attr("max"));
    var o=$("option[data-id=hrn][value="+idsel+"]");
    if(v<min)
        t.val(min);
    if(v>max)
        t.val(max);
    if(o.attr("data-flut")=='1'){
        if(t.val()==1)
            j.attr("data-original-title","Kilogram").html("kg");
        else j.attr("data-original-title","Kilograms").html("kg");
        t.attr("step","0.1").attr("min","0.1");
    }
    else{
        if(t.val()==1)
            j.attr("data-original-title","Piece").html("pc");
        else j.attr("data-original-title","Pieces").html("pcs");
    }
    u.html((parseFloat(c.attr("data-skrvcjn"))*t.val()).toFixed(2)).attr("data-skrvcjnukp",parseFloat(c.attr("data-skrvcjn"))*t.val());
    $('[data-toggle="tooltip"]').tooltip();
    //todo
});

$(document).on("click",".addbtn",function () {
    var t=$(this);
    var form=$("#form1");
    var f=$(".food:last");
    if(f.val()!=null || !f.length){
        if(t.attr("data-addbtnprlg")=="false"){
            form.append(napp(s,false));
            $("#row"+i).slideDown("slow");
            $("#adderp").fadeOut("slow");
        }
        else{
            form.append(napp(s2,true));
            $("#row"+i).slideDown("slow");
        }
    }

});

function npp(es) {
    $.post("includes/ajax.php",{start2:true,es:es},function(data){
        s2=data;
    });
}

function promijeni() {
    var j,c=0;
    for(j=1;j<=i;j++){
        var t=$(".ukuptot[data-i="+j+"]");
        if(!isNaN(parseFloat(t.attr("data-skrvcjnukp"))))
            c+=parseFloat(t.attr("data-skrvcjnukp"));
    }
    $("#totalpr").html(c.toFixed(2));
}


$(document).on("change",".row",function () {
    promijeni();
});

$(document).on("click","#orderbtn",function () {
    var f=$("#form1");
    f.submit();
});

$(document).on("submit","#form1",function () {
    var f=$("#form1");
    var h=$("select, input");
    h.removeProp("disabled");
    var s=f.serialize();
    h.prop("disabled","true");
    window.location.href="checkout?"+s;
    return false;
});

$(document).on("click","#confirmer",function(){    $(this).attr("disabled","disabled");
    $(this).addClass("disabled").html("<em>Loading...</em>");
    if(window.location.href.search("&confirmed=true")==-1){
        window.location.href+="&confirmed=true";
        //location.reload();
    }
    else location.reload();
});

$(document).on("click",".remover",function(){
    var id=$(this).attr("data-i");
    var o=$("#food"+id+" option:selected");
    var addp=$("#adderp");
    addp.fadeOut("fast");
    $("#row"+id).slideUp("fast",function () {
        $(this).remove();
        promijeni();
    });
    if(o.attr("data-add")=='1'){
        var b=$("option[data-subid="+o.val()+"]").closest(".crrow");
        b.remove();
        promijeni();
    }
});

$(document).on("click","tr[data-tr=tr]",function () {
    var id=$(this).attr("data-i");
    $.get("includes/ajax.php",{opetord:id},function (data) {
        window.location.href=data;
    });
});
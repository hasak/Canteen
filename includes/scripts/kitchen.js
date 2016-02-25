/**
 * Created by Hasak on 15.04.2016..
 */
$(document).ready(function () {
    rnc();
    setInterval(rnc,5000);
    rnc2();
    setInterval(rnc2,5000);
    rnc3();
    setInterval(rnc3,5000);
});

function rnc() {
    $.post("includes/ajax.php",{cncn:true},function (data) {
        $("#insrt").html(data);
    });
}

function rnc2() {
    $.post("includes/ajax.php",{cncn2:true},function (data) {
        $("#insrt2").html(data);
    });
}
function rnc3() {
    $.post("includes/ajax.php",{cncn3:true},function (data) {
        $("#insrt3").html(data);
        $('[data-toggle="tooltip"]').tooltip();
    });
}

$(document).on("click","[data-trr=trr]:first-of-type",function () {
    var id=$(this).attr("data-i");
    $.post("includes/ajax.php",{uzeo:id},function (data) {
        rnc();
        rnc2();
        rnc3();
    });
});

$(document).on("click","[data-trr2=trr2]",function () {
    var id=$(this).attr("data-i");
    $.post("includes/ajax.php",{uzeo2:id},function (data) {
        rnc();
        rnc2();
        rnc3();
    });
});

$(document).on("click","[data-trr3=trr3]",function () {
    var id=$(this).attr("data-i");
    $.post("includes/ajax.php",{uzeo3:id},function (data) {
        rnc();
        rnc2();
        rnc3();
    });
});

$(document).on("click","#enterr",function () {
    var div=$("#dinn");
    var sta=$("#whaaat");
    var btn=$("#enterr");
    var gr=$("#grr");
    gr.slideUp();
    if(sta.val()!=""){
        btn.prop("disabled","true");
        $.post("includes/ajax.php",{stajed:sta.val()},function (dat) {
            if(dat==1){
                div.slideUp();
            }
            else {
                btn.removeProp("disabled");
                alert(dat);
            }
        })
    }
    else gr.slideDown();
});

$(document).on("keypress","#whaaat",function (e) {
    if(e.which==13){
        $("#enterr").click();
    }
});
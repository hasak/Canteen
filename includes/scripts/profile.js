/**
 * Created by Hasak on 06.05.2016..
 */
$("#cnger").click(function () {
    var p=$("#old");
    var d=$("#new1");
    var t=$("#new2");
    var c=$("#oldin");
    var pp=$("#oldy");
    var dd=$("#newy");
    var tt=$("#newy2");
    var nm=$("#nom");
    var al=$("#alrtt");
    var sk=$("#scs3");
    var gr=false;
    var bt=$("#cnger");
    bt.prop("disabled","true").html("<i>Loading...</i>");
    al.slideUp();
    if(p.val()==""){
        gr=true;
        pp.fadeIn();
        p.parent().addClass("has-error");
    }
    else{
        p.parent().removeClass("has-error");
        pp.fadeOut();
    }
    if(d.val()==""){
        gr=true;
        dd.fadeIn();
        d.parent().addClass("has-error");
    }
    else{
        d.parent().removeClass("has-error");
        dd.fadeOut();
    }
    if(t.val()==""){
        gr=true;
        tt.fadeIn();
        t.parent().addClass("has-error");
    }
    else{
        tt.fadeOut();
        t.parent().removeClass("has-error");
    }
    if(d.val()!="" && t.val()!=""){
        if(d.val()!=t.val()){
            gr=true;
            nm.fadeIn();
            t.parent().addClass("has-error");
            d.parent().addClass("has-error");
        }
        else{
            nm.fadeOut();
            t.parent().removeClass("has-error");
            d.parent().removeClass("has-error");
        }
    }
    if(gr){
        al.slideDown();
        bt.removeProp("disabled").html("Change");
    }
    else{
        $.post("includes/ajax.php",{old:p.val(),neww:d.val()},function (dat) {
            c.fadeOut();
            if(dat==0){
                c.fadeIn();
                al.slideDown();
                bt.removeProp("disabled").html("Change");
            }
            else if(dat==1){
                sk.slideDown();
                bt.html("<i>Finished</i>");
            }
            else {
                alert(dat);
                bt.removeProp("disabled").html("Change");
            }
        })
    }
});
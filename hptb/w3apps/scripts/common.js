/**
 * Created by Aman Ullah on 1/29/2017.
 */

$(document).ready(function () {
    var bk = $.post("http://127.0.0.1:80/mist/hptb/contents/plc/reply.php",{},function () {
        $("#loading-scr").css({
            "display":"none"
        });
        $("#service").css({
            "display":"block"
        });
    });
    bk.fail(function () {
        $("#loading-scr").css({
            "display":"none"
        });
        $("#no-service").css({
            "display":"block"
        });
    });
    //alert(screen.height);
});
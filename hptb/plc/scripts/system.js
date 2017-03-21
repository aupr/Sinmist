/**
 * Created by Aman Ullah on 1/28/2017.
 */
function loadStyle(url, callback){
    var link = document.createElement( "link" );
    link.href = url;
    link.type = "text/css";
    link.rel = "stylesheet";
    link.media = "screen,print";
    link.onreadystatechange = callback;
    link.onload = callback;
    document.getElementsByTagName( "head" )[0].appendChild( link );
}

function loadScript(url, callback)
{
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;
    script.onreadystatechange = callback;
    script.onload = callback;
    head.appendChild(script);
}

var mainCode = function(){
    $.post(server + "contents/plc/service.php",{"request":it_hold_request()},function (res) {
        var srv = $("#service");
        srv.html(res);
        preprocess();
        $("#loading").css({
            "display":"none"
        });
        srv.css({
            "display":"block"
        });
        process();
    });
};

// Load prerequisite library from remote server
loadScript(server + "contents/vendors/jquery/3.1.0/jquery-3.1.0.min.js", function () {
    loadScript(server + "contents/vendors/jquery-ui/1.12.0.custom.all/jquery-ui.min.js", function () {
        loadScript(server + "contents/vendors/itonic/1.0/itonic.min.js", function () {
            loadScript(server + "contents/plc/scripts/process.js", function () {
                loadStyle(server + "contents/vendors/bootstrap/3.3.7/css/bootstrap.min.css", function () {
                    loadStyle(server + "contents/plc/styles/main.css", mainCode);
                });
            });
        });
    });
});





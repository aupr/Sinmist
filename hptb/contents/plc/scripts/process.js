/**
 * Created by Aman Ullah on 1/28/2017.
 */
var preprocess = function () {
    // Global primary variables
    {
        plcUserId = 'admin';
        plcPassword = "";
    }

    $("body").css({
        "background-color": "black"
    });

    $("nav .logo").css({
        "background-image": "url('"+server+"contents/images/logo.png')"
    });
    isProcess = 1;
    window.onbeforeunload = function (){
        if (isProcess > 0) return true;
        else
        {
            //do something
        }
    };
};
var process = function () {



};
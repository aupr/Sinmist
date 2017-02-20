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

    //background-image: url("http://192.168.10.195:80/mist/hptb/contents/images/mist_ptp_pnid.png");
    if (pumpInfo.pumpType === "Submersible Pump"){
        $("#pnidPanel").css({
            "background-image": 'url("'+server+'contents/images/pnid_proto_submersible.png")'
        });
    } else {
        $("#pnidPanel").css({
            "background-image": 'url("'+server+'contents/images/pnid_proto_centrifugal.png")'
        });
    }


    isProcess = 0;
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
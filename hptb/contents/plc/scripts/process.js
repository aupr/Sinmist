/**
 * Created by Aman Ullah on 1/28/2017.
 */
var preprocess = function () {
    // Global primary variables
    plcUserId = 'admin';
    plcPassword = "";

    //Auto login
    var spost = 'Login='+plcUserId+'&Password='+plcPassword;
    $.post("/FormLogin", spost, function(result) {
        console.log("Access & Login PLC: Success");
    }).fail(function () {
        console.log("Access & Login PLC: Failed");
    });

    $("body").css({
        "background-color": "black"
    });

    $("nav .logo").css({
        "background-image": "url('"+server+"contents/images/logo.png')"
    });

    //background-image: url("http://192.168.10.195:80/mist/hptb/contents/images/mist_ptp_pnid.png");
/*    if (pumpInfo.pumpType === "Submersible Pump"){
        $("#pnidPanel").css({
            "background-image": 'url("'+server+'contents/images/pnid_proto_submersible.png")'
        });
    } else {
        $("#pnidPanel").css({
            "background-image": 'url("'+server+'contents/images/pnid_proto_centrifugal.png")'
        });
    }*/


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

    var statusVal = {
        mode: "Auto",
        process: "Stopped",
        pipeDia: 4,
        vp: 56,
        nvp: 59,
        frm: 555,
        fru: 555,
        motor: "Stopped",
        freq: 50,
        rpm: 1000,
        power: 30,
        current: 100
    };

viewSystemStatus(statusVal);

bindControlBoxButtons();

};
////////////////////////////////// External Function

var mainData = [];

/*function dumpData(rwd) {
    mainData.push(rwd);
    mainData.sort(function (a, b) {
        return a.frm - b.frm;
    });
}*/

var dummyData = [
    {
        vo: 41,
        sp: 90,
        dp: 87,
        frm: 80,
        fru: 98,
        men: 87,
        mfq: 66
    },
    {
        vo: 42,
        sp: 90,
        dp: 87,
        frm: 70,
        fru: 98,
        men: 87,
        mfq: 66
    },
    {
        vo: 43,
        sp: 90,
        dp: 87,
        frm: 90,
        fru: 98,
        men: 87,
        mfq: 66
    },
    {
        vo: 44,
        sp: 90,
        dp: 87,
        frm: 60,
        fru: 98,
        men: 87,
        mfq: 66
    }
];

function updateDataTable(rdata) {
    rdata.sort(function (a,b) {
        return a.frm - b.frm;
    });
    $("#dataViewTable").html("");
    rdata.forEach(function (row, ind) {
        ind = ind+1;
        $("#dataViewTable").append(' <tr>' +
            '<td>'+ind+'</td>' +
            '<td>'+row.vo+'</td>' +
            '<td>'+row.sp+'</td>' +
            '<td>'+row.dp+'</td>' +
            '<td>'+row.frm+'</td>' +
            '<td>'+row.fru+'</td>' +
            '<td>'+row.men+'</td>' +
            '<td>'+row.mfq+'</td>' +
            '</tr>');
    });
}

function bindControlBoxButtons() {
    $("#cb-start-process").click(startProcessHit);
    $("#cb-take-data").click(takeDataHit);
    $("#cb-emergency").click(emergencyHit);
}

function cbOptionsDisabled(tf) {
    $("input","#processMode").prop('disabled', tf);
    $("#valveOpenBy").prop('disabled', tf);
    //var fff = $("input[name=pmode]:checked", "#processMode").val();
    //alert(fff);
}

var startProcessHit = function () {
    $("#cb-start-process").css({
        display: "none"
    });
    $("#cb-take-data").css({
        display: "block"
    });
    cbOptionsDisabled(true);
};

var takeDataHit = function () {
    /*$("#cb-take-data").css({
        display: "none"
    });*/
    $("#cb-emergency").css({
        display: "block"
    });
    updateDataTable(dummyData);
    systemLog("Data hit pressed ... ","#system-log");
    var startTag = '"Control".VFD_Control.Write_To_G120.Start=1';
    $.get('data.html?'+startTag, function (result) {
        console.log(result);
    }, 'json');

};

var emergencyHit = function () {
    $("#cb-emergency").css({
        display: "none"
    });
    $("#cb-start-process").css({
        display: "block"
    });
    cbOptionsDisabled(false);

    $.get('data.html?"Control".VFD_Control.Write_To_G120.Stop=1', function (result) {
        console.log(result);
    }, 'json');
};

function viewSystemStatus (sv) {
    $("#status-mode").html(sv.mode);
    $("#status-process").html(sv.process);
    $("#status-pipe-dia").html(sv.pipeDia);
    $("#status-valve-position").html(sv.vp);
    $("#status-flow-rate-m").html(sv.frm);
    $("#status-flow-rate-u").html(sv.fru);
    $("#status-next-vp").html(sv.nvp);
    $("#status-motor").html(sv.motor);
    $("#status-freq").html(sv.freq);
    $("#status-rpm").html(sv.rpm);
    $("#status-power").html(sv.power);
    $("#status-current").html(sv.current);
}

function scrollUp(selector){
    $(selector).scrollTop(selector.prop("scrollHeight"));
}
logLimit = 5000;
txt = "";
logNum = 0;
function systemLog(str,selector){
    selector = $(selector);
    logNum++;
    var dt = new Date();
    var dateStr = dt.getFullYear()+"-"+dt.getMonth()+1+"-"+dt.getDate()+" > "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
    if(txt === ""){
        txt += logNum+" > "+dateStr+" > "+ str;
    }else{
        txt += "\r\n"+logNum+" > "+dateStr+" > "+ str;
    }
    var spt = txt.split("\r\n");
    sptLen = spt.length;
    if(sptLen > logLimit){
        spt = spt.slice(sptLen-logLimit, sptLen);
    }
    txt = spt.join("\r\n");
    selector.val(txt);
    scrollUp(selector);
}
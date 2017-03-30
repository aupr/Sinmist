/**
 * Created by Aman Ullah on 1/28/2017.
 */
var preprocess = function () {
    // Global primary variables
    plcUserId = 'admin';
    plcPassword = "";

    plcTag = {
        vfd_start: '"Control".VFD_Control.Write_To_G120.Start',
        vfd_stop: '"Control".VFD_Control.Write_To_G120.Stop',
        vfd_frequency: '"Control".VFD_Control.Write_To_G120."Set Frequency"',
        emfm_1_minLimit: '"Control".Flow_Meters.Electro_Magnetic."1"."Min Limit"',
        emfm_1_maxLimit: '"Control".Flow_Meters.Electro_Magnetic."1"."Max Limit"',
        emfm_2_minLimit: '"Control".Flow_Meters.Electro_Magnetic."2"."Min Limit"',
        emfm_2_maxLimit: '"Control".Flow_Meters.Electro_Magnetic."2"."Max Limit"',
        emfm_3_minLimit: '"Control".Flow_Meters.Electro_Magnetic."3"."Min Limit"',
        emfm_3_maxLimit: '"Control".Flow_Meters.Electro_Magnetic."3"."Max Limit"',
        emfm_4_minLimit: '"Control".Flow_Meters.Electro_Magnetic."4"."Min Limit"',
        emfm_4_maxLimit: '"Control".Flow_Meters.Electro_Magnetic."4"."Max Limit"',
        kgv_1_position: '"Control".Knife_Gate_Valve."1".Input',
        kgv_2_position: '"Control".Knife_Gate_Valve."2".Input',
        kgv_3_position: '"Control".Knife_Gate_Valve."3".Input',
        kgv_4_position: '"Control".Knife_Gate_Valve."4".Input',
        pt_1_minLimit: '"Control".PressureTransmitters."1"."Min Limit"',
        pt_1_maxLimit: '"Control".PressureTransmitters."1"."Max Limit"',
        pt_2_minLimit: '"Control".PressureTransmitters."2"."Min Limit"',
        pt_2_maxLimit: '"Control".PressureTransmitters."2"."Max Limit"',
        pt_3_minLimit: '"Control".PressureTransmitters."3"."Min Limit"',
        pt_3_maxLimit: '"Control".PressureTransmitters."3"."Max Limit"',
        pt_4_minLimit: '"Control".PressureTransmitters."4"."Min Limit"',
        pt_4_maxLimit: '"Control".PressureTransmitters."4"."Max Limit"',
        pt_5_minLimit: '"Control".PressureTransmitters."5"."Min Limit"',
        pt_5_maxLimit: '"Control".PressureTransmitters."5"."Max Limit"',
        pt_6_minLimit: '"Control".PressureTransmitters."6"."Min Limit"',
        pt_6_maxLimit: '"Control".PressureTransmitters."6"."Max Limit"',
        pt_7_minLimit: '"Control".PressureTransmitters."7"."Min Limit"',
        pt_7_maxLimit: '"Control".PressureTransmitters."7"."Max Limit"',
        pt_8_minLimit: '"Control".PressureTransmitters."8"."Min Limit"',
        pt_8_maxLimit: '"Control".PressureTransmitters."8"."Max Limit"',
        pt_9_minLimit: '"Control".PressureTransmitters."9"."Min Limit"',
        pt_9_maxLimit: '"Control".PressureTransmitters."9"."Max Limit"',
        pt_10_minLimit: '"Control".PressureTransmitters."10"."Min Limit"',
        pt_10_maxLimit: '"Control".PressureTransmitters."10"."Max Limit"'
    };

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
    var startTag = plcTag.pt_1_maxLimit+'=10';
    $.post('limit.html',startTag, function (result) {
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

    $.get('data.html?'+plcTag.vfd_stop+'=1', function (result) {
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
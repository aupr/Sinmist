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
        usfm_1_minLimit: '"Control".Flow_Meters.Ultrasonic."1"."Min Limit"',
        usfm_1_maxLimit: '"Control".Flow_Meters.Ultrasonic."1"."Max Limit"',
        usfm_2_minLimit: '"Control".Flow_Meters.Ultrasonic."2"."Min Limit"',
        usfm_2_maxLimit: '"Control".Flow_Meters.Ultrasonic."2"."Max Limit"',
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

updateCurrentSystemStatus(statusVal);

bindButtons();

   // disableManualElements(true);

};
////////////////////////////////// External Function

var mainData = [];

/*function dumpData(rwd) {
    mainData.push(rwd);
    mainData.sort(function (a, b) {
        return a.frm - b.frm;
    });
}*/

/*var dummyData = [
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
];*/


function bindButtons() {
    $("#btn-settings").click(plcLimitSettings);
    $("#cb-start-process").click(startProcessHit);
    $("#cb-take-data").click(takeDataHit);
    $("#cb-emergency").click(emergencyHit);
    $("#setManualValvePosition").click(setManualValvePosition);
    $("#mib-motor-on").click(manualMotorOn);
    $("#mib-motor-off").click(manualMotorOff);
    $("#mib-take-status").click(manualUpdateStatus);
}

function disableControllerElements(tf) {
    $("input","#processMode").prop('disabled', tf);
    $("#valveLowerLimit").prop('disabled', tf);
    $("#valveUpperLimit").prop('disabled', tf);
    $("#numberOfObs").prop('disabled', tf);
    $("#ultrasonicSensorChannel").prop('disabled', tf);
}

function disableManualElements(tf) {
    var vRange = $('#manualValvePosition');
    vRange.prop('disabled', tf);
    hideElementById('setManualValvePosition', tf);
    hideElementById('mib-motor-on', tf);
    hideElementById('mib-motor-off', tf);
    hideElementById('mib-take-status', tf);

    if (!tf){
        vRange.prop('min', $('#valveLowerLimit').val());
        vRange.prop('max', $('#valveUpperLimit').val());
        manualValvePosition = vRange.val();
        $('#setManualValvePosition span').text(manualValvePosition+'%');
        hideElementById('mib-motor-off', !tf);
    }
}

function hideElementById(id,tf) {
    if (tf) {
        $("#"+id).css({
            display: "none"
        });
    } else {
        $("#"+id).css({
            display: "block"
        });
    }
}

var plcLimitSettings = function () {
    it_modal_loading();
    $.get('limit.html', function (res) {
        var bodyHtml = '<table style="width: 100%;"><tbody>'+
        '<tr><td><label for="emfm-1-ll">EMFM-1 Lower Limit </label></td><td>:</td><td><input type="number" id="emfm-1-ll" value="'+res.emfm_1_minLimit+'"></td>'+
        '<td><label for="emfm-1-ul">EMFM-1 Upper Limit </label></td><td>:</td><td><input type="number" id="emfm-1-ul" value="'+res.emfm_1_maxLimit+'"></td></tr>'+
        '<tr><td><label for="emfm-2-ll">EMFM-2 Lower Limit </label></td><td>:</td><td><input type="number" id="emfm-2-ll" value="'+res.emfm_2_minLimit+'"></td>'+
        '<td><label for="emfm-2-ul">EMFM-2 Upper Limit </label></td><td>:</td><td><input type="number" id="emfm-2-ul" value="'+res.emfm_2_maxLimit+'"></td></tr>'+
        '<tr><td><label for="emfm-3-ll">EMFM-3 Lower Limit </label></td><td>:</td><td><input type="number" id="emfm-3-ll" value="'+res.emfm_3_minLimit+'"></td>'+
        '<td><label for="emfm-3-ul">EMFM-3 Upper Limit </label></td><td>:</td><td><input type="number" id="emfm-3-ul" value="'+res.emfm_3_maxLimit+'"></td></tr>'+
        '<tr><td><label for="emfm-4-ll">EMFM-4 Lower Limit </label></td><td>:</td><td><input type="number" id="emfm-4-ll" value="'+res.emfm_4_minLimit+'"></td>'+
        '<td><label for="emfm-4-ul">EMFM-4 Upper Limit </label></td><td>:</td><td><input type="number" id="emfm-4-ul" value="'+res.emfm_4_maxLimit+'"></td></tr>'+
        '<tr><td><label for="usfm-1-ll">USFM-1 Lower Limit </label></td><td>:</td><td><input type="number" id="usfm-1-ll" value="'+res.usfm_1_minLimit+'"></td>'+
        '<td><label for="usfm-1-ul">USFM-1 Upper Limit </label></td><td>:</td><td><input type="number" id="usfm-1-ul" value="'+res.usfm_1_maxLimit+'"></td></tr>'+
        '<tr><td><label for="usfm-2-ll">USFM-2 Lower Limit </label></td><td>:</td><td><input type="number" id="usfm-2-ll" value="'+res.usfm_2_minLimit+'"></td>'+
        '<td><label for="usfm-2-ul">USFM-2 Upper Limit </label></td><td>:</td><td><input type="number" id="usfm-2-ul" value="'+res.usfm_2_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-1-ll">PT-1 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-1-ll" value="'+res.pt_1_minLimit+'"></td>'+
        '<td><label for="pt-1-ul">PT-1 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-1-ul" value="'+res.pt_1_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-2-ll">PT-2 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-2-ll" value="'+res.pt_2_minLimit+'"></td>'+
        '<td><label for="pt-2-ul">PT-2 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-2-ul" value="'+res.pt_2_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-3-ll">PT-3 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-3-ll" value="'+res.pt_3_minLimit+'"></td>'+
        '<td><label for="pt-3-ul">PT-3 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-3-ul" value="'+res.pt_3_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-4-ll">PT-4 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-4-ll" value="'+res.pt_4_minLimit+'"></td>'+
        '<td><label for="pt-4-ul">PT-4 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-4-ul" value="'+res.pt_4_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-5-ll">PT-5 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-5-ll" value="'+res.pt_5_minLimit+'"></td>'+
        '<td><label for="pt-5-ul">PT-5 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-5-ul" value="'+res.pt_5_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-6-ll">PT-6 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-6-ll" value="'+res.pt_6_minLimit+'"></td>'+
        '<td><label for="pt-6-ul">PT-6 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-6-ul" value="'+res.pt_6_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-7-ll">PT-7 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-7-ll" value="'+res.pt_7_minLimit+'"></td>'+
        '<td><label for="pt-7-ul">PT-7 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-7-ul" value="'+res.pt_7_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-8-ll">PT-8 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-8-ll" value="'+res.pt_8_minLimit+'"></td>'+
        '<td><label for="pt-8-ul">PT-8 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-8-ul" value="'+res.pt_8_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-9-ll">PT-9 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-9-ll" value="'+res.pt_9_minLimit+'"></td>'+
        '<td><label for="pt-9-ul">PT-9 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-9-ul" value="'+res.pt_9_maxLimit+'"></td></tr>'+
        '<tr><td><label for="pt-10-ll">PT-10 Lower Limit </label></td><td>:</td><td><input type="number" id="pt-10-ll" value="'+res.pt_10_minLimit+'"></td>'+
        '<td><label for="pt-10-ul">PT-10 Upper Limit </label></td><td>:</td><td><input type="number" id="pt-10-ul" value="'+res.pt_10_maxLimit+'"></td></tr>'+
        '</tbody></table>';

        it_modal_open("Sensors Data Limit Setup!", bodyHtml, 'dodgerblue', '800px', 'Close, Save', function (br) {
            if (br == 'Save') {

                var plcRequest =
                    plcTag.emfm_1_minLimit+'='+$("#emfm-1-ll").val()+'&'+
                    plcTag.emfm_1_maxLimit+'='+$("#emfm-1-ul").val()+'&'+
                    plcTag.emfm_2_minLimit+'='+$("#emfm-2-ll").val()+'&'+
                    plcTag.emfm_2_maxLimit+'='+$("#emfm-2-ul").val()+'&'+
                    plcTag.emfm_3_minLimit+'='+$("#emfm-3-ll").val()+'&'+
                    plcTag.emfm_3_maxLimit+'='+$("#emfm-3-ul").val()+'&'+
                    plcTag.emfm_4_minLimit+'='+$("#emfm-4-ll").val()+'&'+
                    plcTag.emfm_4_maxLimit+'='+$("#emfm-4-ul").val()+'&'+
                    plcTag.usfm_1_minLimit+'='+$("#usfm-1-ll").val()+'&'+
                    plcTag.usfm_1_maxLimit+'='+$("#usfm-1-ul").val()+'&'+
                    plcTag.usfm_2_minLimit+'='+$("#usfm-2-ll").val()+'&'+
                    plcTag.usfm_2_maxLimit+'='+$("#usfm-2-ul").val()+'&'+
                    plcTag.pt_1_minLimit+'='+$("#pt-1-ll").val()+'&'+
                    plcTag.pt_1_maxLimit+'='+$("#pt-1-ul").val()+'&'+
                    plcTag.pt_2_minLimit+'='+$("#pt-2-ll").val()+'&'+
                    plcTag.pt_2_maxLimit+'='+$("#pt-2-ul").val();

                it_modal_loading();

                $.get('limit.html?'+plcRequest, function () {

                    plcRequest =
                        plcTag.pt_3_minLimit+'='+$("#pt-3-ll").val()+'&'+
                        plcTag.pt_3_maxLimit+'='+$("#pt-3-ul").val()+'&'+
                        plcTag.pt_4_minLimit+'='+$("#pt-4-ll").val()+'&'+
                        plcTag.pt_4_maxLimit+'='+$("#pt-4-ul").val()+'&'+
                        plcTag.pt_5_minLimit+'='+$("#pt-5-ll").val()+'&'+
                        plcTag.pt_5_maxLimit+'='+$("#pt-5-ul").val()+'&'+
                        plcTag.pt_6_minLimit+'='+$("#pt-6-ll").val()+'&'+
                        plcTag.pt_6_maxLimit+'='+$("#pt-6-ul").val()+'&'+
                        plcTag.pt_7_minLimit+'='+$("#pt-7-ll").val()+'&'+
                        plcTag.pt_7_maxLimit+'='+$("#pt-7-ul").val()+'&'+
                        plcTag.pt_8_minLimit+'='+$("#pt-8-ll").val()+'&'+
                        plcTag.pt_8_maxLimit+'='+$("#pt-8-ul").val()+'&'+
                        plcTag.pt_9_minLimit+'='+$("#pt-9-ll").val()+'&'+
                        plcTag.pt_9_maxLimit+'='+$("#pt-9-ul").val()+'&'+
                        plcTag.pt_10_minLimit+'='+$("#pt-10-ll").val()+'&'+
                        plcTag.pt_10_maxLimit+'='+$("#pt-10-ul").val();

                    $.get('limit.html?'+plcRequest, function () {
                        it_modal_close();
                    }).fail(function () {
                        alert('PLC server is not responding at secondary step.')
                    });

                }).fail(function () {
                    alert('PLC server is not responding at primary step.');
                });

            } else if (br == 'Close') {
                it_modal_close();
            }
        });

    }, 'json').fail(function () {
        alert('PLC communication failure.');
    });
};

var startProcessHit = function () {
    requestProgress('start');

    hideElementById('cb-start-process', true);
    disableControllerElements(true);

    var requestData = '';

    $.get('data.html?'+requestData, function (res) {
        requestProgress('end');

        processInfo.motorStatus = 'Stopped';
        processInfo.status = 'Running';
        processInfo.usfmChannel = $('#ultrasonicSensorChannel').val();

        if ($('input[name="pmode"]:checked').val() === 'manual') {
            disableManualElements(false);
            processInfo.mode = 'Manual';
        } else {
            processInfo.mode = 'Automatic';
        }

        hideElementById('cb-take-data', false);
        hideElementById('cb-emergency', false);

        updateCurrentSystemStatus(res);
    }, 'json').fail(function () {
        requestProgress('stop');
        hideElementById('cb-start-process', false);
        disableControllerElements(false);
        alert('PLC is not responding!');
    });
};

var takeDataHit = function () {

    if (processInfo.mode === 'Manual') {
        if (dataTakePermission) {
            dataTakePermission = false;
            updateDataAndView(statusHold);
        } else {
            it_modal_info('Already taken this data!');
        }

    } else if (processInfo.mode === 'Automatic') {

    } else {
        it_modal_info('Something going absurd!');
    }

   /* hideElementById('cb-take-data', true);

    systemLog("Data hit pressed ... ","#system-log");

    var startTag = plcTag.pt_1_maxLimit+'=10';

    $.get('data.html',startTag, function (result) {
        console.log(result);
        updateDataAndView(result);
        hideElementById('cb-take-data', false);
    }, 'json');*/
};

var emergencyHit = function () {
    requestProgress('start');

    hideElementById('cb-emergency', true);
    hideElementById('cb-take-data', true);

    $.get('data.html?'+plcTag.vfd_stop+'=1', function (result) {
        requestProgress('end');
        processInfo.status = 'Stopped';
        processInfo.motorStatus = 'Stopped';
        disableManualElements(true);
        hideElementById('cb-start-process', false);
        disableControllerElements(false);
        updateCurrentSystemStatus(result);
        handleData();
    }, 'json').fail(function () {
        requestProgress('stop');
        hideElementById('cb-emergency', false);
        hideElementById('cb-take-data', false);
    });
};

var setManualValvePosition = function () {
    hideElementById('setManualValvePosition', true);

    requestProgress('start');

    var reqData = '';

    if (pumpInfo.pipeDia === 3) {
        reqData = plcTag.kgv_1_position+'='+manualValvePosition;
    } else if (pumpInfo.pipeDia === 4) {
        reqData = plcTag.kgv_2_position+'='+manualValvePosition;
    } else if (pumpInfo.pipeDia === 6) {
        reqData = plcTag.kgv_3_position+'='+manualValvePosition;
    } else if (pumpInfo.pipeDia === 8) {
        reqData = plcTag.kgv_4_position+'='+manualValvePosition;
    }

    $
        .get('data.html?'+reqData, function (res) {
            hideElementById('setManualValvePosition', false);
            requestProgress('end');
            updateCurrentSystemStatus(res);
        }, 'json')
        .fail(function () {
            requestProgress('stop');
            hideElementById('setManualValvePosition', false);
            alert('PLC is not responding the request!');
        });
};

var manualMotorOn = function () {
    hideElementById('mib-motor-on', true);

    requestProgress('start');

    var reqData = plcTag.vfd_start+'=1';

    $.get('data.html?'+reqData, function (res) {
        processInfo.motorStatus = 'Running';
        hideElementById('mib-motor-off', false);
        requestProgress('end');
        updateCurrentSystemStatus(res);
    }, 'json').fail(function () {
        requestProgress('stop');
        hideElementById('mib-motor-on', false);
        alert('PLC is not responding the request!');
    });
};

var manualMotorOff = function () {
    hideElementById('mib-motor-off', true);

    requestProgress('start');

    var reqData = plcTag.vfd_stop+'=1';

    $.get('data.html?'+reqData, function (res) {
        processInfo.motorStatus = 'Stopped';
        hideElementById('mib-motor-on', false);
        requestProgress('end');
        updateCurrentSystemStatus(res);
    }, 'json').fail(function () {
        requestProgress('stop');
        hideElementById('mib-motor-off', false);
        alert('PLC is not responding the request!');
    });
};

var manualUpdateStatus = function () {
    hideElementById('mib-take-status', true);

    requestProgress('start');

    $
        .get('data.html', function (res) {
            hideElementById('mib-take-status', false);
            updateCurrentSystemStatus(res);
            requestProgress('end');
        }, 'json')
        .fail(function () {
            hideElementById('mib-take-status', false);
            requestProgress('stop');
        });
};

function vpProgressBar(per) {
    $('#vpProgress').css({
        width: per+'%'
    });
}

function requestProgress(cmd) {
    if (cmd==='start'){
        var progress = 0;

        ptimer = setInterval(function () {
            vpProgressBar(progress++);

            if (progress>=90) {
                clearInterval(ptimer);
            }
        }, 300);

    } else if (cmd==='stop') {
        clearInterval(ptimer);
    } else if (cmd==='end') {
        clearInterval(ptimer);
        vpProgressBar(100);
    }
}

function targetSuctionPressureOnTypeDia(rd, pumpType, Dia) {
    if (pumpType === 'Submersible Pump') {
        return 0;
    } else {
        if (Dia === 3) {
            return rd.pt_1_output;
        } else if (Dia === 4) {
            return rd.pt_3_output;
        } else if (Dia === 6) {
            return rd.pt_5_output;
        } else if (Dia === 8) {
            return rd.pt_7_output;
        }
    }
}

function targetDischargePressureOnTypeDia(rd, pumpType, Dia) {
    if (pumpType === 'Submersible Pump') {
        if (Dia === 4) {
            return rd.pt_9_output;
        } else if (Dia === 6) {
            return rd.pt_10_output;
        }
    } else {
        if (Dia === 3) {
            return rd.pt_2_output;
        } else if (Dia === 4) {
            return rd.pt_4_output;
        } else if (Dia === 6) {
            return rd.pt_6_output;
        } else if (Dia === 8) {
            return rd.pt_8_output;
        }
    }
}

function targetValvePositionOnDia(rd, pipeDia) {
    if (pipeDia === 3) {
        return rd.kgv_1_position;
    } else if (pipeDia === 4) {
        return rd.kgv_2_position;
    } else if (pipeDia === 6) {
        return rd.kgv_3_position;
    } else if (pipeDia === 8) {
        return rd.kgv_4_position;
    }
}

function targetMFlowRateOnDia(rd, pipeDia) {
    if (pipeDia === 3) {
        return rd.emfm_1_output;
    } else if (pipeDia === 4) {
        return rd.emfm_2_output;
    } else if (pipeDia === 6) {
        return rd.emfm_3_output;
    } else if (pipeDia === 8) {
        return rd.emfm_4_output;
    }
}

function targetUFlowRateOnDia(rd, channel) {
    if (channel === '1') {
        return rd.usfm_1_output;
    } else if (channel === '2') {
        return rd.usfm_2_output;
    }
}

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

mainData = [];

function updateDataAndView(res) {
    var rdt = {
        vo: targetValvePositionOnDia(res, pumpInfo.pipeDia),
        sp: targetSuctionPressureOnTypeDia(res, pumpInfo.pumpType, pumpInfo.pipeDia),
        dp: targetDischargePressureOnTypeDia(res, pumpInfo.pumpType, pumpInfo.pipeDia),
        frm: targetMFlowRateOnDia(res, pumpInfo.pipeDia),
        fru: targetUFlowRateOnDia(res, processInfo.usfmChannel),
        men: res.vfd_power,
        mfq: res.vfd_frequency
    };

    var dataExists = false;

    mainData.forEach(function (data) {
        if (JSON.stringify(data) === JSON.stringify(rdt)) {
            dataExists = true;
        }
    });

    if (dataExists) {
        it_modal_info('Already exists this data in data holder!');
    } else {
        mainData.push(rdt);
        updateDataTable(mainData);

        if (mainData.length >= $('#numberOfObs').val()) {
            $('#cb-emergency').click();
        }
    }
}

function handleData() {
    if (mainData.length > 0) {
        var htmlData = '<b>What do you want with the data?</b>';

        it_modal_open('Observation Complete!', htmlData, '#008800', 0, 'Save, Erase, Cancel', function (br) {
            if (br === 'Save') {
                alert('save');
            } else if (br === 'Erase') {
                mainData = [];
                updateDataTable(mainData);
                it_modal_close();
            } else if ('Cancel') {
                it_modal_close();
            }
        });
    }
}

statusHold = {};
dataTakePermission = false;

function updateCurrentSystemStatus (res) {
    statusHold = res;
    dataTakePermission = true;
    //console.log(res);
    var sv = {
        mode: processInfo.mode,
        process: processInfo.status,
        pipeDia: pumpInfo.pipeDia,
        vp: targetValvePositionOnDia(res, pumpInfo.pipeDia),
        frm: targetMFlowRateOnDia(res, pumpInfo.pipeDia),
        fru: targetUFlowRateOnDia(res, processInfo.usfmChannel),
        sp: targetSuctionPressureOnTypeDia(res, pumpInfo.pumpType, pumpInfo.pipeDia),
        dp: targetDischargePressureOnTypeDia(res, pumpInfo.pumpType, pumpInfo.pipeDia),
        motor: processInfo.motorStatus,
        freq: res.vfd_frequency,
        rpm: res.vfd_rpm,
        power: res.vfd_power,
        current: res.vfd_current
    };

    $("#status-mode").html(sv.mode);
    $("#status-process").html(sv.process);
    $("#status-pipe-dia").html(sv.pipeDia);
    $("#status-valve-position").html(sv.vp);
    $("#mibCvp").html(sv.vp);
    $("#status-flow-rate-m").html(sv.frm);
    $("#status-flow-rate-u").html(sv.fru);
    $("#status-next-vp").html(sv.nvp);
    $("#status-suction-pressure").html(sv.sp);
    $("#status-discharge-pressure").html(sv.dp);
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
function systemLog(str){
    selector = $('#system-log');
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
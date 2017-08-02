/**
 * Created by Aman Ullah on 1/28/2017.
 */
var preprocess = function () {
    // Global primary variables
    plcUserId = 'admin';
    plcPassword = "1234";

    plcTag = {
        vfd_start: '"Control".VFD_Control.Write_To_G120.Start',
        vfd_stop: '"Control".VFD_Control.Write_To_G120.Stop',
        vfd_frequency: '"Control".VFD_Control.Write_To_G120.SetFrequency',
        vfd_power_max: '"Control".VFD_Control.Read_From_G120.Power.MaxRange',
        vfd_current_max: '"Control".VFD_Control.Read_From_G120.Current.MaxRange',
        emfm_1_minLimit: '"Control".Flow_Meters.Electro_Magnetic."1".MinLimit',
        emfm_1_maxLimit: '"Control".Flow_Meters.Electro_Magnetic."1".MaxLimit',
        emfm_2_minLimit: '"Control".Flow_Meters.Electro_Magnetic."2".MinLimit',
        emfm_2_maxLimit: '"Control".Flow_Meters.Electro_Magnetic."2".MaxLimit',
        emfm_3_minLimit: '"Control".Flow_Meters.Electro_Magnetic."3".MinLimit',
        emfm_3_maxLimit: '"Control".Flow_Meters.Electro_Magnetic."3".MaxLimit',
        emfm_4_minLimit: '"Control".Flow_Meters.Electro_Magnetic."4".MinLimit',
        emfm_4_maxLimit: '"Control".Flow_Meters.Electro_Magnetic."4".MaxLimit',
        usfm_1_minLimit: '"Control".Flow_Meters.Ultrasonic."1".MinLimit',
        usfm_1_maxLimit: '"Control".Flow_Meters.Ultrasonic."1".MaxLimit',
        usfm_2_minLimit: '"Control".Flow_Meters.Ultrasonic."2".MinLimit',
        usfm_2_maxLimit: '"Control".Flow_Meters.Ultrasonic."2".MaxLimit',
        kgv_1_position: '"Control".Knife_Gate_Valve."1".Input',
        kgv_2_position: '"Control".Knife_Gate_Valve."2".Input',
        kgv_3_position: '"Control".Knife_Gate_Valve."3".Input',
        kgv_4_position: '"Control".Knife_Gate_Valve."4".Input',
        pt_1_minLimit: '"Control".PressureTransmitters."1".MinLimit',
        pt_1_maxLimit: '"Control".PressureTransmitters."1".MaxLimit',
        pt_2_minLimit: '"Control".PressureTransmitters."2".MinLimit',
        pt_2_maxLimit: '"Control".PressureTransmitters."2".MaxLimit',
        pt_3_minLimit: '"Control".PressureTransmitters."3".MinLimit',
        pt_3_maxLimit: '"Control".PressureTransmitters."3".MaxLimit',
        pt_4_minLimit: '"Control".PressureTransmitters."4".MinLimit',
        pt_4_maxLimit: '"Control".PressureTransmitters."4".MaxLimit',
        pt_5_minLimit: '"Control".PressureTransmitters."5".MinLimit',
        pt_5_maxLimit: '"Control".PressureTransmitters."5".MaxLimit',
        pt_6_minLimit: '"Control".PressureTransmitters."6".MinLimit',
        pt_6_maxLimit: '"Control".PressureTransmitters."6".MaxLimit',
        pt_7_minLimit: '"Control".PressureTransmitters."7".MinLimit',
        pt_7_maxLimit: '"Control".PressureTransmitters."7".MaxLimit',
        pt_8_minLimit: '"Control".PressureTransmitters."8".MinLimit',
        pt_8_maxLimit: '"Control".PressureTransmitters."8".MaxLimit',
        pt_9_minLimit: '"Control".PressureTransmitters."9".MinLimit',
        pt_9_maxLimit: '"Control".PressureTransmitters."9".MaxLimit',
        pt_10_minLimit: '"Control".PressureTransmitters."10".MinLimit',
        pt_10_maxLimit: '"Control".PressureTransmitters."10".MaxLimit'
    };

    //Auto login
    var spost = 'Redirection='+'&Login='+plcUserId+'&Password='+plcPassword;
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


    isProcess = false;
    window.onbeforeunload = function (){
        if (isProcess) {
            systemLog('Tab close button clicked! Requested to process stop!');
            emergencyHit();
            return true;
        }
        else {
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

//updateCurrentSystemStatus(statusVal);

bindButtons();

   // disableManualElements(true);

};
////////////////////////////////// External Function


function gTest() {
    alert();
}

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
    $("#btn-motor-freq").click(setMotorFrequency);
    $("#btn-motor-param").click(setMotorParameter);
    $("#btn-quit").click(function () {
        window.close();
    });
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

var setMotorFrequency = function () {
    systemLog('Execution started to set motor frequency!');
    it_modal_loading();
    $.get('data.html', function (response) {
        systemLog('Motor frequency setup dialog opened!');
        var body = '<input type="number" class="form-control no-radius" id="set-vsd-freq" min="10" max="50" value="'+response.vfd_frequency+'">';
        it_modal_open('Set VFD Frequency!', body, 'red', '300px', 'Set, Cancel', function (res) {
            if (res === 'Cancel') {
                systemLog('Motor frequency setup dialog closed!');
                it_modal_close();
            } else if (res === 'Set') {
                systemLog('Requested to set motor frequency!');
                it_modal_loading();
                $.get('data.html?'+plcTag.vfd_frequency+'='+$('#set-vsd-freq').val(), function (ret) {
                    updateCurrentSystemStatus(ret);
                    systemLog('Motor frequency setup successful!');
                    it_modal_close();
                }, 'json').fail(function () {
                    systemLog('Motor frequency setup failed! PLC is not responding...');
                    alert('Action Failed!');
                });
            }
        });
    }, 'json').fail(function () {
        systemLog('Failed to open motor frequency setup Dialog! PLC is not responding!');
        alert('Request failed!')
    });
};

var setMotorParameter = function () {
    systemLog('Set motor parameter execution started!');
    it_modal_loading();
    $.get('data.html', function (response) {
        systemLog('Set motor parameter dialog opened!');
        var body = '<label for="set-motor-current">Motor Current (A):</label><br><input type="number" class="form-control no-radius" id="set-motor-current" value="'+response.vfd_current_max/1.5+'">'+
        '<label for="set-motor-power">Motor Power (Kw):</label><br><input type="number" class="form-control no-radius" id="set-motor-power" value="'+response.vfd_power_max/2+'">';

        it_modal_open('Set Motor Parameter!', body, 'dodgerblue', '400px', 'Set, Cancel', function (res) {
            if (res === 'Cancel') {
                systemLog('Motor parameter dialog closed!');
                it_modal_close();
            } else if (res === 'Set') {
                systemLog('Requested to save motor parameter!');
                it_modal_loading();
                $.get('data.html?'+plcTag.vfd_power_max+'='+$('#set-motor-power').val()*2+'&'+plcTag.vfd_current_max+'='+$('#set-motor-current').val()*1.5, function (ret) {
                    updateCurrentSystemStatus(ret);
                    systemLog('Motor parameter saved successfully!');
                    it_modal_close();
                }, 'json').fail(function () {
                    systemLog('Saving motor parameter failed! PLC is not responding!');
                    alert('Action Failed!');
                });
            }
        });
    }, 'json').fail(function () {
        alert('Request failed!')
    });
};

var plcLimitSettings = function () {
    it_modal_loading();
    systemLog('Execution progress started to view limit settings dialog!');
    $.get('limit.html', function (res) {
        systemLog('Limit settings window has been opened!');

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

                systemLog('In limit settings dialog "Save" button clicked!');

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

                $.post('limit.html',encodeURI(plcRequest), function (r) {
                    systemLog('Limit saved 50%!');
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

                    $.post('limit.html', encodeURI(plcRequest), function (rs) {
                        systemLog('Limit saved 100%!');
                        it_modal_close();
                    },'json').fail(function () {
                        systemLog('Limit value saving failed at secondary step!');
                        alert('PLC server is not responding at secondary step.')
                    });

                },'json').fail(function () {
                    systemLog('Limit value saving failed at primary step!');
                    alert('PLC server is not responding at primary step.');
                });

            } else if (br == 'Close') {
                systemLog('Limit settings dialog closed!');
                it_modal_close();
            }
        });

    }, 'json').fail(function () {
        systemLog('Failed to open limit settings dialog!');
        alert('PLC communication failure.');
    });
};

var startProcessHit = function () {
    if ($("#valveLowerLimit").val() < $("#valveUpperLimit").val() - 9) {
        requestProgress('start');
        systemLog('"Start process" button clicked!');

        hideElementById('cb-start-process', true);
        disableControllerElements(true);

        var requestData = '';

        $.get('data.html?'+requestData, function (res) {
            requestProgress('end');
            systemLog('Process has been started!');
            isProcess = true;

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
            systemLog('Process startup failure! PLC is not responding...')
            requestProgress('stop');
            hideElementById('cb-start-process', false);
            disableControllerElements(false);
            alert('PLC is not responding!');
        });
    } else {
        it_modal_warning("Valve lower limit should be less then valve upper limit<br>with the minimum difference of 10%");
    }
};

var takeDataHit = function () {

    if (processInfo.mode === 'Manual') {
        if (dataTakePermission) {
            dataTakePermission = false;
            updateDataAndView(statusHold);
            systemLog('Data taken manually!');
        } else {
            it_modal_info('Already taken this data!');
            systemLog('Attempted to take data but already exists!');
        }

    } else if (processInfo.mode === 'Automatic') {
        // Auto process start
        hideElementById('cb-take-data', true);
        autoMotorOn(function () {
            //alert('motor');
            var autoValveLowerLimit = parseInt($('#valveLowerLimit').val());
            var autoValveUpperLimit = parseInt($('#valveUpperLimit').val());
            var dataTobeTaken = parseInt($('#numberOfObs').val());
            var effectivePosition = autoValveUpperLimit;



            autoValvePositions = [];
            autoValvePositions.push(autoValveUpperLimit);

            var segmentsValue = (effectivePosition-autoValveLowerLimit)/(dataTobeTaken-1);
            console.log(segmentsValue);
            //var i = 0;
            for (var i=autoValveLowerLimit; i<effectivePosition; i=i+segmentsValue) {
                autoValvePositions.push(i);
            }
            //autoValvePositions.push(100);

            autoValvePositions = arrayToFixed(autoValvePositions, 2);

            console.log(autoValvePositions);

            runAutoProcess();
        });

        // Auto process end
    } else {
        it_modal_info('Something going absurd!');
        systemLog('Process is not either automatic or manual selected!');
    }

};

var emergencyHit = function () {
    requestProgress('start');
    systemLog('"Stop precess" triggered!');

    hideElementById('cb-emergency', true);
    hideElementById('cb-take-data', true);
    disableManualElements(true);

    autoValvePositionIndex = 0;
    autoProcessTimeCounter = 0;
    if (typeof autoProcessTimeout !== 'undefined'){
        clearTimeout(autoProcessTimeout);
    }
    if (typeof autoUpdateTimeout !== 'undefined'){
        clearTimeout(autoUpdateTimeout);
    }
    if (typeof autoProcessStarterTimeout !== 'undefined'){
        clearTimeout(autoProcessStarterTimeout);
    }

    $.get('data.html?'+plcTag.vfd_stop+'=1', function (result) {
        requestProgress('end');
        systemLog('Precess has been stopped!');
        isProcess = false;

        processInfo.status = 'Stopped';
        processInfo.motorStatus = 'Stopped';
        processInfo.mode = 'undefined';

        hideElementById('cb-start-process', false);
        disableControllerElements(false);
        updateCurrentSystemStatus(result);
        handleData();
        // second request
        requestProgress('start');
        systemLog('Secondary "Stop precess" triggered!');
        $.get('data.html?'+plcTag.vfd_stop+'=1', function (ret) {
            requestProgress('end');
            systemLog('Secondary Emergency request has been delivered to PLC!');
        }, 'json').fail(function () {
            systemLog('PLC is not responding! Secondary "Stop process" failure!');
            requestProgress('stop');
        });
    }, 'json').fail(function () {
        systemLog('PLC is not responding! "Stop process" failure!');
        requestProgress('stop');
        hideElementById('cb-emergency', false);
        hideElementById('cb-take-data', false);
        disableManualElements(false);
    });
};

var setManualValvePosition = function () {
    hideElementById('setManualValvePosition', true);

    requestProgress('start');
    systemLog('Set valve position button pressed!');

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
            systemLog('Valve position set to '+manualValvePosition+'% by manual action!');
            updateCurrentSystemStatus(res);
        }, 'json')
        .fail(function () {
            requestProgress('stop');
            systemLog('Valve position setup failure! PLC is not responding!');
            hideElementById('setManualValvePosition', false);
            //alert('PLC is not responding the request!');
        });
};

var manualMotorOn = function () {
    hideElementById('mib-motor-on', true);

    requestProgress('start');
    systemLog('"Motor On" button clicked!');

    var reqData = plcTag.vfd_start+'=1';

    $.get('data.html?'+reqData, function (res) {
        processInfo.motorStatus = 'Running';
        hideElementById('mib-motor-off', false);
        requestProgress('end');
        systemLog('"Motor On" success! Request delivered to PLC...');
        updateCurrentSystemStatus(res);
    }, 'json').fail(function () {
        requestProgress('stop');
        systemLog('"Motor On" Failed! PLC is not responding...');
        hideElementById('mib-motor-on', false);
        alert('PLC is not responding the request!');
    });
};

var manualMotorOff = function () {
    hideElementById('mib-motor-off', true);

    requestProgress('start');
    systemLog('"Motor Off" button clicked!');

    var reqData = plcTag.vfd_stop+'=1';

    $.get('data.html?'+reqData, function (res) {
        processInfo.motorStatus = 'Stopped';
        hideElementById('mib-motor-on', false);
        requestProgress('end');
        systemLog('"Motor Off" Success! Request delivered to PLC...');
        updateCurrentSystemStatus(res);
    }, 'json').fail(function () {
        requestProgress('stop');
        systemLog('"Motor Off" Failed! PLC is not responding...');
        hideElementById('mib-motor-off', false);
        alert('PLC is not responding the request!');
    });
};

var manualUpdateStatus = function () {
    hideElementById('mib-take-status', true);

    requestProgress('start');
    systemLog('"Update status" requested manually!');

    $
        .get('data.html', function (res) {
            hideElementById('mib-take-status', false);
            updateCurrentSystemStatus(res);
            requestProgress('end');
            systemLog('Status has been updated manually!');
        }, 'json')
        .fail(function () {
            hideElementById('mib-take-status', false);
            requestProgress('stop');
            systemLog('Update status failure! PLC is not responding...');
        });
};

function arrayToFixed(array, fixedPlaces) {
    var newArray = [];
    array.forEach(function (val) {
        newArray.push(val.toFixed(fixedPlaces));
    });

    return newArray;
}

function autoMotorOn(callback) {
    requestProgress('start');
    systemLog('"Motor On" by auto process!');

    var reqData = plcTag.vfd_start+'=1';

    $.get('data.html?'+reqData, function (res) {
        processInfo.motorStatus = 'Running';
        requestProgress('end');
        systemLog('"Motor On" success! Request delivered to PLC...');
        updateCurrentSystemStatus(res);
        requestProgress('start');
        $.get('data.html?'+reqData, function (rt) {
            requestProgress('end');
            updateCurrentSystemStatus(rt);
            callback();
        }, 'json').fail(function () {
            requestProgress('stop');
            systemLog('"Motor On" Failed at secondary state! PLC is not responding...');
        });
    }, 'json').fail(function () {
        requestProgress('stop');
        systemLog('"Motor On" Failed! PLC is not responding...');

        //alert('PLC is not responding the request!');
    });
}

function autoUpdateStatus(callback) {
    requestProgress('start');
    systemLog('"Update status" requested automatically!');

    $
        .get('data.html', function (res) {
            updateCurrentSystemStatus(res);
            requestProgress('end');
            systemLog("Auto Process status updated!");
            callback();
        }, 'json')
        .fail(function () {
            hideElementById('mib-take-status', false);
            requestProgress('stop');
            systemLog('Update status failure! PLC is not responding...');
        });
}

function setAutoValvePosition(valvePosition, callBack) {
    requestProgress('start');
    systemLog('Set valve position automatic command!');

    var reqData = '';

    if (pumpInfo.pipeDia === 3) {
        reqData = plcTag.kgv_1_position+'='+valvePosition;
    } else if (pumpInfo.pipeDia === 4) {
        reqData = plcTag.kgv_2_position+'='+valvePosition;
    } else if (pumpInfo.pipeDia === 6) {
        reqData = plcTag.kgv_3_position+'='+valvePosition;
    } else if (pumpInfo.pipeDia === 8) {
        reqData = plcTag.kgv_4_position+'='+valvePosition;
    }

    $
        .get('data.html?'+reqData, function (res) {
            requestProgress('end');
            systemLog('Valve position set to '+valvePosition+'% by automatic command!');
            updateCurrentSystemStatus(res);
            callBack();
        }, 'json')
        .fail(function () {
            requestProgress('stop');
            systemLog('Valve position setup failure! PLC is not responding!');
            //alert('PLC is not responding the request!');
        });
}

autoProcessUpdateTime = 3000;
autoProcessDataTakeTime = 40000;
autoProcessTimeCounter = 0;
autoValvePositionIndex = 0;
function runAutoProcess() {
    autoProcessTimeCounter = autoProcessTimeCounter + autoProcessUpdateTime;

    var limitIndexNumber = parseInt($('#numberOfObs').val());


    if (autoProcessTimeCounter >= autoProcessDataTakeTime) {
        autoProcessTimeCounter = 0;
        updateDataAndView(statusHold);
        if (autoValvePositionIndex !== 0) {
            //alert(autoValvePositionIndex+" !== 0");
            setAutoValvePosition(autoValvePositions[autoValvePositionIndex], function () {
                autoValvePositionIndex++;
                autoProcessTimeout = setTimeout(function () {
                    runAutoProcess();
                }, autoProcessUpdateTime);
            });
        }
    } else if (autoValvePositionIndex === 0) {
        setAutoValvePosition(autoValvePositions[autoValvePositionIndex], function () {
            autoValvePositionIndex++;
            autoProcessStarterTimeout = setTimeout(function () {
                runAutoProcess();
            }, autoProcessUpdateTime);
        });
    } else {
        autoUpdateStatus(function () {
            autoUpdateTimeout = setTimeout(function () {
                runAutoProcess();
            }, autoProcessUpdateTime);
        });
    }
}

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
            return rd.pt_2_output;
        } else if (Dia === 6) {
            return rd.pt_3_output;
        } else if (Dia === 8) {
            return rd.pt_4_output;
        }
    }
}

function targetDischargePressureOnTypeDia(rd, pumpType, Dia) {
    if (pumpType === 'Submersible Pump') {
        if (Dia === 4) {
            return rd.pt_9_output;
        } else if (Dia === 6) {
            return rd.pt_10_output;
        } else {
            return 0;
        }
    } else {
        if (Dia === 3) {
            return rd.pt_8_output;
        } else if (Dia === 4) {
            return rd.pt_7_output;
        } else if (Dia === 6) {
            return rd.pt_6_output;
        } else if (Dia === 8) {
            return rd.pt_5_output;
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
        return a.vo - b.vo;
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
        var htmlData = '<b>What do you want to do with the data?</b>';

        it_modal_open('Observation Complete!', htmlData, '#008800', 0, 'Save, Erase, Cancel', function (br) {
            if (br === 'Save') {
                it_modal_close();

                var authorHtml = '<label for="author-text-1">Author 1</label><br><textarea id="author-text-1" rows="6" style="width: 100%; resize: vertical;"></textarea>'+
                '<hr><label for="author-text-2">Author 2</label><br><textarea id="author-text-2" rows="6" style="width: 100%; resize: vertical;"></textarea>';


                it_modal_open('Author Info!', authorHtml, '#6358ff', '500px', 'Save', function (abtnr) {
                    if (abtnr === 'Save') {
                        it_modal_loading();
                        $.post(server+'w3apps/reportmodules/action.php', {
                            'for': 'report',
                            'command': 'update',
                            "atd": 'yes',
                            'data': {
                                'author': $('#author-text-1').val()+String.fromCharCode(13)+'<&>'+String.fromCharCode(13)+$('#author-text-2').val(),
                                'testData': JSON.stringify(mainData)
                            },
                            'request': it_hold_request()
                        }, function (ret) {
                            it_modal_close();
                            if (ret === '1') {
                                it_modal_open('Data save status!', "data Saved Successfully!", '#00ff00', 0, 'Okay', function () {
                                    window.close();
                                });
                            } else {
                                it_modal_open('Error!', "Something going wrong!");
                            }
                        });
                    }
                });
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
    if (res.Emergency === '1' && isProcess === true) {
        emergencyHit();
        systemLog('<<< Precess emergency stopped! >>>');
    }
    if (res.vfd_fault === '1' && isProcess === true) {
        emergencyHit();
        systemLog('<<<<< VFD fault present! >>>>>');
    }

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
    $("#status-flow-rate-m").html(parseFloat(sv.frm).toFixed(2));
    $("#status-flow-rate-u").html(parseFloat(sv.fru).toFixed(2));
    $("#status-next-vp").html(sv.nvp);
    $("#status-suction-pressure").html(parseFloat(sv.sp).toFixed(2));
    $("#status-discharge-pressure").html(parseFloat(sv.dp).toFixed(2));
    $("#status-motor").html(sv.motor);
    $("#status-freq").html(sv.freq);
    $("#status-rpm").html(sv.rpm);
    $("#status-power").html(parseFloat(sv.power).toFixed(2));
    $("#status-current").html(parseFloat(sv.current).toFixed(2));
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
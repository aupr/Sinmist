/**
 * Created by Aman Ullah on 1/29/2017.
 */
$server1200 = "http://192.168.10.5/awp/MIST/start.html"; //"http://localhost/mist/hptb/plc/start.html";

var reportLimit = 50;
printKeyword = "";
printType = "";
rawKey = "";
$(document).ready(function () {

    // Navigation Buttons Actions
    {
        $("#btn-origin").click(function () {
            window.location.replace("origin.php");
        });

        $("#btn-logout-report").click(function () {
            window.location.replace("logout.php");
        });

        $("#btn-settings").click(function () {
            it_modal_open();
        });

        $("#btn-set-formula").click(function () {
            $.post("reportmodules/ui/takeformula.php",{}, function (ret) {
                it_modal_open("Set Formula ...",ret,"dodgerblue","800px","Set, Cancel", function (bc) {
                    if (bc == "Cancel"){
                        it_modal_close();
                    }
                    else if(bc == "Set"){
                        it_modal_loading();
                        setFormula(function () {
                            it_modal_close();
                        });
                    }
                });
            });
        });

        $("#btn-toggle-fscr").click(function () {
            it_fullscreen_toggle();
        });
    }
    // Options Buttons Actions
    {
        // Create New modal Button
        $("#btn-create-model").click(function () {
            $.post("reportmodules/ui/createreport.php",{},function (res) {
                it_modal_open('<i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Job',res,"blueviolet","1000px","Create, Cancel", function (cr) {
                    if (cr == 'Create'){
                        it_modal_loading();
                        onClick(function () {
                            it_modal_close();
                            $("#btn-view-models").click();
                        });
                    }
                    else if(cr == 'Cancel'){
                        it_modal_close();
                    }
                });
            }).fail(function () {
                alert("Failed to load ui!!");
            });
        });

        //View report modal button
        $("#btn-view-models").click(function () {
            printType = "model";
            pagination('model', 1, reportLimit);
            $("#report-list-title").text("Pending Job List");
        });
// View completed report button
        $("#btn-view-reports").click(function () {
            printType = "report";
            pagination('report', 1, reportLimit);
            $("#report-list-title").text("Complete Job List");
        });

        // Print job list button
        $("#btn-print-job-list").click(function () {
            var win = window.open('printjoblist.php?t='+printType+'&rk='+encodeURIComponent(rawKey)+'&k='+encodeURIComponent(makeKeywords(printKeyword)),'_blank');
            win.focus();
        });

        
        //load report list at first time
        $.post("reportmodules/contents.php",{'type':"model", 'limitStart':1, 'limit':2},function (res) {
            if (res.data.length){
                $("#btn-view-models").click();
            } else {
                $("#btn-view-reports").click();
            }
        },"json").fail(function () {
            alert("Failed data communication!");
        });

        // Find button
        $("#find-btn").click(function () {
            var rkeyword = $("#find-keyword").val();
            keyword = it_input_filter(rkeyword);
            if (keyword.length < 2){
                it_modal_open("Invalid Key word !","Keyword should be at least two characters...","dodgerblue",0,"Got it !",function (ret) {
                    if (ret){
                        it_modal_close();
                    }
                });
            }
            else {
                //console.log(makeKeywords(keyword));
                printKeyword = keyword;
                rawKey = rkeyword;
                printType = 'find';
                pagination('find', 1, reportLimit, makeKeywords(keyword));
                $("#report-list-title").text("Report List - Search Result");
            }
        });
    }
    // Action Buttons Actions
    {
        // Delete report button
        $("#ac-btn-delete-report").click(function () {
            if(isSelected()){
                it_modal_open("Confirm!","Do you want to delete this job?","#d9534f",0,"Yes, No",function (res) {
                    if(res == 'Yes'){
                        it_modal_loading();
                        $.post("reportmodules/action.php",{"command":"delete","for":"report","id":selected.objectId}, function (res) {
                            it_modal_close();
                            if (selected.type == "model"){
                                $("#btn-view-models").click();
                            } else if (selected.type == "report"){
                                $("#btn-view-reports").click();
                            }
                        });
                    } else if (res == 'No'){
                        it_modal_close();
                    }
                });
            }
        });
        // Edit report button
        $("#ac-btn-edit-report").click(function () {
            if(isSelected()){
                $.post("reportmodules/ui/editreport.php",{"id":selected.objectId}, function (res) {
                    it_modal_open("Report Edit Form . . .",res,"#FF8800","1100px","Clone, Save, Cancel",function (ret) {

                        if(ret == 'Save'){
                            if (confirm("Do you want to save changes!")) {
                                it_modal_loading();
                                onSave(selected.objectId,function (ack, stat) {
                                    it_modal_close();
                                    if (stat) $("#btn-view-reports").click();
                                    else $("#btn-view-models").click();
                                });
                            }
                        } else if (ret == 'Cancel'){
                            if (confirm("Do you want to discard changes!")) {
                                it_modal_close();
                            }
                        } else if (ret === 'Clone') {
                            if(confirm("Do you want to clone this data for retest!")) {
                                onCopy(function () {
                                    it_modal_close();
                                    $("#btn-view-models").click();
                                });
                            }
                        }
                    });
                }).fail(function () {
                    alert("failed to load edit report ui")
                });
            }
        });
        // Take Data into report model
        $("#ac-btn-take-data-into-report").click(function () {
            if(isSelected()){
                it_modal_open("Confirm!","Do you want to start test?","#007E33",0,"Yes, No",function (res) {
                    if(res == 'Yes'){
                        it_modal_close();
                        if (selected.type == "report"){
                            it_modal_open("Confirm again !...","<b>All of the previous data will be lost!</b><br>Do you want to continue?","#d2b521","500px","Yes, No", function (hk) {
                                if (hk == "Yes"){
                                    it_modal_close();
                                    var win = window.open($server1200+'?id='+selected.objectId+'&type='+selected.type, '_blank');
                                    win.focus();
                                }
                                else{
                                    it_modal_close();
                                }
                            });
                        }
                        else {
                            var win = window.open($server1200+'?id='+selected.objectId+'&type='+selected.type, '_blank');
                            win.focus();
                        }
                    } else if (res == 'No'){
                        it_modal_close();
                    }
                });
            }
        });
        // View report into Modal
        $("#ac-btn-view-report-modal").click(function () {
            if(isSelected()){
                var body = '<div class="input-group" style="width: 340px; margin: 20px 20px;">' +
                    '<label class="input-group-addon no-radius" for="selectSensor">Select Sensor Type:</label>' +
                    '<select class="form-control no-radius" id="selectSensor"><option value="M">Magnetic</option>' +
                    '<option value="U">Ultrasonic</option></select></div>';
                if (selected.type == "report"){
                    it_modal_open("Choose Sensor ...",body,"dodgerblue","400px","Continue, Cancel", function (cbr) {
                        if (cbr == "Continue"){
                            $.post("reportmodules/ui/viewreport.php",{"id":selected.objectId, "sensor":$("#selectSensor").val(), "type":selected.type}, function (res) {
                                it_modal_open("Report View Form . . .",res,"#141414","1100px","Got it, Cancel",function (ret) {
                                    if(ret === 'Got it'){
                                        it_modal_close();
                                    } else if (ret === 'Cancel'){
                                        it_modal_close();
                                    }
                                });
                            }).fail(function () {
                                alert("failed to load view report ui");
                            });
                        }
                        else if(cbr == "Cancel"){
                            it_modal_close();
                        }
                    });
                }
                else {
                    $.post("reportmodules/ui/viewreport.php",{"id":selected.objectId, "sensor":$("#selectSensor").val(), "type":selected.type}, function (res) {
                        it_modal_open("Report View Form . . .",res,"#0099CC","1100px","Cancel",function (ret) {
                            if(ret == 'Save'){
                                it_modal_loading();
                                onSave(selected.objectId,function (ack, stat) {
                                    it_modal_close();
                                    if (stat) $("#btn-view-reports").click();
                                    else $("#btn-view-models").click();
                                });
                            } else if (ret == 'Cancel'){
                                it_modal_close();
                            }
                        });
                    }).fail(function () {
                        alert("failed to load view report ui");
                    });
                }

            }
        });
        // Make report page
        $("#ac-btn-make-report-page").click(function () {
            if(selected.type === "report"){
                if(isSelected()){
                    var body = '<div class="input-group" style="width: 340px; margin: 20px 20px;">' +
                        '<label class="input-group-addon no-radius" for="selectSensor">Select Sensor Type:</label>' +
                        '<select class="form-control no-radius" id="selectSensor"><option value="M">Magnetic</option>' +
                        '<option value="U">Ultrasonic</option></select></div>';
                    it_modal_open("Choose Sensor ...",body,"dodgerblue","400px","Continue, Cancel", function (cbr) {
                        if (cbr == "Continue"){
                            var win = window.open('reportpage.php?id='+selected.objectId+'&sensor='+$("#selectSensor").val(), '_blank');
                            win.focus();
                            it_modal_close();
                        }
                        else if(cbr == "Cancel"){
                            it_modal_close();
                        }
                    });
                }
            } else {
                it_modal_error("It's not applicable for uncompleted report !");
            }
        });

        // Make Receipt
        $("#ac-btn-make-receipt-page").click(function(){
            if(isSelected()){
                var body = '<label for="receipt-aditm">Additional Item(s):</label><br><input type="text" id="receipt-aditm" class="form-control no-radius">' +
                    '<br><label for="receipt-author">Received By:</label><br><input type="text" id="receipt-author" class="form-control no-radius">' +
                    '<br><label for="author-designation">Rank:</label><br><input type="text" id="author-designation" class="form-control no-radius">';
                it_modal_open("Additional Info.", body, 'black',"400px", "Ok, Cancel", function (r) {
                    if (r === 'Ok') {
                        var win = window.open('receipt.php?id='+selected.objectId+'&ai='+$('#receipt-aditm').val()+'&n='+$('#receipt-author').val()+'&d='+$('#author-designation').val(), '_blank');
                        win.focus();
                        it_modal_close();
                    } else if (r === 'Cancel') {
                        it_modal_close();
                    }
                });
            }
        });

        // Make GatePass
        $("#ac-btn-make-gatepass-page").click(function(){
            if(isSelected()){
                var body = '<label for="receipt-aditm">Additional Item(s):</label><br><input type="text" id="receipt-aditm" class="form-control no-radius">' +
                    '<br><label for="receipt-author">Authorized By:</label><br><input type="text" id="receipt-author" class="form-control no-radius">' +
                    '<br><label for="author-designation">Rank:</label><br><input type="text" id="author-designation" class="form-control no-radius">';
                it_modal_open("Additional Info.", body, 'black',"400px", "Ok, Cancel", function (r) {
                    if (r === 'Ok') {
                        var win = window.open('gatepass.php?id='+selected.objectId+'&ai='+$('#receipt-aditm').val()+'&n='+$('#receipt-author').val()+'&d='+$('#author-designation').val(), '_blank');
                        win.focus();
                        it_modal_close();
                    } else if (r === 'Cancel') {
                        it_modal_close();
                    }
                });
            }
        });
    }
    // search enter key press detector
    $("#find-keyword").keypress(function (e) {
        if ((e.keyboard == 13) || (e.which == 13) ){
            $("#find-btn").click();
        }
    });
});

var selected = {
    elementId: 0,
    objectId: 0,
    type: ""
};
function selectThis(elementId, objectId) {
    $(selected.elementId).css({
        "background-color":"initial",
        "color":"#333"
    });
    $(elementId).css({
        "background-color":"#a2a2a2",
        "color":"white"
    });
    selected.elementId = elementId;
    selected.objectId = objectId;
}
function isSelected() {
    if(selected.objectId !== 0){
        return true;
    } else {
        it_modal_warning("Please select a report element first!");
        return false;
    }
}
function setContentTable(type, limitStart, limit, keywords, callback) {
    if (type == 'model'){
        var fn = $.post("reportmodules/contents.php",{'type':type, 'limitStart':limitStart, 'limit':limit},function (res) {
            var tblPrint = '<table class="table table-bordered"><thead><tr><th>Received dt</th><th>ME Ref.</th>' +
                '<th>Client</th><th>Supplier</th><th>Pump Type</th><th>Diameter</th><th>Pump-SN</th><th>Motor-SN</th></tr></thead><tbody>';
            res.data.forEach(function (rv) {
                tblPrint += '<tr onclick="selectThis(this, '+rv.id+')"><td>'+rv.rDt+'</td><td>'+rv.meRef+'</td><td>'+rv.client+'</td>' +
                    '<td>'+rv.supplier+'</td><td>'+rv.pumpType+'</td><td>'+rv.pipeDia+'</td><td>'+rv.pumpSn+'</td><td>'+rv.motorSn+'</td></tr>';
            });
            tblPrint += '</tbody></table>';
            selected.type = type;
            $("#reportContainer").html(tblPrint);
            callback(res.totalData);
        },"json");
        fn.fail(function () {
            alert("Failed to data load !");
        });
    }
    else if (type == 'report'){
        var fnr = $.post("reportmodules/contents.php",{'type':type, 'limitStart':limitStart, 'limit':limit},function (res) {
            var tblPrint = '<table class="table table-bordered"><thead><tr><th>Received dt</th><th>Test dt & time</th><th>ME Ref.</th>' +
                '<th>Client</th><th>Supplier</th><th>Pump Type</th><th>Diameter</th><th>Pump-SN</th><th>Motor-SN</th></tr></thead><tbody>';
            res.data.forEach(function (rv) {
                tblPrint += '<tr onclick="selectThis(this, '+rv.id+')"><td>'+rv.rDt+'</td><td>'+rv.tDtTm+'</td><td>'+rv.meRef+'</td><td>'+rv.client+'</td>' +
                    '<td>'+rv.supplier+'</td><td>'+rv.pumpType+'</td><td>'+rv.pipeDia+'</td><td>'+rv.pumpSn+'</td><td>'+rv.motorSn+'</td></tr>';
            });
            tblPrint += '</tbody></table>';
            selected.type = type;
            $("#reportContainer").html(tblPrint);
            callback(res.totalData);
        },"json");
        fnr.fail(function () {
            alert("Failed to data load !");
        });
    }
    else if (type == 'find') {

        var fnf = $.post("reportmodules/contents.php", {'type':type, 'limitStart':limitStart, 'limit':limit, 'keywords':keywords}, function (res) {
            var tblPrint = '<table class="table table-bordered"><thead><tr><th>Received dt</th><th>Test dt & time</th><th>ME Ref.</th>' +
                '<th>Client</th><th>Supplier</th><th>Pump Type</th><th>Diameter</th><th>Pump-SN</th><th>Motor-SN</th></tr></thead><tbody>';
            res.data.forEach(function (rv) {
                tblPrint += '<tr onclick="selectThis(this, '+rv.id+')"><td>'+rv.rDt+'</td><td>'+rv.tDtTm+'</td><td>'+rv.meRef+'</td><td>'+rv.client+'</td>' +
                    '<td>'+rv.supplier+'</td><td>'+rv.pumpType+'</td><td>'+rv.pipeDia+'</td><td>'+rv.pumpSn+'</td><td>'+rv.motorSn+'</td></tr>';
            });
            tblPrint += '</tbody></table>';
            selected.type = type;
            $("#reportContainer").html(tblPrint);
            callback(res.totalData);
        },"json");
        fnf.fail(function () {
            alert("Failed to data load !");
        });
    }
    selected.elementId = 0;
    selected.objectId = 0;
}
function pagination(type, limitStart, limit, keywords) {
    setContentTable(type, limitStart, limit, keywords, function (totalData) {
        var report_prev_btn = $("#report-previous-page");
        var report_next_btn = $("#report-next-page");
        var lastLimitVal = ((limitStart+limit-1)>=totalData)?totalData:(limitStart+limit-1);
        $("#report-page-info").text(limitStart+"-"+lastLimitVal+" of "+totalData);
        if (limitStart == 1){
            report_prev_btn.hide();
        } else {
            report_prev_btn.show();
        }
        if ((limitStart+limit-1) >= totalData){
            report_next_btn.hide();
        } else {
            report_next_btn.show();
        }
        report_prev_btn.unbind('click');
        report_prev_btn.click(function () {
            pagination(type, limitStart-limit, limit, keywords);
        });
        report_next_btn.unbind('click');
        report_next_btn.click(function () {
            pagination(type, limitStart+limit, limit, keywords);
        });
    });
}
function makeKeywords(key) {
    keys = key.split("&amp;", 3);
    //console.log(keys);
    var syntext0 = " LIKE '%"+keys[0].trim()+"%'";
    var syntext1 = "";
    if (typeof keys[1] !== 'undefined') syntext1 = " LIKE '%"+keys[1].trim()+"%'";
    var syntext2 = "";
    if (typeof  keys[2] !== 'undefined') syntext2 = " LIKE '%"+keys[2].trim()+"%'";
    var isAnyChecked = false;
    var keywords0 = "(";
    var keywords1 = "(";
    var keywords2 = "(";
    if($("#ckbx-rcvd-date").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else {
            keywords0 += " or ";
            keywords1 += " or ";
            keywords2 += " or ";
        }
        keywords0 += "rDt"+syntext0;
        keywords1 += "rDt"+syntext1;
        keywords2 += "rDt"+syntext2;
    }
    if($("#ckbx-tst-date").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else {
            keywords0 += " or ";
            keywords1 += " or ";
            keywords2 += " or ";
        }
        keywords0 += "tDtTm"+syntext0;
        keywords1 += "tDtTm"+syntext1;
        keywords2 += "tDtTm"+syntext2;
    }
    if($("#ckbx-client").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else {
            keywords0 += " or ";
            keywords1 += " or ";
            keywords2 += " or ";
        }
        keywords0 += "client"+syntext0;
        keywords1 += "client"+syntext1;
        keywords2 += "client"+syntext2;
    }
    if($("#ckbx-supplier").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else {
            keywords0 += " or ";
            keywords1 += " or ";
            keywords2 += " or ";
        }
        keywords0 += "supplier"+syntext0;
        keywords1 += "supplier"+syntext1;
        keywords2 += "supplier"+syntext2;
    }
    if($("#ckbx-me-ref").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else {
            keywords0 += " or ";
            keywords1 += " or ";
            keywords2 += " or ";
        }
        keywords0 += "meRef"+syntext0;
        keywords1 += "meRef"+syntext1;
        keywords2 += "meRef"+syntext2;
    }
    if($("#ckbx-pump-type").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else {
            keywords0 += " or ";
            keywords1 += " or ";
            keywords2 += " or ";
        }
        keywords0 += "pumpType"+syntext0;
        keywords1 += "pumpType"+syntext1;
        keywords2 += "pumpType"+syntext2;
    }
    if($("#ckbx-pump-sn").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else {
            keywords0 += " or ";
            keywords1 += " or ";
            keywords2 += " or ";
        }
        keywords0 += "pumpSn"+syntext0;
        keywords1 += "pumpSn"+syntext1;
        keywords2 += "pumpSn"+syntext2;
    }
    if($("#ckbx-motor-sn").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else {
            keywords0 += " or ";
            keywords1 += " or ";
            keywords2 += " or ";
        }
        keywords0 += "motorSn"+syntext0;
        keywords1 += "motorSn"+syntext1;
        keywords2 += "motorSn"+syntext2;
    }

    if (isAnyChecked){
        keywords0 += ")";
        keywords1 += ")";
        keywords2 += ")";
    } else {
        keywords0 = "(rDt"+syntext0+
            " or tDtTm"+syntext0+
            " or client"+syntext0+
            " or supplier"+syntext0+
            " or meRef"+syntext0+
            " or pumpType"+syntext0+
            " or pumpSn"+syntext0+
            " or motorSn"+syntext0+
            ")";

        keywords1 = "(rDt"+syntext1+
            " or tDtTm"+syntext1+
            " or client"+syntext1+
            " or supplier"+syntext1+
            " or meRef"+syntext1+
            " or pumpType"+syntext1+
            " or pumpSn"+syntext1+
            " or motorSn"+syntext1+
            ")";

        keywords2 = "(rDt"+syntext2+
            " or tDtTm"+syntext2+
            " or client"+syntext2+
            " or supplier"+syntext2+
            " or meRef"+syntext2+
            " or pumpType"+syntext2+
            " or pumpSn"+syntext2+
            " or motorSn"+syntext2+
            ")";
    }

    var keywords = keywords0;

    if (typeof (keys[1]) !== 'undefined') {
        keywords += " and ";
        keywords += keywords1;
    }

    if (typeof (keys[2]) !== 'undefined') {
        keywords += " and ";
        keywords += keywords2;
    }

    var cbur = $("#ckbx-uncompleted-report").prop( "checked" );
    var cbcr = $("#ckbx-completed-report").prop( "checked" );
    if (cbur != cbcr){
        if (cbur) keywords += " and testData=''";
        else keywords += " and testData!=''";
    }

    return keywords;
}









/**
 * Created by Aman Ullah on 1/29/2017.
 */
var reportLimit = 50;
$(document).ready(function () {

    // Navigation Buttons Actions
    {
        $("#btn-origin").click(function () {
            window.location.replace("origin.php");
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
                it_modal_open('<i class="fa fa-plus-square-o" aria-hidden="true"></i> Create a new report...',res,"blueviolet","1000px","Create, Cancel", function (cr) {
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
            pagination('model', 1, reportLimit);
            $("#report-list-title").text("Uncompleted Report List");
        }).click();

        // View completed report button
        $("#btn-view-reports").click(function () {
            pagination('report', 1, reportLimit);
            $("#report-list-title").text("Completed Report List");
        });

        // Find button
        $("#find-btn").click(function () {
            var keyword = $("#find-keyword").val();
            keyword = it_input_filter(keyword);
            if (keyword.length < 2){
                it_modal_open("Invalid Key word !","Keyword should be at least two characters...","dodgerblue",0,"Got it !",function (ret) {
                    if (ret){
                        it_modal_close();
                    }
                });
            }
            else {
                //console.log(makeKeywords(keyword));
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
                it_modal_open("Confirm !","Do you want to delete this?","#d9534f",0,"Yes, No",function (res) {
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
                    it_modal_open("Report Edit Form . . .",res,"#FF8800","1100px","Save, Cancel",function (ret) {
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
                    alert("failed to load edit report ui")
                });
            }
        });
        // Take Data into report model
        $("#ac-btn-take-data-into-report").click(function () {
            if(isSelected()){
                it_modal_open("Confirm !","Do you want to take data onto ths report?","#007E33",0,"Yes, No",function (res) {
                    if(res == 'Yes'){
                        alert("Transfer to data taking window");
                    } else if (res == 'No'){
                        it_modal_close();
                    }
                });
            }
        });
        // View report into Modal
        $("#ac-btn-view-report-modal").click(function () {
            if(isSelected()){
                $.post("reportmodules/ui/viewreport.php",{"id":selected.objectId}, function (res) {
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
                    alert("failed to load view report ui")
                });
            }
        });
        // Make report page
        $("#ac-btn-make-report-page").click(function () {
            if(selected.type === "report"){
                if(isSelected()){
                    var win = window.open('reportpage.php?id='+selected.objectId+'&sensor=U', '_blank');
                    win.focus();
                }
            } else {
                it_modal_error("It's not applicable for uncompleted report !");
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
                '<th>Client</th><th>Supplier</th><th>Pump Type</th><th>Pump-SN</th><th>Motor-SN</th></tr></thead><tbody>';
            res.data.forEach(function (rv) {
                tblPrint += '<tr onclick="selectThis(this, '+rv.id+')"><td>'+rv.rDt+'</td><td>'+rv.meRef+'</td><td>'+rv.client+'</td>' +
                    '<td>'+rv.supplier+'</td><td>'+rv.pumpType+'</td><td>'+rv.pumpSn+'</td><td>'+rv.motorSn+'</td></tr>';
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
                '<th>Client</th><th>Supplier</th><th>Pump Type</th><th>Pump-SN</th><th>Motor-SN</th></tr></thead><tbody>';
            res.data.forEach(function (rv) {
                tblPrint += '<tr onclick="selectThis(this, '+rv.id+')"><td>'+rv.rDt+'</td><td>'+rv.tDtTm+'</td><td>'+rv.meRef+'</td><td>'+rv.client+'</td>' +
                    '<td>'+rv.supplier+'</td><td>'+rv.pumpType+'</td><td>'+rv.pumpSn+'</td><td>'+rv.motorSn+'</td></tr>';
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
                '<th>Client</th><th>Supplier</th><th>Pump Type</th><th>Pump-SN</th><th>Motor-SN</th></tr></thead><tbody>';
            res.data.forEach(function (rv) {
                tblPrint += '<tr onclick="selectThis(this, '+rv.id+')"><td>'+rv.rDt+'</td><td>'+rv.tDtTm+'</td><td>'+rv.meRef+'</td><td>'+rv.client+'</td>' +
                    '<td>'+rv.supplier+'</td><td>'+rv.pumpType+'</td><td>'+rv.pumpSn+'</td><td>'+rv.motorSn+'</td></tr>';
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
    var syntext = " LIKE '%"+key+"%'";
    var isAnyChecked = false;
    var keywords = "(";
    if($("#ckbx-rcvd-date").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else keywords += " or ";
        keywords += "rDt"+syntext;
    }
    if($("#ckbx-tst-date").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else keywords += " or ";
        keywords += "tDtTm"+syntext;
    }
    if($("#ckbx-client").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else keywords += " or ";
        keywords += "client"+syntext;
    }
    if($("#ckbx-supplier").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else keywords += " or ";
        keywords += "supplier"+syntext;
    }
    if($("#ckbx-me-ref").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else keywords += " or ";
        keywords += "meRef"+syntext;
    }
    if($("#ckbx-pump-type").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else keywords += " or ";
        keywords += "pumpType"+syntext;
    }
    if($("#ckbx-pump-sn").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else keywords += " or ";
        keywords += "pumpSn"+syntext;
    }
    if($("#ckbx-motor-sn").prop( "checked" )){
        if (!isAnyChecked) isAnyChecked = true;
        else keywords += " or ";
        keywords += "motorSn"+syntext;
    }

    if (isAnyChecked){
        keywords += ")";
    } else {
        keywords = "(rDt"+syntext+
            " or tDtTm"+syntext+
            " or client"+syntext+
            " or supplier"+syntext+
            " or meRef"+syntext+
            " or pumpType"+syntext+
            " or pumpSn"+syntext+
            " or motorSn"+syntext+
            ")";
    }

    var cbur = $("#ckbx-uncompleted-report").prop( "checked" );
    var cbcr = $("#ckbx-completed-report").prop( "checked" );
    if (cbur != cbcr){
        if (cbur) keywords += " and testData=''";
        else keywords += " and testData!=''";
    }

    return keywords;
}









<?php
require '../../dbcom/connect.php';
require '../../dbcom/dbread.php';
$dbr = new dbread();
$res = $dbr->getReport($_POST['id']);
$testData = json_decode($res['data']['testData']);
$editReportDnT = explode('@',$res['data']['tDtTm']);
?>
<div id="edit_tabs">
    <ul>
        <li><a href="#etabs-info">Report Information</a></li>
        <li><a href="#etabs-data">Test Data</a></li>
        <li><a href="#etabs-author">Author</a></li>
    </ul>
    <div id="etabs-info">
        <div class="reportInfo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td><label for="nm-rcvd-dt">Received Date</label></td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control no-radius" id="nm-rcvd-dt" value="<?=$res['data']['rDt']?>">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nm-client">Client</label></td>
                                <td>:</td>
                                <td><input type="text" class="form-control no-radius" id="nm-client" value="<?=$res['data']['client']?>"></td>
                            </tr>
                            <tr>
                                <td><label for="nm-clients-ref">Client's Reference</label></td>
                                <td>:</td>
                                <td><input type="text" class="form-control no-radius" id="nm-clients-ref" value="<?=$res['data']['clientRef']?>"></td>
                            </tr>
                            <tr>
                                <td><label for="nm-me-ref">Dept. Reference</label></td>
                                <td>:</td>
                                <td><input type="text" class="form-control no-radius" id="nm-me-ref" value="<?=$res['data']['meRef']?>"></td>
                            </tr>
                            <tr>
                                <td><label for="nm-pump-type">Pump Type</label></td>
                                <td>:</td>
                                <td>
                                    <select class="form-control no-radius" id="nm-pump-type">
                                        <option value="Centrifugal Pump" <?=($res['data']['pumpType']=="Centrifugal Pump")?"selected":""?>>Centrifugal Pump</option>
                                        <option value="Submersible Pump" <?=($res['data']['pumpType']=="Submersible Pump")?"selected":""?>>Submersible Pump</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nm-pump-discharge">Discharge</label></td>
                                <td>:</td>
                                <td class="input-group">
                                    <input type="text" class="form-control no-radius" id="nm-pump-discharge" value="<?=$res['data']['discharge']?>">
                                    <div class="input-group-addon no-radius">m<sup>3</sup> / hr</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nm-pump-sn">Pump SN</label></td>
                                <td>:</td>
                                <td><input type="text" class="form-control no-radius" id="nm-pump-sn" value="<?=$res['data']['pumpSn']?>"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td><label for="nm-test-dt-tm">Test Dt & Tm</label></td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control no-radius" id="nm-test-dt-tm" value="<?=$res['data']['tDtTm']?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nm-supplier">Supplier</label></td>
                                <td>:</td>
                                <td><input type="text" class="form-control no-radius" id="nm-supplier" value="<?=$res['data']['supplier']?>"></td>
                            </tr>
                            <tr>
                                <td><label for="nm-clients-ref-date">CR Date</label></td>
                                <td>:</td>
                                <td><input type="text" class="form-control no-radius" id="nm-clients-ref-date" value="<?=$res['data']['crDt']?>"></td>
                            </tr>
                            <tr>
                                <td><label for="nm-me-ref-date">MR Date</label></td>
                                <td>:</td>
                                <td><input type="text" class="form-control no-radius" id="nm-me-ref-date" value="<?=$res['data']['mrDt']?>"></td>
                            </tr>
                            <tr>
                                <td><label for="nm-pipe-dia">Pipe Diameter</label></td>
                                <td>:</td>
                                <td>
                                    <select class="form-control no-radius" id="nm-pipe-dia">
                                        <option value="3" <?=($res['data']['pipeDia']==3)?"selected":""?>>3 Inch</option>
                                        <option value="4" <?=($res['data']['pipeDia']==4)?"selected":""?>>4 Inch</option>
                                        <option value="6" <?=($res['data']['pipeDia']==6)?"selected":""?>>6 Inch</option>
                                        <option value="8" <?=($res['data']['pipeDia']==8)?"selected":""?>>8 Inch</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nm-pump-head">Head</label></td>
                                <td>:</td>
                                <td class="input-group">
                                    <input type="text" class="form-control no-radius" id="nm-pump-head" value="<?=$res['data']['head']?>">
                                    <div class="input-group-addon no-radius">m</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nm-motor-sn">Motor SN</label></td>
                                <td>:</td>
                                <td><input type="text" class="form-control no-radius" id="nm-motor-sn" value="<?=$res['data']['motorSn']?>"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="etabs-data">
        <table class="table table-bordered" id="dynamic-data-table">
            <thead>
            <tr>
                <th>SL</th>
                <th>Valve open</th>
                <th>Suction P.</th>
                <th>Discharge P.</th>
                <th>Flow Rate M</th>
                <th>Flow Rate U</th>
                <th>Active Power</th>
                <th>Motor Freq.</th>
                <th><i class="fa fa-wrench" aria-hidden="true"></i></th>
            </tr>
            </thead>
            <tbody id="dynamic-row-wcontrol">
            <?php
                $lastIncr = 0;
                if (is_array($testData)){
                    foreach ($testData as $dt){
                        $lastIncr++;
                        $c_serial_number = '<td>'.$lastIncr.'</td>';
                        $c_valve_position = '<td><div class="input-group"><input class="form-control no-radius" id="edt-valve-position-'.$lastIncr.'" value="'.$dt->vo.'">
                    <label for="edt-valve-position-'.$lastIncr.'" class="input-group-addon no-radius">%</label></div></td>';
                        $c_suction_pressure = '<td><div class="input-group"><input class="form-control no-radius" id="edt-suction-pressure-'.$lastIncr.'" value="'.$dt->sp.'">
                    <label for="edt-suction-pressure-'.$lastIncr.'" class="input-group-addon no-radius">Bar</label></div></td>';
                        $c_discharge_pressure = '<td><div class="input-group"><input class="form-control no-radius" id="edt-discharge-pressure-'.$lastIncr.'" value="'.$dt->dp.'">
                    <label for="edt-discharge-pressure-'.$lastIncr.'" class="input-group-addon no-radius">Bar</label></div></td>';
                        $c_flow_rate_m = '<td><div class="input-group"><input class="form-control no-radius" id="edt-flow-rate-m-'.$lastIncr.'" value="'.$dt->frm.'">
                    <label for="edt-flow-rate-m-'.$lastIncr.'" class="input-group-addon no-radius">m<sup>3</sup>/hr</label></div></td>';
                        $c_flow_rate_u = '<td><div class="input-group"><input class="form-control no-radius" id="edt-flow-rate-u-'.$lastIncr.'" value="'.$dt->fru.'">
                    <label for="edt-flow-rate-u-'.$lastIncr.'" class="input-group-addon no-radius">m<sup>3</sup>/hr</label></div></td>';
                        $c_motor_energy = '<td><div class="input-group"><input class="form-control no-radius" id="edt-motor-energy-'.$lastIncr.'" value="'.$dt->men.'">
                    <label for="edt-motor-energy-'.$lastIncr.'" class="input-group-addon no-radius">kW</label></div></td>';
                        $c_motor_freq = '<td><div class="input-group"><input class="form-control no-radius" id="edt-motor-freq-'.$lastIncr.'" value="'.$dt->mfq.'">
                    <label for="edt-motor-freq-'.$lastIncr.'" class="input-group-addon no-radius">Hz</label></div></td>';
                        $c_dismiss_button = '<td><button class="btn btn-default no-radius" onclick="deleteThisRow(this)"><i class="fa fa-times" aria-hidden="true"></i></button></td>';

                        $complete_row = '<tr>'. $c_serial_number. $c_valve_position. $c_suction_pressure. $c_discharge_pressure. $c_flow_rate_m. $c_flow_rate_u. $c_motor_energy. $c_motor_freq. $c_dismiss_button.'</tr>';

                        echo $complete_row;
                    }
                }
            ?>
            </tbody>
        </table>
        <div class="add-new-field-bar">
            <div class="add-new-field-button" id="add-new-field">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New Field
            </div>
        </div>
    </div>
    <div id="etabs-author">
        <br>
        <div class="form-inline">
            <label for="edt-report-dtntm-dt">Testing Date:</label>
            <input type="text" id="edt-report-dtntm-dt" class="form-control no-radius" style="width: 150px;" value="<?=isset($editReportDnT[0])?$editReportDnT[0]:""?>">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <label for="edt-report-dtntm-tm">Testing Time: </label>
            <div class="input-group bootstrap-timepicker">
                <input type="text" id="edt-report-dtntm-tm" class="form-control no-radius" style="width: 100px" value="<?=isset($editReportDnT[1])?$editReportDnT[1]:""?>">
            </div>
        </div>
        <br><br>
        <label for="edt-author">Author details:</label><br>
        <textarea id="edt-author" rows="10" cols="100" maxlength="300" placeholder="Name, Designation, Contact, etc..."><?=$res['data']['author']?></textarea>
    </div>
</div>

<script>

    function deleteThisRow(sid) {
        document.getElementById("dynamic-data-table").deleteRow(sid.parentNode.parentNode.rowIndex);
    }

    var last_incr = <?=$lastIncr?>;
    $("#add-new-field").click(function () {
        last_incr++;
        var c_serial_number = '<td>'+last_incr+'</td>';
        var c_valve_position = '<td><div class="input-group"><input class="form-control no-radius" id="edt-valve-position-'+last_incr+'">' +
            '<label for="edt-valve-position-'+last_incr+'" class="input-group-addon no-radius">%</label></div></td>';
        var c_suction_pressure = '<td><div class="input-group"><input class="form-control no-radius" id="edt-suction-pressure-'+last_incr+'">' +
            '<label for="edt-suction-pressure-'+last_incr+'" class="input-group-addon no-radius">Bar</label></div></td>';
        var c_discharge_pressure = '<td><div class="input-group"><input class="form-control no-radius" id="edt-discharge-pressure-'+last_incr+'">' +
            '<label for="edt-discharge-pressure-'+last_incr+'" class="input-group-addon no-radius">Bar</label></div></td>';
        var c_flow_rate_m = '<td><div class="input-group"><input class="form-control no-radius" id="edt-flow-rate-m-'+last_incr+'">' +
            '<label for="edt-flow-rate-m-'+last_incr+'" class="input-group-addon no-radius">m<sup>3</sup>/hr</label></div></td>';
        var c_flow_rate_u = '<td><div class="input-group"><input class="form-control no-radius" id="edt-flow-rate-u-'+last_incr+'">' +
            '<label for="edt-flow-rate-u-'+last_incr+'" class="input-group-addon no-radius">m<sup>3</sup>/hr</label></div></td>';
        var c_motor_energy = '<td><div class="input-group"><input class="form-control no-radius" id="edt-motor-energy-'+last_incr+'">' +
            '<label for="edt-motor-energy-'+last_incr+'" class="input-group-addon no-radius">kW</label></div></td>';
        var c_motor_freq = '<td><div class="input-group"><input class="form-control no-radius" id="edt-motor-freq-'+last_incr+'">' +
            '<label for="edt-motor-freq-'+last_incr+'" class="input-group-addon no-radius">Hz</label></div></td>';
        var c_dismiss_button = '<td><button class="btn btn-default no-radius" onclick="deleteThisRow(this)"><i class="fa fa-times" aria-hidden="true"></i></button></td>';

        var complete_row = '<tr>'+c_serial_number+c_valve_position+c_suction_pressure+c_discharge_pressure+c_flow_rate_m+c_flow_rate_u+c_motor_energy+c_motor_freq+c_dismiss_button+'</tr>';
        $("#dynamic-row-wcontrol").append(complete_row);
    });

    function onSave(id, callback) {
        var reportDataStuck = [];
        for(var i=1; i<=last_incr; i++){
            if($("#edt-valve-position-"+i).length){
                var sRowData = {
                    "vo": parseFloat($("#edt-valve-position-"+i).val()),
                    "sp": parseFloat($("#edt-suction-pressure-"+i).val()),
                    "dp": parseFloat($("#edt-discharge-pressure-"+i).val()),
                    "frm": parseFloat($("#edt-flow-rate-m-"+i).val()),
                    "fru": parseFloat($("#edt-flow-rate-u-"+i).val()),
                    "men": parseFloat($("#edt-motor-energy-"+i).val()),
                    "mfq": parseFloat($("#edt-motor-freq-"+i).val())
                };
                reportDataStuck.push(sRowData);
            }
        }
        var test_data = reportDataStuck.length==0?"":JSON.stringify(reportDataStuck);
        var reportDataFinal = {
            "rDt": $("#nm-rcvd-dt").val(),
            "tDtTm": $("#edt-report-dtntm-dt").val()+'@'+$("#edt-report-dtntm-tm").val(),
            "client": $("#nm-client").val(),
            "clientRef": $("#nm-clients-ref").val(),
            "crDt": $("#nm-clients-ref-date").val(),
            "supplier": $("#nm-supplier").val(),
            "meRef": $("#nm-me-ref").val(),
            "mrDt": $("#nm-me-ref-date").val(),
            "pumpType": $("#nm-pump-type").val(),
            "pipeDia": $("#nm-pipe-dia").val(),
            "discharge": $("#nm-pump-discharge").val(),
            "head": $("#nm-pump-head").val(),
            "pumpSn": $("#nm-pump-sn").val(),
            "motorSn": $("#nm-motor-sn").val(),
            "testData": test_data,
            "author": $("#edt-author").val()
        };
        $.post("reportmodules/action.php",{"for":"report","command":"update","id":id,"data":reportDataFinal},function (ret) {
            callback(ret, test_data!="");
        });
    }

    function onCopy(cb) {
        var data={
            "rDt": $("#nm-rcvd-dt").val(),
            "client": $("#nm-client").val(),
            "clientRef": $("#nm-clients-ref").val(),
            "crDt": $("#nm-clients-ref-date").val(),
            "supplier": $("#nm-supplier").val(),
            "meRef": $("#nm-me-ref").val(),
            "mrDt": $("#nm-me-ref-date").val(),
            "pumpType": $("#nm-pump-type").val(),
            "pipeDia": $("#nm-pipe-dia").val(),
            "discharge": $("#nm-pump-discharge").val(),
            "head": $("#nm-pump-head").val(),
            "pumpSn": $("#nm-pump-sn").val(),
            "motorSn": $("#nm-motor-sn").val()
        };
        $.post("reportmodules/action.php",{"command":"insert","for":"report","data":data}, function (res) {
            cb();
        });
    }

    $( "#edit_tabs" ).tabs();

    $("#edt-report-dtntm-dt").datepicker({
        dateFormat:"dd-MM-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });

    $("#edt-report-dtntm-tm").timepicker();

    $("#nm-rcvd-dt").datepicker({
        dateFormat:"dd-MM-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $("#nm-clients-ref-date").datepicker({
        dateFormat:"dd-MM-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $("#nm-me-ref-date").datepicker({
        dateFormat:"dd-MM-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $("#nm-pump-type").on("change", function () {
        var opt_1 = '<option value="3">3 Inch</option>';
        var opt_2 = '<option value="4" selected>4 Inch</option>';
        var opt_3 = '<option value="6">6 Inch</option>';
        var opt_4 = '<option value="8">8 Inch</option>';

        if ($(this).val() == "Centrifugal Pump"){
            $("#nm-pipe-dia").html(opt_1+opt_2+opt_3+opt_4);
        }
        else {
            $("#nm-pipe-dia").html(opt_2+opt_3);
        }
    });
</script>
<?php
$conn->close();
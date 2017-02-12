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
        <li><a href="#etabs-data">Data Record</a></li>
        <li><a href="#etabs-report">Report Data</a></li>
        <li><a href="#etabs-graph">Report Graph</a></li>
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
                                <td><label for="nm-me-ref">ME Reference</label></td>
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

                    $complete_row = '<tr>'. $c_serial_number. $c_valve_position. $c_suction_pressure. $c_discharge_pressure. $c_flow_rate_m. $c_flow_rate_u. $c_motor_energy. $c_motor_freq.'</tr>';

                    echo $complete_row;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div id="etabs-report"></div>
    <div id="etabs-graph">
        Graph is here!
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
    $( "#edit_tabs" ).tabs();
</script>
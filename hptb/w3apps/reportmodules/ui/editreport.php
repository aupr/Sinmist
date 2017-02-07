<?php
$id = $_POST['id'];
require '../../dbcom/connect.php';
require '../../dbcom/dbread.php';
$dbr = new dbread();
$res = $dbr->getReport($id);
?>
<div id="edit_tabs">
    <ul>
        <li><a href="#etabs-info">Report Information</a></li>
        <li><a href="#etabs-data">Report Data</a></li>
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
        <table class="table table-bordered" style="text-align: center">
            <thead>
            <tr>
                <th>Valve position</th>
                <th>Suction P.</th>
                <th>Discharge P.</th>
                <th>Flow Rate M</th>
                <th>Flow Rate U</th>
                <th>Motor Energy</th>
                <th>Motor Freq.</th>
                <th><i class="fa fa-wrench" aria-hidden="true"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <div class="input-group">
                        <input class="form-control no-radius" id="edt-valve-position-1">
                        <label for="edt-valve-position-1" class="input-group-addon no-radius">%</label>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input class="form-control no-radius" id="edt-suction-pressure-1">
                        <label for="edt-suction-pressure-1" class="input-group-addon no-radius">Bar</label>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input class="form-control no-radius" id="edt-discharge-pressure-1">
                        <label for="edt-discharge-pressure-1" class="input-group-addon no-radius">Bar</label>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input class="form-control no-radius" id="edt-flow-rate-m-1">
                        <label for="edt-flow-rate-m-1" class="input-group-addon no-radius">m<sup>3</sup>/hr</label>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input class="form-control no-radius" id="edt-flow-rate-u-1">
                        <label for="edt-flow-rate-u-1" class="input-group-addon no-radius">m<sup>3</sup>/hr</label>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input class="form-control no-radius" id="edt-motor-energy-1">
                        <label for="edt-motor-energy-1" class="input-group-addon no-radius">kWh</label>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input class="form-control no-radius" id="edt-motor-freq-1">
                        <label for="edt-motor-freq-1" class="input-group-addon no-radius">Hz</label>
                    </div>
                </td>
                <td><button class="btn btn-default no-radius" onclick=""><i class="fa fa-times" aria-hidden="true"></i></button></td>
            </tr>
            </tbody>
        </table>
        <!--<button class="btn btn-info no-radius">Clear</button>
        <button class="btn btn-danger no-radius">Update</button>-->
        <div class="add-new-field-bar">
            <div class="add-new-field-button">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New Field
            </div>
        </div>
    </div>
</div>

<script>
    $( "#edit_tabs" ).tabs();
    $("#nm-rcvd-dt").datepicker({
        dateFormat:"dd-M-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $("#nm-clients-ref-date").datepicker({
        dateFormat:"dd-M-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $("#nm-me-ref-date").datepicker({
        dateFormat:"dd-M-yy",
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
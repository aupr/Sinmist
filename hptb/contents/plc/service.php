<?php
    if(isset($_SERVER['HTTP_ORIGIN'])){
        header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
    }
    require '../../w3apps/dbcom/connect.php';
    require '../../w3apps/dbcom/dbread.php';
    $dbr = new dbread();

    $reportObj = $dbr->getReport($_REQUEST['request']['id']);

    $conn->close();
    $userName = "Administrator";

?>
<nav>
    <div class="bsps_1"></div>
    <div class="bsps_2"></div>
    <div class="logo"></div>
    <h3>hydraulic pump testing bench - mist</h3>
    <ul>
        <li><button><?=$userName?></button>
            <ul>
                <li><button id="btn-quit">Quit</button></li>
            </ul>
        </li>
        <li><button>ORIGIN</button>
            <ul class="corner_ul">
                <li><button id="btn-settings">Settings</button></li>
            </ul>
        </li>
    </ul>
</nav>

<div class="panel panel-primary no-radius reportInfoPanel" style="border: 1px solid #1b6d85">
    <div class="panel-heading no-radius" style="background-color: #1b6d85">
        <h3 class="panel-title">Report Info.</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td>Received Date</td>
                <td>:</td>
                <td><?=$reportObj['data']['rDt']?></td>
            </tr>
            <tr>
                <td>Client</td>
                <td>:</td>
                <td><?=$reportObj['data']['client']?></td>
            </tr>
            <tr>
                <td>Client's Ref.</td>
                <td>:</td>
                <td><?=$reportObj['data']['clientRef']?></td>
            </tr>
            <tr>
                <td>ME Ref.</td>
                <td>:</td>
                <td><?=$reportObj['data']['meRef']?></td>
            </tr>
            <tr>
                <td>Supplier</td>
                <td>:</td>
                <td><?=$reportObj['data']['supplier']?></td>
            </tr>
            <tr>
                <td>Pump Type</td>
                <td>:</td>
                <td><?=$reportObj['data']['pumpType']?></td>
            </tr>
            <tr>
                <td>Pump SN</td>
                <td>:</td>
                <td><?=$reportObj['data']['pumpSn']?></td>
            </tr>
            <tr>
                <td>Pipe Diameter</td>
                <td>:</td>
                <td><?=$reportObj['data']['pipeDia']?> Inch</td>
            </tr>
            <tr>
                <td>Discharge</td>
                <td>:</td>
                <td><?=$reportObj['data']['discharge']?> m<sup>3</sup>/hr</td>
            </tr>
            <tr>
                <td>Head</td>
                <td>:</td>
                <td><?=$reportObj['data']['head']?> m</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<!--<div class="panel panel-primary no-radius motorDataPanel" hidden>
    <div class="panel-heading no-radius">
        <h3 class="panel-title">Motor Status</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td>Frequency</td>
                <td>:</td>
                <td>50 Hz</td>
            </tr>
            <tr>
                <td>RPM</td>
                <td>:</td>
                <td>1300</td>
            </tr>
            <tr>
                <td>Power</td>
                <td>:</td>
                <td>85 kW</td>
            </tr>
            <tr>
                <td>Current</td>
                <td>:</td>
                <td>200 A</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>-->

<!--<div id="pnidPanel" class="panel panel-primary no-radius">
    <span style="position: absolute; top: 135px; left: 265px; background-color: black; color:white; padding:3px;">Ultrasonic Flow Meter</span>
    <span style="position: absolute; top: 135px; left: 440px; background-color: black; color:white; padding:3px;">Magnetic Flow Meter</span>
    <span style="background-color: greenyellow; position: absolute; top:170px;left: 270px; border: 1px solid black; padding: 5px;">US Flow Rate: 45 </span>
</div>-->



<div id="alarmPanel" class="panel panel-primary no-radius">
    <div class="panel-heading no-radius">
        <h3 class="panel-title">System Alarm & Activities !!</h3>
    </div>
    <div class="panel-body">
        <textarea id='system-log' style="height: 100%; width: 100%; resize: none; font-family: 'serif', 'Courier New';" readonly></textarea>
    </div>
</div>

<div id="controlPanel" class="panel panel-primary no-radius">
    <div class="panel-heading no-radius">
        <h3 class="panel-title">Control Box</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td><b>Process Mode :</b><br>
                   <table class="table table-hover">
                       <tbody>
                       <tr id="processMode">
                           <td><label style="cursor: pointer;"><input type="radio" name="pmode" value="automatic" checked> Automatic</label></td>
                           <td><label style="cursor: pointer;"><input type="radio" name="pmode" value="manual"> Manual</label></td>
                       </tr>
                       </tbody>
                   </table>
               </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <td><label for="valveLowerLimit">Valve Lower Limit</label></td>
                            <td>:</td>
                            <td>
                                <select id="valveLowerLimit" class="form-control no-radius">
                                    <option value="30">30%</option>
                                    <option value="35">35%</option>
                                    <option value="40">40%</option>
                                    <option value="45">45%</option>
                                    <option value="50">50%</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="valveUpperLimit">Valve Upper Limit</label></td>
                            <td>:</td>
                            <td>
                                <select id="valveUpperLimit" class="form-control no-radius">
                                    <option value="60">60%</option>
                                    <option value="65">65%</option>
                                    <option value="70">70%</option>
                                    <option value="75">75%</option>
                                    <option value="80" selected>80%</option>
                                    <option value="85">85%</option>
                                    <option value="90">90%</option>
                                    <option value="95">95%</option>
                                    <option value="100">100%</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="numberOfObs">Number of observation</label></td>
                            <td>:</td>
                            <td>
                                <select id="numberOfObs" class="form-control no-radius">
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9" selected>9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="ultrasonicSensorChannel">Ultrasonic Sensor</label></td>
                            <td>:</td>
                            <td>
                                <select id="ultrasonicSensorChannel" class="form-control no-radius">
                                    <option>CH 1</option>
                                    <option>CH 2</option>
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table">
            <tbody>
            <tr>
                <td><button type="button" id="cb-start-process" class="btn btn-warning btn-md btn-block no-radius" style="display: block;">Start Process</button></td>
                <td><button type="button" id="cb-take-data" class="btn btn-success btn-block btn-md no-radius" style="display:none;">Take Data</button></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="button" id="cb-emergency" class="btn btn-danger btn-md btn-block no-radius" style="display: none;">Stop process</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="manualInteraction" class="panel panel-primary no-radius">
    <div class="panel-heading no-radius">
        <h3 class="panel-title">Manual Interaction Box</h3>
    </div>
    <div class="panel-body">
        <label for="manualValvePosition">Tune Valve Position </label>
        <input type="range" id="manualValvePosition" class="form-control no-radius" oninput="rcValvePosition()" step="1"  disabled>
        <br>
        <div style="display: inline-block; float: left; padding-top: 6px;">
            <b>Current Position:</b> <span id="mibCvp">####</span>%
        </div>
        <button id="setManualValvePosition" class="btn btn-success no-radius" style="float: right; display: none;">
            Set Position <span class="badge">100%</span>
        </button></button>

        <button id="mib-motor-on" class="btn btn-warning no-radius" style="position: absolute; bottom: 70px; left: 15px; display: none;">MOTOR ON</button>
        <button id="mib-motor-off" class="btn btn-danger no-radius" style="position: absolute; bottom: 70px; left: 15px; display: none;">MOTOR OFF</button>

        <div class="progress no-radius" style="position: absolute; bottom: 10px; width: 320px;">
            <div id="vpProgress" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" style="width: 100%"></div>
        </div>
    </div>
</div>

<div id="statusPanel" class="panel panel-primary no-radius">
    <div class="panel-heading no-radius">
        <h3 class="panel-title">System Status</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td>Process Mode</td>
                <td>:</td>
                <td><span id="status-mode">####</span></td>
            </tr>
            <tr>
                <td>Process Status</td>
                <td>:</td>
                <td><span id="status-process">####</span></td>
            </tr>
            <tr>
                <td>Pipe Diameter</td>
                <td>:</td>
                <td><span id="status-pipe-dia">####</span> Inch</td>
            </tr>
            <tr>
                <td>Flow Rate (Magnetic)</td>
                <td>:</td>
                <td><span id="status-flow-rate-m">####</span> m<sup>3</sup>/hr</td>
            </tr>
            <tr>
                <td>Flow Rate (Ultrasonic)</td>
                <td>:</td>
                <td><span id="status-flow-rate-u">####</span> m<sup>3</sup>/hr</td>
            </tr>
            <tr>
                <td>Valve Position</td>
                <td>:</td>
                <td><span id="status-valve-position">####</span> %</td>
            </tr>
            <tr>
                <td>Suction Pressure</td>
                <td>:</td>
                <td><span id="status-suction-pressure">####</span> Bar</td>
            </tr>
            <tr>
                <td>Discharge Pressure</td>
                <td>:</td>
                <td><span id="status-discharge-pressure">####</span> Bar</td>
            </tr>
            <tr style="display: none;">
                <td>Next Valve Position</td>
                <td>:</td>
                <td><span id="status-next-vp">####</span> %</td>
            </tr>
            <tr>
                <td>Motor Status</td>
                <td>:</td>
                <td><span id="status-motor">####</span></td>
            </tr>
            <tr>
                <td>Motor Frequency</td>
                <td>:</td>
                <td><span id="status-freq">####</span> Hz</td>
            </tr>
            <tr>
                <td>Motor RPM</td>
                <td>:</td>
                <td><span id="status-rpm">####</span></td>
            </tr>
            <tr>
                <td>Motor Power</td>
                <td>:</td>
                <td><span id="status-power">####</span> kW</td>
            </tr>
            <tr>
                <td>Motor Current</td>
                <td>:</td>
                <td><span id="status-current">####</span> A</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<!--<div id="progressBar" class="panel panel-primary no-radius" hidden>
    <b>Operation Stopped</b>
    <div class="progrs">
        <div class="bar" style="width: 40%;"></div>
    </div>
</div>-->

<div id="reportDataPanel" class="panel panel-primary no-radius">
    <div class="panel-heading no-radius">
        <h3 class="panel-title">Collected Data View</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>SL</th>
                <th>Valve Open (%)</th>
                <th>Suction pressure (Bar)</th>
                <th>Discharge Pressure (Bar)</th>
                <th>Flow Rate M (m<sup>3</sup>/hr)</th>
                <th>Flow Rate U (m<sup>3</sup>/hr)</th>
                <th>Active Power (kW)</th>
                <th>Motor Freq. (Hz)</th>
            </tr>
            </thead>
            <tbody id="dataViewTable"></tbody>
        </table>
    </div>
</div>

<!--<div id="systemLogPanel" class="panel panel-primary no-radius" hidden>
    <div class="panel-heading no-radius">
        <h3 class="panel-title">System Log !!</h3>
    </div>
    <div class="panel-body">
        >> 20-02-2017 2:29 - System started button has been clicked<br>
        >> 20-02-2017 2:29 - Attemped to machine start<br>
        >> 20-02-2017 2:29 - Ultra sonic sensor is not ready<br>
        >> 20-02-2017 2:29 - First data has been recorded<br>
    </div>
</div>-->

<div class="fixedFooter"><p>Powered by Sincos Automation Technologies Limited.</p></div>
<script>
    manualValvePosition = 0;

    function rcValvePosition() {
        manualValvePosition = $('#manualValvePosition').val();
        $('#setManualValvePosition span').text(manualValvePosition+'%');
    }

    processInfo = {
        mode: 'undefined',
        status: 'undefined',
        motorStatus: 'undefined'
    };

    pumpInfo = {
        pumpType : "<?=$reportObj['data']['pumpType']?>",
        pipeDia: <?=$reportObj['data']['pipeDia']?>,
        discharge: <?=$reportObj['data']['discharge']?>,
        head: <?=$reportObj['data']['head']?>
    };
</script>
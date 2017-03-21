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
                <li><button>Logout</button></li>
            </ul>
        </li>
        <li><button>ORIGIN</button>
            <ul class="corner_ul">
                <li><button>Settings</button></li>
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
                <td><?=$reportObj['data']['pipeDia']?></td>
            </tr>
            <tr>
                <td>Discharge</td>
                <td>:</td>
                <td><?=$reportObj['data']['discharge']?></td>
            </tr>
            <tr>
                <td>Head</td>
                <td>:</td>
                <td><?=$reportObj['data']['head']?></td>
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
                            <td><label for="valveOpenBy">Valve Open By</label></td>
                            <td>:</td>
                            <td>
                                <select id="valveOpenBy" class="form-control no-radius">
                                    <option>5%</option>
                                    <option>6%</option>
                                    <option>7%</option>
                                    <option>8%</option>
                                    <option>9%</option>
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
                <td><button type="button" id="cb-emergency" class="btn btn-danger btn-md btn-block no-radius" style="display: none;">Emergency</button></td>
            </tr>
            </tbody>
        </table>
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
                <td>Mode</td>
                <td>:</td>
                <td><span id="status-mode">####</span></td>
            </tr>
            <tr>
                <td>Process</td>
                <td>:</td>
                <td><span id="status-process">####</span></td>
            </tr>
            <tr>
                <td>Active Pipe Dia</td>
                <td>:</td>
                <td><span id="status-pipe-dia">####</span> Inch</td>
            </tr>
            <tr>
                <td>Valve Position</td>
                <td>:</td>
                <td><span id="status-valve-position">####</span> %</td>
            </tr>
            <tr>
                <td>Flow Rate M</td>
                <td>:</td>
                <td><span id="status-flow-rate-m">####</span> m<sup>3</sup>/hr</td>
            </tr>
            <tr>
                <td>Flow Rate U</td>
                <td>:</td>
                <td><span id="status-flow-rate-u">####</span> m<sup>3</sup>/hr</td>
            </tr>
            <tr>
                <td>Next Valve Position</td>
                <td>:</td>
                <td><span id="status-next-vp">####</span> %</td>
            </tr>
            <tr>
                <td>Motor</td>
                <td>:</td>
                <td><span id="status-motor">####</span></td>
            </tr>
            <tr>
                <td>Frequency</td>
                <td>:</td>
                <td><span id="status-freq">####</span> Hz</td>
            </tr>
            <tr>
                <td>RPM</td>
                <td>:</td>
                <td><span id="status-rpm">####</span></td>
            </tr>
            <tr>
                <td>Power</td>
                <td>:</td>
                <td><span id="status-power">####</span> kW</td>
            </tr>
            <tr>
                <td>Current</td>
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
    pumpInfo = {
        pumpType : "<?=$reportObj['data']['pumpType']?>",
        pipeDia: <?=$reportObj['data']['pipeDia']?>,
        discharge: <?=$reportObj['data']['discharge']?>,
        head: <?=$reportObj['data']['head']?>
    };
</script>
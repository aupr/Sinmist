<?php
require 'reportmodules/formula/formula.php';
require 'dbcom/connect.php';
require 'dbcom/dbread.php';
$dbRedObj = new dbread();
$dbData = $dbRedObj->getReport($_GET['id']);
$sensor = isset($_GET['sensor'])?$_GET['sensor']:"M";
$pageHeader = '<div class="pheader"><div class="logo"></div><div class="name">Hydraulic Pump Testing Bench - MIST</div></div>';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MIST-HPTB-AUTOMATIC-REPORT</title>
    <!--<link rel="stylesheet" href="../contents/vendors/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="styles/reportpage.css">
    <script src="../contents/vendors/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="../contents/vendors/jquery-ui/1.12.0.custom.all/jquery-ui.min.js"></script>
    <script src="../contents/vendors/amcharts/amcharts.js"></script>
    <script src="../contents/vendors/amcharts/serial.js"></script>
</head>
<body>
    <div class="controller"><div class="cheader">Report Printer</div>
        <div class="holder">
            <button id="print-btn">Print This</button>
            <button id="close-btn">Close This</button>
        </div>
        <div class="cfooter">Automated by:<br>Sincos Automation Technologies Limited.</div>
    </div>
    <div class="wrapper">
        <!--Complete report page 1-->
        <div id="rPage_1" class="masterClass">
            <!--Real content for print page 1-->
            <div class="singlePage"><?=$pageHeader?>
                <div class="reportPageHeadText">Test report of <?=$dbData['data']['pumpType']?></div>
                <table style='float: right; margin: 20px 40px;'>
                    <tbody>
                    <tr>
                        <td>Received Date</td>
                        <td> : </td>
                        <td><?=$dbData['data']['rDt']?></td>
                    </tr>
                    <tr>
                        <td>Test Date & Time</td>
                        <td> : </td>
                        <td><?=$dbData['data']['tDtTm']?></td>
                    </tr>
                    </tbody>
                </table>
                <table style="width: 100%; padding: 30px">
                    <tbody>
                    <tr>
                        <td>Client</td>
                        <td> : </td>
                        <td><?=$dbData['data']['client']?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Client's Ref.</td>
                        <td> : </td>
                        <td><?=$dbData['data']['clientRef']?></td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td><?=$dbData['data']['crDt']?></td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td> : </td>
                        <td><?=$dbData['data']['supplier']?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ME Ref.</td>
                        <td> : </td>
                        <td><?=$dbData['data']['meRef']?></td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td><?=$dbData['data']['mrDt']?></td>
                    </tr>
                    </tbody>
                </table>
                <table style="padding: 30px;">
                    <tbody>
                    <tr>
                        <td>Pump Type</td>
                        <td> : <?=$dbData['data']['pumpType']?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td>Discharge</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['discharge']?> m<sup>3</sup>/hr</td>
                                </tr>
                                <tr>
                                    <td>Head</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['head']?> m</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pump SN</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['pumpSn']?></td>
                                </tr>
                                <tr>
                                    <td>Motor SN</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['motorSn']?></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="vendorMsg">
                    test conducted by <br> department of mechanical engineering <br> military institute of science and technology
                </div>
            </div>
        </div>
        <!--Complete report page 2-->
        <div id="rPage_2" class="masterClass">
            <!--Real content for print page 2-->
            <div class="singlePage"><?=$pageHeader?>
                <div class="reportPageHeadText">Test report of <?=$dbData['data']['pumpType']?></div>
                <table style="width: 100%; padding: 10px 30px">
                    <tbody>
                    <tr>
                        <td>Client</td>
                        <td> : </td>
                        <td><?=$dbData['data']['client']?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Client's Ref.</td>
                        <td> : </td>
                        <td><?=$dbData['data']['clientRef']?></td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td><?=$dbData['data']['crDt']?></td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td> : </td>
                        <td><?=$dbData['data']['supplier']?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ME Ref.</td>
                        <td> : </td>
                        <td><?=$dbData['data']['meRef']?></td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td><?=$dbData['data']['mrDt']?></td>
                    </tr>
                    </tbody>
                </table>
                <table style="padding: 10px 30px;">
                    <tbody>
                    <tr>
                        <td>Pump Type</td>
                        <td> : <?=$dbData['data']['pumpType']?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td>Discharge</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['discharge']?> m<sup>3</sup>/hr</td>
                                </tr>
                                <tr>
                                    <td>Head</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['head']?> m</td>
                                </tr>
                                <tr>
                                    <td>Pump SN</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['pumpSn']?></td>
                                </tr>
                                <tr>
                                    <td>Motor SN</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['motorSn']?></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="reportDataTable">
                    <thead>
                    <tr>
                        <th>Obs.<br>No.</th>
                        <th>Discharge<br>(m<sup>3</sup>/hr)</th>
                        <th>Total Head<br>(m)</th>
                        <th>Input Power<br>(kW)</th>
                        <th>Overall Efficiency<br>(%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sl = 0;
                    $testData = json_decode($dbData['data']['testData']);
                    foreach ($testData as $dt){
                        $sl++;
                        $fdt = calculateFinalData($dt->vo, $dt->sp, $dt->dp, $sensor=="U"?$dt->fru:$dt->frm, $dt->men, $dt->mfq);
                    ?>
                    <tr>
                        <td><?=$sl?></td>
                        <td><?=number_format($fdt['D'], 2, ".", "")?></td>
                        <td><?=number_format($fdt['H'], 2, ".", "")?></td>
                        <td><?=number_format($fdt['P'], 2, ".", "")?></td>
                        <td><?=number_format($fdt['E'], 2, ".", "")?></td>
                    </tr>

                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <ul style="width: 90%; margin: 20px 0 0 50px; list-style-type: disc;">
                    <li>At a discharge of 100 m<sup>3</sup>/hr, pump head developed was 138.7 m with 65.0% overall efficiency.</li>
                    <li>At a developed head of 125 m, pump discharge was recorded 112.7 m<sup>3</sup>/hr with 64.5% overall efficiency.</li>
                </ul>
            </div>
        </div>
        <!--Complete report page 3-->
        <div id="rPage_3" class="masterClass">
            <!--Real content for print page 3-->
            <div class="singlePage"><?=$pageHeader?>
                <div class="reportPageHeadText">Performance Curve For <?=$dbData['data']['pumpType']?></div>
                <table style='float: right; margin: 20px 40px;'>
                    <tbody>
                    <tr>
                        <td>Received Date</td>
                        <td> : </td>
                        <td><?=$dbData['data']['rDt']?></td>
                    </tr>
                    <tr>
                        <td>Test Date & Time</td>
                        <td> : </td>
                        <td><?=$dbData['data']['tDtTm']?></td>
                    </tr>
                    </tbody>
                </table>
                <table style="width: 100%; padding: 30px">
                    <tbody>
                    <tr>
                        <td>Client</td>
                        <td> : </td>
                        <td><?=$dbData['data']['client']?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Client's Ref.</td>
                        <td> : </td>
                        <td><?=$dbData['data']['clientRef']?></td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td><?=$dbData['data']['crDt']?></td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td> : </td>
                        <td><?=$dbData['data']['supplier']?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ME Ref.</td>
                        <td> : </td>
                        <td><?=$dbData['data']['meRef']?></td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td><?=$dbData['data']['mrDt']?></td>
                    </tr>
                    </tbody>
                </table>
                <table style="padding: 30px;">
                    <tbody>
                    <tr>
                        <td>Pump Type</td>
                        <td> : <?=$dbData['data']['pumpType']?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td>Discharge</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['discharge']?> m<sup>3</sup>/hr</td>
                                </tr>
                                <tr>
                                    <td>Head</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['head']?> m</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pump SN</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['pumpSn']?></td>
                                </tr>
                                <tr>
                                    <td>Motor SN</td>
                                    <td> : </td>
                                    <td><?=$dbData['data']['motorSn']?></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div id="reportGraph">

                </div>
            </div>
        </div>

    </div>

<script>
        $(".controller").draggable();
        $("#print-btn").click(function () {
            //var printContents = $('#rPage_1').html()+$('#rPage_2').html()+$('#rPage_3').html();
            //var originalContents = document.body.innerHTML;
            document.body.innerHTML = $('#rPage_1').html()+$('#rPage_2').html()+$('#rPage_3').html();//printContents;
            window.print();
            location.reload();
            //document.body.innerHTML = originalContents;
        });
        $("#close-btn").click(function () {
            window.close();
        });
        ////////////////////////////////////////////////////////////////////////////////

        var chartData = [
            <?php
            $sl = 0;
            $testData = json_decode($dbData['data']['testData']);
            foreach ($testData as $dt) {
                if($sl != 0) echo ",\n";
                $sl++;
                $fdt = calculateFinalData($dt->vo, $dt->sp, $dt->dp, $sensor=="U"?$dt->fru:$dt->frm, $dt->men, $dt->mfq);
            ?>
            {
                discharge: <?=number_format($fdt['D'], 2, ".", "")?>,
                power_data: <?=number_format($fdt['P'], 2, ".", "")?>,
                efficiency_data: <?=number_format($fdt['E'], 2, ".", "")?>,
                head_data: <?=number_format($fdt['H'], 2, ".", "")?>
            }
            <?php
            }
            ?>
        ];

        var chart = AmCharts.makeChart("reportGraph", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "useGraphSettings": true
            },
            "dataProvider": chartData,
            "synchronizeGrid":true,
            "valueAxes": [{
                "id":"v1",
                "axisColor": "#FF6600",
                "axisThickness": 2,
                "axisAlpha": 1,
                "title": "Power (kW)",
                "position": "left"
            }, {
                "id":"v2",
                "axisColor": "#FCD202",
                "axisThickness": 2,
                "axisAlpha": 1,
                "title": "Overall Efficiency (%)",
                "position": "right"
            }, {
                "id":"v3",
                "axisColor": "#B0DE09",
                "axisThickness": 2,
                "gridAlpha": 0,
                "offset": 50,
                "axisAlpha": 1,
                "title": "Head (m)",
                "position": "left"

            }],
            "graphs": [{
                "valueAxis": "v1",
                "lineColor": "#FF6600",
                "bullet": "round",
                "bulletBorderThickness": 1,
                "hideBulletsCount": 30,
                "title": "Power",
                "valueField": "power_data",
                "type": "smoothedLine",
                "fillAlphas": 0
            }, {
                "valueAxis": "v2",
                "lineColor": "#FCD202",
                "bullet": "square",
                "bulletBorderThickness": 1,
                "hideBulletsCount": 30,
                "title": "Efficiency",
                "valueField": "efficiency_data",
                "type": "smoothedLine",
                "fillAlphas": 0
            }, {
                "valueAxis": "v3",
                "lineColor": "#B0DE09",
                "bullet": "triangleUp",
                "bulletBorderThickness": 1,
                "hideBulletsCount": 30,
                "title": "Head",
                "valueField": "head_data",
                "type": "smoothedLine",
                "fillAlphas": 0
            }],
            "chartScrollbar": {
                "hideResizeGrips": true,
                "resizeEnabled": false,
                "scrollbarHeight": 1
            },
            "chartCursor": {
                "cursorPosition": "mouse"
            },
            "categoryField": "discharge",
            "categoryAxis": {
                "title": "Discharge (m3/hr)",
                "axisColor": "#DADADA",
                "minorGridEnabled": true
            },
            "export": {
                "enabled": true,
                "position": "bottom-right"
            }
        });

        //chart.zoomControl.

        chart.addListener("dataUpdated", zoomChart);
        zoomChart();

        function zoomChart(){
            chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length - 1);
            $("[title='JavaScript charts']").css({"visibility":"hidden"});
            //$("#reportGraph svg g:nth-child(11)").css({"display":"none"});
        }
</script>
</body>
</html>
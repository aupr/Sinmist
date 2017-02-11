<?php
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
                <div class="reportPageHeadText">Test report of Submersible Pump</div>
                <table style='float: right; margin: 20px 40px;'>
                    <tbody>
                    <tr>
                        <td>Received Date</td>
                        <td> : </td>
                        <td>12-Feb-2017</td>
                    </tr>
                    <tr>
                        <td>Test Date & Time</td>
                        <td> : </td>
                        <td>15-Feb-2017</td>
                    </tr>
                    </tbody>
                </table>
                <table style="width: 100%; padding: 30px">
                    <tbody>
                    <tr>
                        <td>Client</td>
                        <td> : </td>
                        <td>Sincos Automation Technologies Limited.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Client's Ref.</td>
                        <td> : </td>
                        <td>BD3455KC2017</td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td>23-Feb-2017</td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td> : </td>
                        <td>Siemens Bangladesh Limited.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ME Ref.</td>
                        <td> : </td>
                        <td>ME44766582018</td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td>25-Feb-2017</td>
                    </tr>
                    </tbody>
                </table>
                <table style="padding: 30px;">
                    <tbody>
                    <tr>
                        <td>Pump Type</td>
                        <td> : Submersible Pump</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td>Discharge</td>
                                    <td> : </td>
                                    <td>45 m<sup>3</sup>/hr</td>
                                </tr>
                                <tr>
                                    <td>Head</td>
                                    <td> : </td>
                                    <td>100 m</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pump SN</td>
                                    <td> : </td>
                                    <td>BM876465HKL2017 </td>
                                </tr>
                                <tr>
                                    <td>Motor SN</td>
                                    <td> : </td>
                                    <td>S79987PKJ88RT34</td>
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
                <div class="reportPageHeadText">Test report of Submersible Pump</div>
                <table style="width: 100%; padding: 10px 30px">
                    <tbody>
                    <tr>
                        <td>Client</td>
                        <td> : </td>
                        <td>Sincos Automation Technologies Limited.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Client's Ref.</td>
                        <td> : </td>
                        <td>BD3455KC2017</td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td>23-Feb-2017</td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td> : </td>
                        <td>Siemens Bangladesh Limited.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ME Ref.</td>
                        <td> : </td>
                        <td>ME44766582018</td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td>25-Feb-2017</td>
                    </tr>
                    </tbody>
                </table>
                <table style="padding: 10px 30px;">
                    <tbody>
                    <tr>
                        <td>Pump Type</td>
                        <td> : Submersible Pump</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td>Discharge</td>
                                    <td> : </td>
                                    <td>45 m<sup>3</sup>/hr</td>
                                </tr>
                                <tr>
                                    <td>Head</td>
                                    <td> : </td>
                                    <td>100 m</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pump SN</td>
                                    <td> : </td>
                                    <td>BM876465HKL2017 </td>
                                </tr>
                                <tr>
                                    <td>Motor SN</td>
                                    <td> : </td>
                                    <td>S79987PKJ88RT34</td>
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
                    <tr>
                        <td>01</td>
                        <td>50</td>
                        <td>100</td>
                        <td>500</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>50</td>
                        <td>100</td>
                        <td>500</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>50</td>
                        <td>100</td>
                        <td>500</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>50</td>
                        <td>100</td>
                        <td>500</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>50</td>
                        <td>100</td>
                        <td>500</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>50</td>
                        <td>100</td>
                        <td>500</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>50</td>
                        <td>100</td>
                        <td>500</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>50</td>
                        <td>100</td>
                        <td>500</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>50</td>
                        <td>100</td>
                        <td>500</td>
                        <td>40</td>
                    </tr>
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
                <div class="reportPageHeadText">Performance Curve For Submersible Pump</div>
                <table style='float: right; margin: 20px 40px;'>
                    <tbody>
                    <tr>
                        <td>Received Date</td>
                        <td> : </td>
                        <td>12-Feb-2017</td>
                    </tr>
                    <tr>
                        <td>Test Date & Time</td>
                        <td> : </td>
                        <td>15-Feb-2017</td>
                    </tr>
                    </tbody>
                </table>
                <table style="width: 100%; padding: 30px">
                    <tbody>
                    <tr>
                        <td>Client</td>
                        <td> : </td>
                        <td>Sincos Automation Technologies Limited.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Client's Ref.</td>
                        <td> : </td>
                        <td>BD3455KC2017</td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td>23-Feb-2017</td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td> : </td>
                        <td>Siemens Bangladesh Limited.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ME Ref.</td>
                        <td> : </td>
                        <td>ME44766582018</td>
                        <td></td>
                        <td>Date</td>
                        <td> : </td>
                        <td>25-Feb-2017</td>
                    </tr>
                    </tbody>
                </table>
                <table style="padding: 30px;">
                    <tbody>
                    <tr>
                        <td>Pump Type</td>
                        <td> : Submersible Pump</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td>Discharge</td>
                                    <td> : </td>
                                    <td>45 m<sup>3</sup>/hr</td>
                                </tr>
                                <tr>
                                    <td>Head</td>
                                    <td> : </td>
                                    <td>100 m</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pump SN</td>
                                    <td> : </td>
                                    <td>BM876465HKL2017 </td>
                                </tr>
                                <tr>
                                    <td>Motor SN</td>
                                    <td> : </td>
                                    <td>S79987PKJ88RT34</td>
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
            {
                discharge: 35.00,
                power_data: 56.00,
                efficiency_data: 17.37,
                head_data: 10.20
            },
            {
                discharge: 36.00,
                power_data: 56.00,
                efficiency_data: 17.86,
                head_data: 10.20
            },
            {
                discharge: 37.00,
                power_data: 56.00,
                efficiency_data: 18.36,
                head_data: 10.20
            },
            {
                discharge: 38.00,
                power_data: 56.00,
                efficiency_data: 18.85,
                head_data: 10.20
            },
            {
                discharge: 39.00,
                power_data: 56.00,
                efficiency_data: 19.35,
                head_data: 10.20
            },
            {
                discharge: 40.00,
                power_data: 56.00,
                efficiency_data: 19.85,
                head_data: 10.20
            },
            {
                discharge: 41.00,
                power_data: 56.00,
                efficiency_data: 20.34,
                head_data: 10.20
            },
            {
                discharge: 42.00,
                power_data: 56.00,
                efficiency_data: 20.84,
                head_data: 10.20
            }
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
                "fillAlphas": 0
            }, {
                "valueAxis": "v2",
                "lineColor": "#FCD202",
                "bullet": "square",
                "bulletBorderThickness": 1,
                "hideBulletsCount": 30,
                "title": "Efficiency",
                "valueField": "efficiency_data",
                "fillAlphas": 0
            }, {
                "valueAxis": "v3",
                "lineColor": "#B0DE09",
                "bullet": "triangleUp",
                "bulletBorderThickness": 1,
                "hideBulletsCount": 30,
                "title": "Head",
                "valueField": "head_data",
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
<?php
session_start();
if (isset($_SESSION['userFullName'])) {
    $userName = $_SESSION['userFullName'];
} else {
    header('Location: logout.php');
}

//require 'reportmodules/formula/formula.php';
require 'dbcom/connect.php';
require 'dbcom/dbread.php';
$dbRedObj = new dbread();
$dbData = $dbRedObj->getReport($_GET['id']);
//$sensor = isset($_GET['sensor'])?$_GET['sensor']:"M";
$pageHeader = '<div class="pheader"><div class="logo"></div><div class="name"><h2>Consultancy, Advisory and Testing Services (CATS)</h2><span>Faculty of Mechanical Engineering (FME)<br>Military Institute of Science and Technology (MIST)</span></div></div>';
//$pageHeader = '<div style="height: 100px;"></div>';
$pageFooter = '<div class="pfooter">Mirpur Cantonment, Dhaka - 1216, Phone: +88-02-8000446, http://me.mist.ac.bd</div>';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MIST-HPTB-AUTOMATIC-REPORT-GENERATOR</title>
    <!--<link rel="stylesheet" href="../contents/vendors/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="styles/receipt.css">
    <script src="../contents/vendors/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="../contents/vendors/jquery-ui/1.12.0.custom.all/jquery-ui.min.js"></script>
    <!--<script src="../contents/vendors/amcharts/amcharts.js"></script>
    <script src="../contents/vendors/amcharts/serial.js"></script>-->
</head>
<body>
<div class="controller"><div class="cheader">Print Control</div>
    <div class="holder">
        <button id="print-btn">Print Gate Pass</button>
        <button id="close-btn">Close Gate Pass</button>
    </div>
    <div class="cfooter">Automated by:<br>Sincos Automation Technologies Limited.</div>
</div>
<div class="wrapper">
    <!--Complete receipt page 1-->
    <div id="rPage_1" class="masterClass">
        <!--Real content for print page 1-->
        <div class="singlePage"><?=$pageHeader?>
            <div class="reportPageHeadText">gate pass for <?=$dbData['data']['pumpType']?></div>
            <table style='float: right; margin: 20px 40px; display: none;'>
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Date</td>
                    <td> : </td>
                    <td><?=$dbData['data']['rDt']?></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
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
                    <td><br></td>
                    <td></td>
                    <td></td>
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
                the above mentioned pump is permitted <br> to be taken by above client.
            </div>
            <div class="author">
                <span>Authorized By:</span><br>
                <span style=""><?=isset($_GET['n'])?$_GET['n']:"N/A"?></span><br>
                <span><?=isset($_GET['d'])?$_GET['d']:"N/A"?>,</span><br>
                Mechanical Engineering.<br>
                MIST, Mirpur Cantonment<br>
                Dhaka - 1216
            </div>
        </div>
        <?=$pageFooter?>
    </div>

</div>

<script>
    $(".controller").draggable();
    $("#print-btn").click(function () {
        //var printContents = $('#rPage_1').html()+$('#rPage_2').html()+$('#rPage_3').html();
        //var originalContents = document.body.innerHTML;
        document.body.innerHTML = $('#rPage_1').html();//printContents;
        window.print();
        location.reload();
        //document.body.innerHTML = originalContents;
    });
    $("#close-btn").click(function () {
        window.close();
    });


</script>
</body>
</html>
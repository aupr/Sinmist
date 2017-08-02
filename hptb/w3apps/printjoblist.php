<?php
session_start();
if (isset($_SESSION['userFullName'])) {
    $userName = $_SESSION['userFullName'];
} else {
    header('Location: logout.php');
}

$type = isset($_GET['t'])?$_GET['t']:'report';
$key = isset($_GET['k'])?$_GET['k']:'';
$rawKey = isset($_GET['rk'])?$_GET['rk']:"XXXX";

//require 'reportmodules/formula/formula.php';
require 'dbcom/connect.php';
require 'dbcom/dbread.php';
$dbRedObj = new dbread();
//$dbData = $dbRedObj->getReport($_GET['id']);
//$sensor = isset($_GET['sensor'])?$_GET['sensor']:"M";
//$pageHeader = '<div class="pheader"><div class="logo"></div><div class="name"><h2>Consultancy, Advisory and Testing Services (CATS)</h2><span>Faculty of Mechanical Engineering (FME)<br>Military Institute of Science and Technology (MIST)</span></div></div>';
//$pageHeader = '<div style="height: 100px;"></div>';
//$pageFooter = '<div class="pfooter">Mirpur Cantonment, Dhaka - 1216, Phone: +88-02-8000446, http://me.mist.ac.bd</div>';
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
    <link rel="stylesheet" href="styles/printjoblist.css">
    <script src="../contents/vendors/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="../contents/vendors/jquery-ui/1.12.0.custom.all/jquery-ui.min.js"></script>
    <!--<script src="../contents/vendors/amcharts/amcharts.js"></script>
    <script src="../contents/vendors/amcharts/serial.js"></script>-->
</head>
<body>
<nav class="navbar navbar-inverse no-radius">
    <ul class="nav navbar-nav">
        <li class="active"><button id="btn-printList">Print List</button></li>
        <li class="active"><button id="btn-closeList">Close List</button></li>
    </ul>
</nav>

<div id="printInner" style="width: 1040px; margin: auto;">
    <div class="printHead">
        <?php
        if($type == 'report'){
            echo "Complete Job List.";
        }
        else if($type == 'model'){
            echo "Pending Job List.";
        }
        else if($type == 'find'){
            echo "Job List for the keyword \"$rawKey\"";
        } else {
            echo "It's absurd!";
        }
        ?>
    </div>
    <div id="printContent">
        No data has been loaded yet!
    </div>
</div>

<script>
    var type = "<?=$type?>";
    var key = "<?=$key?>";

    console.log(type);
    console.log(key);

    $.post("reportmodules/contents.php",{'type':type, 'limitStart':1, 'limit':10000, 'keywords':key},function (res) {
        console.log(res);
        var tableData = '<table>' +
            '<thead>' +
            '<tr>' +
            '<th>SL</th>'+
            '<th>Received dt</th>' +
            '<th>Test dt & time</th>' +
            '<th>ME Ref.</th>' +
            '<th>Client</th>' +
            '<th>Supplier</th>' +
            '<th>Pump Type</th>' +
            '<th>Diameter</th>' +
            '<th>Pump-SN</th>' +
            '<th>Motor-SN</th>' +
            '<tr>' +
            '</thead>' +
            '<tbody>';

        res.data.forEach(function (val, indx) {
            tableData += '<tr>' +
                '<td>'+(indx+1)+'</td>' +
                '<td>'+val.rDt+'</td>' +
                '<td>'+val.tDtTm+'</td>' +
                '<td>'+val.meRef+'</td>' +
                '<td>'+val.client+'</td>' +
                '<td>'+val.supplier+'</td>' +
                '<td>'+val.pumpType+'</td>' +
                '<td>'+val.pipeDia+'</td>' +
                '<td>'+val.pumpSn+'</td>' +
                '<td>'+val.motorSn+'</td>' +
                '</tr>';
        });

        tableData += '</tbody></table>';

        $('#printContent').html(tableData);

        $('#btn-printList').click(function () {
            document.body.innerHTML = $('#printInner').html();//printContents;
            window.print();
            location.reload();
        });

        $('#btn-closeList').click(function () {
            window.close();
        });

    },"json").fail(function () {
        alert("Failed data communication!");
    });
</script>

</body>
</html>
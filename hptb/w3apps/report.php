<?php
session_start();
if (isset($_SESSION['userFullName'])) {
    $userName = $_SESSION['userFullName'];
} else {
    header('Location: logout.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MIST PUMP TESTING BENCH</title>
    <link rel="stylesheet" href="../contents/vendors/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../contents/vendors/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../contents/vendors/jquery-ui/1.12.1/custom.sq/jquery-ui.min.css">
    <link rel="stylesheet" href="../contents/vendors/jquery-ui/1.12.1/custom.sq/jquery-ui-dp.min.css">
    <link rel="stylesheet" href="styles/report.css">
    <script src="../contents/vendors/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="../contents/vendors/jquery-ui/1.12.1/custom.sq/jquery-ui.min.js"></script>
    <script src="../contents/vendors/amcharts/amcharts.js"></script>
    <script src="../contents/vendors/amcharts/serial.js"></script>
    <script src="../contents/vendors/itonic/1.0/itonic.min.js"></script>
    <script src="../contents/vendors/bootstrap-timepicker.js"></script>
    <script src="scripts/report.js"></script>
    <script src="scripts/common.js"></script>
</head>
<body>
<div id="service">
    <nav>
        <div class="bsps_1"></div>
        <div class="bsps_2"></div>
        <div class="logo" style="background-image: url('../contents/images/logo.png')"></div>
        <h3>hydraulic pump testing bench - mist</h3>
        <ul>
            <li><button><?=$userName?></button>
                <ul>
                    <li><button id="btn-logout-report">Logout</button></li>
                </ul>
            </li>
            <li><button id="btn-origin">Origin</button>
                <ul class="corner_ul">
                    <li><button id="btn-settings">Settings</button></li>
                    <li><button id="btn-set-formula">Set Formula</button></li>
                    <li><button id="btn-toggle-fscr">Toggle Full-Screen</button></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="options">
        <div class="form-group search">
            <button id="find-btn-config" class="btn btn-default no-radius"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
            <div class="configWindow">
                <input type="checkbox" id="ckbx-uncompleted-report"><label for="ckbx-uncompleted-report">&nbsp;Uncompleted Report</label><br>
                <input type="checkbox" id="ckbx-completed-report"><label for="ckbx-completed-report">&nbsp;Completed Report</label><hr>
                <input type="checkbox" id="ckbx-rcvd-date"><label for="ckbx-rcvd-date">&nbsp;Received Date</label><br>
                <input type="checkbox" id="ckbx-tst-date"><label for="ckbx-tst-date">&nbsp;Test Date & Time</label><br>
                <input type="checkbox" id="ckbx-me-ref"><label for="ckbx-me-ref">&nbsp;ME Reference</label><br>
                <input type="checkbox" id="ckbx-client"><label for="ckbx-client">&nbsp;Client</label><br>
                <input type="checkbox" id="ckbx-supplier"><label for="ckbx-supplier">&nbsp;Supplier</label><br>
                <input type="checkbox" id="ckbx-pump-type"><label for="ckbx-pump-type">&nbsp;Pump Type</label><br>
                <input type="checkbox" id="ckbx-pump-sn"><label for="ckbx-pump-sn">&nbsp;Pump Serial Number</label><br>
                <input type="checkbox" id="ckbx-motor-sn"><label for="ckbx-motor-sn">&nbsp;Motor Serial Number</label><br>
            </div>
            <input id="find-keyword" type="text" class="form-control no-radius" placeholder="Enter keyword here...">
            <button id="find-btn" class="btn btn-info no-radius">Search</button>
            </div>
        <button id="btn-create-model" class="btn btn-primary btn-lg no-radius">create a new report</button>
        <button id="btn-view-models" class="btn btn-primary btn-lg no-radius">uncompleted reports</button>
        <button id="btn-view-reports" class="btn btn-primary btn-lg no-radius">completed reports</button>

    </div>

    <div class="actionGroup">
        <div class="btn-group btn-group-md" role="group" aria-label="...">
            <button type="button" id="ac-btn-delete-report" class="btn btn-danger no-radius">Delete</button>
            <button type="button" id="ac-btn-edit-report" class="btn btn-warning no-radius">Edit</button>
            <button type="button" id="ac-btn-take-data-into-report" class="btn btn-success no-radius">Take data</button>
            <button type="button" id="ac-btn-view-report-modal" class="btn btn-info no-radius">View</button>
            <button type="button" id="ac-btn-make-report-page" class="btn btn-success no-radius">Report</button>
        </div>
    </div>

    <div class="panel panel-primary no-radius reportList">
        <div class="panel-heading no-radius header">
            <div class="page-manage">
                <span id="report-page-info">1-50 of 260</span>&nbsp;&nbsp;
                <button id="report-previous-page" class="btn btn-default btn-xs no-radius"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                <button id="report-next-page" class="btn btn-default btn-xs no-radius"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
            <h3 id="report-list-title" class="panel-title">Report List</h3>
        </div>
        <div id="reportContainer" class="panel-body reportContents"></div>
    </div>

    <div class="fixedFooter">
        <p>Powered by Sincos Automation Technologies Limited.</p>
    </div>
</div>
<div id="loading-scr">
    <div class="alert alert-info no-radius" role="alert">
        <strong>Please wait for a while !</strong>
    </div>
</div>
<div id="no-service">
    <div class="alert alert-danger no-radius" role="alert">
        <strong>Warning!</strong> This device is not eligible to access this system!
    </div>
</div>
</body>
</html>
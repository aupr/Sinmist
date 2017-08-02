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
    <link rel="stylesheet" href="styles/origin.css">
    <script src="../contents/vendors/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="../contents/vendors/jquery-ui/1.12.0.custom.all/jquery-ui.min.js"></script>
    <script src="../contents/vendors/itonic/1.0/itonic.min.js"></script>
    <script src="scripts/origin.js"></script>
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
                <ul class="corner_ul">
                    <li><button id="btn-logout-origin">Logout</button></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="panel panel-primary box-shadow-2 no-radius originOptions">
        <div class="panel-heading no-radius">
            <h3 class="panel-title">Options</h3>
        </div>
        <div class="panel-body">
            <button type="button" id="btn-acc-report" class="btn btn-info btn-lg btn-block no-radius">Job Section</button>
            <button type="button" id="btn-mntn-user" class="btn btn-info btn-lg btn-block no-radius">Change User Password</button>
            <button type="button" id="btn-set-netp" class="btn btn-info btn-lg btn-block no-radius" style="display: none;">Set Network Parameters</button>
            <button type="button" id="btn-toggle-fscr" class="btn btn-info btn-lg btn-block no-radius">Toggle Full-Screen</button>
        </div>
    </div>

    <div class="fixedFooter"><p>Powered by Sincos Automation Technologies Limited.</p></div>
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
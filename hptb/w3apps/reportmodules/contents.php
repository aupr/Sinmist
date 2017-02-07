<?php

$type = isset($_POST['type'])?$_POST['type']:false;
$limitStart = isset($_POST['limitStart'])?$_POST['limitStart']:1;
$limit = isset($_POST['limit'])?$_POST['limit']:50;

require '../dbcom/connect.php';
require '../dbcom/dbread.php';
$dbdata = new dbread();

if ($type == "model"){
    echo json_encode($dbdata->getUncompletedReportList($limitStart, $limit));
}
elseif ($type == "report"){
    echo json_encode($dbdata->getCompletedReportList($limitStart, $limit));
}
elseif ($type == "find"){
    $keywords = $_POST['keywords'];
    echo json_encode($dbdata->searchReportList($limitStart, $limit, $keywords));
}


elseif ($type == "areport"){
    $id = $_POST['id'];
    echo json_encode($dbdata->getReport($id));
}


<?php

if(isset($_SERVER['HTTP_ORIGIN'])){
    header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
}

date_default_timezone_set('Asia/Dhaka');

$for = $_POST['for'];
$command = $_POST['command'];

require '../dbcom/connect.php';
require '../dbcom/dbwrite.php';
$dbaction = new dbwrite();

if ($for == 'report'){
    if ($command == "insert"){
        $data = $_REQUEST['data'];
        echo $dbaction->insertReport($data);
    }
    if ($command == "update"){
        $id = isset($_POST['id'])?$_POST['id']:$_POST['request']['id'];
        $data = $_REQUEST['data'];
        if (isset($_POST['atd'])) {
            $data['tDtTm'] = date("d-F-Y@h:i A");
        }
        echo $dbaction->updateReportData($id, $data);
    }
    if ($command == "delete"){
        $id = $_POST['id'];
        echo $dbaction->deleteReport($id);
    }
}

$conn->close();
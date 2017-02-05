<?php
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
        $id = $_POST['id'];
        $data = $_REQUEST['data'];
        $dbaction->updateReportData($id, $data);
    }
    if ($command == "delete"){
        $id = $_POST['id'];
        $dbaction->deleteReport($id);
    }
}

$conn->close();
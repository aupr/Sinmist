<?php
    if(isset($_SERVER['HTTP_ORIGIN'])){
        header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
    }
    echo "I am here to reply...";
?>
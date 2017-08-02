<?php

function calculateFinalData($VP, $SP, $DP, $FR, $AP, $MF){
$discharge=0; $totalHead=0; $inputPower=0; $overallEfficiency=0;
$discharge = $FR;
$totalHead = ($DP + $SP)*10.197;
$inputPower = ($AP==0)?0.001:$AP;

$PHKW = ($discharge*$totalHead*1000*9.81)/(3.6*1000000);
$overallEfficiency = ($PHKW/$inputPower)*100;
//$overallEfficiency = ($discharge*$totalHead*1000*100)/(367*1000*$inputPower);
	return array("D"=>$discharge, "H"=>$totalHead, "P"=>$inputPower, "E"=>$overallEfficiency);
}
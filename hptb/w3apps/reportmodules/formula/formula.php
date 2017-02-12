<?php

function calculateFinalData($VP, $SP, $DP, $FR, $AP, $MF){
$discharge=0; $totalHead=0; $inputPower=0; $overallEfficiency=0;
$discharge = $FR;
$totalHead = $DP - $SP;
$inputPower = $AP;
$overallEfficiency = ($discharge*$totalHead*1000*100)/(367*1000);
	return array("D"=>$discharge, "H"=>$totalHead, "P"=>$inputPower, "E"=>$overallEfficiency);
}
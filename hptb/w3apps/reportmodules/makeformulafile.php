<?php

$formulaFile = fopen("formula/formula.php", "w") or die("Unable to open file!");

$txt = "<?php\n\nfunction calculateFinalData".'($VP, $SP, $DP, $FR, $AP, $MF){'."\n".'$discharge=0; $totalHead=0; $inputPower=0; $overallEfficiency=0;'."\n";
fwrite($formulaFile, $txt);

$txt = $_REQUEST['formula'];
fwrite($formulaFile, $txt);

$txt = "\n\t".'return array("D"=>$discharge, "H"=>$totalHead, "P"=>$inputPower, "E"=>$overallEfficiency);'."\n}";
fwrite($formulaFile, $txt);

fclose($formulaFile);

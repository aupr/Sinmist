<?php
$nfile = fopen("../formula/formula.php", "r") or die("unable to read");
$str = fread($nfile,filesize("../formula/formula.php")-94);
$prevFormula = substr($str,131,strlen($str));
fclose($nfile);
?>

<div style="width: 100%; height: inherit;">
    <p><b>Input Variables: </b> $VP (Valve Position), $SP (Suction Pressure), $DP (Discharge Pressure), $FR (Flow Rate), $AP (Active Power), $MF (Motor Frequency).</p>
    <p><b>Output Variables: </b> $discharge, $totalHead, $inputPower, $overallEfficiency.</p>
    <label for="formula-txt">Write formula here:</label><br>
    <textarea id="formula-txt" style="width: 100%; height: 200px; resize: vertical; font-family: 'courier', 'serif';"><?=$prevFormula?></textarea>
</div>

<script>
    function setFormula(callback) {
        $.post("reportmodules/makeformulafile.php",{"formula":$("#formula-txt").val()}, function (bk) {
            callback();
        });
    }
</script>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<script>
    var chartData = [
        {
            discharge: 13.20,
            power_data: 3.28,
            efficiency_data: 7.16,
            head_data: 1.99            }
        ,
        {
            discharge: 108.33,
            power_data: 4.58,
            efficiency_data: 57.59,
            head_data: 1.95            }
        ,
        {
            discharge: 171.01,
            power_data: 5.46,
            efficiency_data: 86.22,
            head_data: 1.85            }
        ,
        {
            discharge: 193.49,
            power_data: 5.69,
            efficiency_data: 94.58,
            head_data: 1.79            }
        ,
        {
            discharge: 201.02,
            power_data: 5.81,
            efficiency_data: 97.16,
            head_data: 1.77            }
        ,
        {
            discharge: 203.91,
            power_data: 5.87,
            efficiency_data: 97.41,
            head_data: 1.75            }
        ,
        {
            discharge: 204.50,
            power_data: 5.87,
            efficiency_data: 97.59,
            head_data: 1.75            }
    ];

    console.log(chartData);




    function arrangeGraphData(data) {
        var totalSegment = 19;

        data.sort(function (a,b) {
            return a.discharge - b.discharge;
        });


        function solveStraightLine(x0,x1,y1,x2,y2) {
            var y0;
            y0 = (((x0-x1)/(x2-x1))*(y2-y1))+y1;
            return y0;
        }


        var minVal = data[0].discharge;
        var maxVal = data[data.length-1].discharge;

        var totalInterval = maxVal-minVal;
        var segmentValue = totalInterval/totalSegment;

        //var ret = [];

        var takeData = false;
        var index1=0;
        var index2=0;
        var revisedData = [];

        for (var i=minVal; i<=maxVal; i=i+segmentValue) {
            //ret.push(i);
            takeData = true;
            data.forEach(function (val, ind) {
                //console.log(val);
                if (takeData) {
                    if (i === val.discharge){

                        if (ind === 0){
                            index1 = ind;
                            index2 = ind + 1;
                        } else {
                            index1 = ind - 1;
                            index2 = ind;
                        }
                        takeData = false;
                    } else if (i < val.discharge) {
                        index1 = ind - 1;
                        index2 = ind;
                        takeData = false;
                    }
                }
            });

            revisedData.push({discharge: i, power_data: solveStraightLine(i, data[index1].discharge, data[index1].power_data, data[index2].discharge, data[index2].power_data ), efficiency_data: solveStraightLine(i, data[index1].discharge, data[index1].efficiency_data, data[index2].discharge, data[index2].efficiency_data ), head_data: solveStraightLine(i, data[index1].discharge, data[index1].head_data, data[index2].discharge, data[index2].head_data ) });
            //console.log('xVal:'+i+' Index1: '+index1+' Index2: '+index2);
        }

        return revisedData;
    }

    function fixDecimalPlaces(data) {
        for (var i=0; i<data.length; i++) {
            data[i].discharge = data[i].discharge.toFixed(2);
            data[i].power_data = data[i].power_data.toFixed(2);
            data[i].efficiency_data = data[i].efficiency_data.toFixed(2);
            data[i].head_data = data[i].head_data.toFixed(2);
        }
        return data;
    }

    //console.log("Straight line solution: "+solveStraightLine(201.02, x1, y1, x2, y2));
    console.log(fixDecimalPlaces(arrangeGraphData(chartData)));


</script>
</body>
</html>



<?php
/**
 * Created by PhpStorm.
 * User: MIST
 * Date: 6/4/2017
 * Time: 10:36 AM
 */







<?php
    if(isset($_SERVER['HTTP_ORIGIN'])){
        header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
    }
    $userName = "Administrator";
?>
<nav>
    <div class="bsps_1"></div>
    <div class="bsps_2"></div>
    <div class="logo"></div>
    <h3>hydraulic pump testing bench - mist</h3>
    <ul>
        <li><button><?=$userName?></button>
            <ul>
                <li><button>Logout</button></li>
            </ul>
        </li>
        <li><button>ORIGIN</button>
            <ul class="corner_ul">
                <li><button>Settings</button></li>
            </ul>
        </li>
    </ul>
</nav>

<div class="panel panel-primary no-radius inputPanel">
    <div class="panel-heading no-radius">
        <h3 class="panel-title">Input Fields</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <!--<thead>
                <tr>
                    <th>Field</th>
                    <th> </th>
                    <th>Value</th>
                </tr>
            </thead>-->
            <tbody>
                <tr>
                    <td><label for="pumpType">Pump Type</label></td>
                    <td>:</td>
                    <td>
                        <select id="pumpType" class="form-control no-radius">
                            <option value="1">Centrifugal Pump</option>
                            <option value="2">Submersible Pump</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="pipeDiameter">Pipe Diameter</label></td>
                    <td>:</td>
                    <td>
                        <select id="pipeDiameter" class="form-control no-radius">
                            <option value="3">3 - Inch</option>
                            <option value="4">4 - Inch</option>
                            <option value="6">6 - Inch</option>
                            <option value="8">8 - Inch</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="fixedFooter"><p>Powered by Sincos Automation Technologies Limited.</p></div>
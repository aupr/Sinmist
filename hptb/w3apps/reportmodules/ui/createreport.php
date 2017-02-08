<div class="reportInfo">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tbody>
                    <tr>
                        <td><label for="nm-rcvd-dt">Received Date</label></td>
                        <td>:</td>
                        <td>
                            <input type="text" class="form-control no-radius" id="nm-rcvd-dt">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nm-client">Client</label></td>
                        <td>:</td>
                        <td><input type="text" class="form-control no-radius" id="nm-client"></td>
                    </tr>
                    <tr>
                        <td><label for="nm-clients-ref">Client's Reference</label></td>
                        <td>:</td>
                        <td><input type="text" class="form-control no-radius" id="nm-clients-ref"></td>
                    </tr>
                    <tr>
                        <td><label for="nm-me-ref">ME Reference</label></td>
                        <td>:</td>
                        <td><input type="text" class="form-control no-radius" id="nm-me-ref"></td>
                    </tr>
                    <tr>
                        <td><label for="nm-pump-type">Pump Type</label></td>
                        <td>:</td>
                        <td>
                            <select class="form-control no-radius" id="nm-pump-type">
                                <option value="Centrifugal Pump">Centrifugal Pump</option>
                                <option value="Submersible Pump">Submersible Pump</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nm-pump-discharge">Discharge</label></td>
                        <td>:</td>
                        <td class="input-group">
                            <input type="text" class="form-control no-radius" id="nm-pump-discharge">
                            <div class="input-group-addon no-radius">m<sup>3</sup> / hr</div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nm-pump-sn">Pump SN</label></td>
                        <td>:</td>
                        <td><input type="text" class="form-control no-radius" id="nm-pump-sn"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tbody>
                    <tr>
                        <td><label for="nm-test-dt-tm">Test Dt & Tm</label></td>
                        <td>:</td>
                        <td>
                            <input type="text" class="form-control no-radius" id="nm-test-dt-tm" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nm-supplier">Supplier</label></td>
                        <td>:</td>
                        <td><input type="text" class="form-control no-radius" id="nm-supplier"></td>
                    </tr>
                    <tr>
                        <td><label for="nm-clients-ref-date">CR Date</label></td>
                        <td>:</td>
                        <td><input type="text" class="form-control no-radius" id="nm-clients-ref-date"></td>
                    </tr>
                    <tr>
                        <td><label for="nm-me-ref-date">MR Date</label></td>
                        <td>:</td>
                        <td><input type="text" class="form-control no-radius" id="nm-me-ref-date"></td>
                    </tr>
                    <tr>
                        <td><label for="nm-pipe-dia">Pipe Diameter</label></td>
                        <td>:</td>
                        <td>
                            <select class="form-control no-radius" id="nm-pipe-dia">
                                <option value="3">3 Inch</option>
                                <option value="4" selected>4 Inch</option>
                                <option value="6">6 Inch</option>
                                <option value="8">8 Inch</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nm-pump-head">Head</label></td>
                        <td>:</td>
                        <td class="input-group">
                            <input type="text" class="form-control no-radius" id="nm-pump-head">
                            <div class="input-group-addon no-radius">m</div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nm-motor-sn">Motor SN</label></td>
                        <td>:</td>
                        <td><input type="text" class="form-control no-radius" id="nm-motor-sn"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function onClick(cb) {
        var data={
            "rDt": $("#nm-rcvd-dt").val(),
            "client": $("#nm-client").val(),
            "clientRef": $("#nm-clients-ref").val(),
            "crDt": $("#nm-clients-ref-date").val(),
            "supplier": $("#nm-supplier").val(),
            "meRef": $("#nm-me-ref").val(),
            "mrDt": $("#nm-me-ref-date").val(),
            "pumpType": $("#nm-pump-type").val(),
            "pipeDia": $("#nm-pipe-dia").val(),
            "discharge": $("#nm-pump-discharge").val(),
            "head": $("#nm-pump-head").val(),
            "pumpSn": $("#nm-pump-sn").val(),
            "motorSn": $("#nm-motor-sn").val()
        };
        $.post("reportmodules/action.php",{"command":"insert","for":"report","data":data}, function (res) {
            cb();
        });

    }
    $("#nm-rcvd-dt").datepicker({
        dateFormat:"dd-MM-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $("#nm-clients-ref-date").datepicker({
        dateFormat:"dd-MM-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $("#nm-me-ref-date").datepicker({
        dateFormat:"dd-MM-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    }).datepicker('setDate', 'today');

    $("#nm-pump-type").on("change", function () {
        var opt_1 = '<option value="3">3 Inch</option>';
        var opt_2 = '<option value="4" selected>4 Inch</option>';
        var opt_3 = '<option value="6">6 Inch</option>';
        var opt_4 = '<option value="8">8 Inch</option>';

        if ($(this).val() == "Centrifugal Pump"){
            $("#nm-pipe-dia").html(opt_1+opt_2+opt_3+opt_4);
        }
        else {
            $("#nm-pipe-dia").html(opt_2+opt_3);
        }
    });
</script>


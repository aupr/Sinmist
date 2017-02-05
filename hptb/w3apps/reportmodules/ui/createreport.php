<div class="createReport">
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
            <td><label for="nm-clients-ref-date">Date</label></td>
            <td>:</td>
            <td><input type="text" class="form-control no-radius" id="nm-clients-ref-date"></td>
        </tr>
        <tr>
            <td><label for="nm-supplier">Supplier</label></td>
            <td>:</td>
            <td><input type="text" class="form-control no-radius" id="nm-supplier"></td>
        </tr>
        <tr>
            <td><label for="nm-me-ref">ME Reference</label></td>
            <td>:</td>
            <td><input type="text" class="form-control no-radius" id="nm-me-ref"></td>
        </tr>
        <tr>
            <td><label for="nm-me-ref-date">Date</label></td>
            <td>:</td>
            <td><input type="text" class="form-control no-radius" id="nm-me-ref-date"></td>
        </tr>
        <tr>
            <td><label for="nm-pump-type">Pump Type</label></td>
            <td>:</td>
            <!--<td><input type="text" class="form-control no-radius" id="nm-pump-type"></td>-->
            <td>
                <select class="form-control no-radius" id="nm-pump-type">
                    <option value="Centrifugal Pump">Centrifugal Pump</option>
                    <option value="Submersible Pump">Submersible Pump</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="nm-pipe-dia">Pipe Diameter</label></td>
            <td>:</td>
            <!--<td><input type="text" class="form-control no-radius" id="nm-pipe-dia"></td>-->
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
            <td><label for="nm-pump-discharge">Discharge</label></td>
            <td>:</td>
            <td class="input-group">
                <input type="text" class="form-control no-radius" id="nm-pump-discharge">
                <div class="input-group-addon">m<sup>3</sup> / hr</div>
            </td>
        </tr>
        <tr>
            <td><label for="nm-pump-head">Head</label></td>
            <td>:</td>
            <td class="input-group">
                <input type="text" class="form-control no-radius" id="nm-pump-head">
                <div class="input-group-addon">m</div>
            </td>
        </tr>
        <tr>
            <td><label for="nm-pump-sn">Pump Serial Number</label></td>
            <td>:</td>
            <td><input type="text" class="form-control no-radius" id="nm-pump-sn"></td>
        </tr>
        <tr>
            <td><label for="nm-motor-sn">Motor Serial Number</label></td>
            <td>:</td>
            <td><input type="text" class="form-control no-radius" id="nm-motor-sn"></td>
        </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $("#nm-rcvd-dt").datepicker({
        dateFormat:"dd-MM-yy",
        //inline: true,
        //showOtherMonths: true,
        //dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    });
    //$("#nm-rcvd-dt").datepicker();
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


<div id="edit_tabs">
    <ul>
        <li><a href="#etabs-info">Report Information</a></li>
        <li><a href="#etabs-data">Report Data</a></li>
    </ul>
    <div id="etabs-info">
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
                                    <input type="text" class="form-control no-radius" id="nm-test-dt-tm">
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
    </div>
    <div id="etabs-data">
        <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
    </div>
</div>

<script>
    $( function() {
        $( "#edit_tabs" ).tabs();
    } );
    $("#nm-test-dt-tm").datepicker(
        {
            onClose: function (dt) {
                alert(dt);
                $(this).append("dfasfd");
            },
            closeText: "Close",
            //appendText: "(yyyy-mm-dd)",

            dateFormat:"dd-M-yy",
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            yearRange: "2016:+1",
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        }
    );
    $("#nm-rcvd-dt").datepicker({
        dateFormat:"dd-M-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $("#nm-clients-ref-date").datepicker({
        dateFormat:"dd-M-yy",
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2016:+1",
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
    $("#nm-me-ref-date").datepicker({
        dateFormat:"dd-M-yy",
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
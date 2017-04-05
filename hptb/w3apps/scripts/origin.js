/**
 * Created by Aman Ullah on 1/29/2017.
 */

$(document).ready(function () {

    $("#btn-acc-report").click(function () {
        window.location.replace("report.php");
    });

    $("#btn-mntn-user").click(function () {
        var htmlData =
        '<label for="pass-old">Old Password:</label><input type="password" id="pass-old" class="form-control no-radius">'+
        '<br><label for="pass-new">New Password:</label><input type="password" id="pass-new" class="form-control no-radius">'+
        '<label for="pass-confirm">Confirm Password:</label><input type="password" id="pass-confirm" class="form-control no-radius">'+
        '<div id="pass-message" style="color: red; padding: 10px;"></div>';

        it_modal_open('Change User Password!', htmlData, '#d06800', 0, 'Change, Cancel', function (rbc) {
            if (rbc === 'Change') {
                if ($('#pass-old').val()==='' || $('#pass-new').val()==='' || $('#pass-confirm').val()==='') {
                    $('#pass-message').html('All fields are required!');
                } else {
                    it_modal_loading();
                    $.post('changepasswordui.php', {
                        oldPassword: $('#pass-old').val(),
                        newPassword: $('#pass-new').val(),
                        confirmPassword: $('#pass-confirm').val()
                    }, function (res) {
                        it_modal_close();
                        if (res.match(/Success/g) !== null) {
                            it_modal_open('Success Password Change!', res, 'dodgerblue', 0, 'Close', function (r) {
                                if (r==='Close') {
                                    it_modal_close();
                                }
                            });
                        } else {
                            it_modal_open('Fault on Password Change!', res, '#a80000', 0, 'Try Again, Close', function (r) {
                                if (r==='Close') {
                                    it_modal_close();
                                } else if (r==='Try Again') {
                                    it_modal_close();
                                    $("#btn-mntn-user").click();
                                }
                            });
                        }
                    });
                }
            } else if (rbc === 'Cancel') {
                it_modal_close();
            }
        });
    });

    $("#btn-set-netp").click(function () {
        it_modal_open();
    });

    $("#btn-toggle-fscr").click(function () {
        it_fullscreen_toggle();
    });

    $("#btn-logout-origin").click(function () {
        window.location.replace("logout.php");
    });

});
/**
 * Created by Aman Ullah on 1/29/2017.
 */

$(document).ready(function () {

    $("#btn-acc-report").click(function () {
        window.location.replace("report.php");
    });

    $("#btn-mntn-user").click(function () {
        it_modal_open();
    });

    $("#btn-set-netp").click(function () {
        it_modal_open();
    });

    $("#btn-toggle-fscr").click(function () {
        it_fullscreen_toggle();
    });

});
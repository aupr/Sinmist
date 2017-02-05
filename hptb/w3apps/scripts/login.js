/**
 * Created by Aman Ullah on 1/30/2017.
 */

// Toggle Function
$('.toggle').click(function(){
    // Switches the Icon
    $(this).children('i').toggleClass('fa-plus');
    // Switches the forms
    $('.form').animate({
        height: "toggle",
        'padding-top': 'toggle',
        'padding-bottom': 'toggle',
        opacity: "toggle"
    }, "slow");
});
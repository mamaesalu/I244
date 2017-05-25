$(document).ready(function() {
    var text_max = 200;
    $('#char_left').html(text_max);

    $('#taskid').keyup(function() {
        var text_length = $('#taskid').val().length;
        var remaining = text_max - text_length;

        $('#char_left').html(remaining);
    });
});
$(document ).ready(function() {
    var text_max = 200;
    $text = $('#taskid').val().length
    $('#char_left').text(text_max - $text);
    $('#taskid').keyup(function() {
        var length = $(this).val().length;
        var length = text_max-length;
        $('#char_left').text(length);
    });

});

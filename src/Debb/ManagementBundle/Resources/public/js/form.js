function s4()
{
    return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
}

function guid()
{
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}

$(function ()
{
    $('.noBreakAfterThis').parent().css('float', 'left').css('margin-right', '30px');

    var changed = false;
    var isSubmitted = false;
    var inputCache = {};
    var fieldName = 'data-input-check-id';
    var selector = 'input[type!="file"],select';

    // map fields
    $(selector).each(function ()
    {
        var uid = guid();
        $(this).attr(fieldName, uid);
        inputCache[uid] = $(this).val();
    });

    // funny function, store all input values into an associative array
    var checkField = function ()
    {
        var uid = $(this).attr(fieldName);
        if (uid && typeof inputCache[uid] != "undefined") {
            if (inputCache[uid] != $(this).val()) {
                changed = true;
            }
        }
        else {
            changed = true;
        }
    }

    $('form').bind('submit', function ()
    {
        isSubmitted = true;
    });
    $(window).bind('beforeunload', function ()
    {
        changed = false;
        $(selector).each(checkField);
        if (!isSubmitted && changed) {
            return 'The change are NOT yet saved. Click OK to continue or CANCEL to stay on the site.';
        }
    });
});

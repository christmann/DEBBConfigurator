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

    var changed = false,
        isSubmitted = false,
        selector = 'input,select';

    $(document).on('change', selector, function(e)
    {
        if(e.hasOwnProperty('originalEvent'))
        {
            changed = true;
        }
    });

    $('form').bind('submit', function ()
    {
        isSubmitted = true;
    });
    $(window).bind('beforeunload', function ()
    {
        if (!isSubmitted && changed) {
            return 'The change are NOT yet saved. Click OK to continue or CANCEL to stay on the site.';
        }
    });
});

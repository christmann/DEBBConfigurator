var debbUtils = {
    lastId: 1000,

    generateUniqueId: function(id)
    {
        try
        {
            if(typeof(id) === 'undefined' || typeof(id) === 'number')
            {
                return typeof(id) === 'number' ? ++id : ++debbUtils.lastId;
            }
        } catch (ex) { }
        try
        {
            if($('#' + id).length < 1)
            {
                return id;
            }
        } catch (ex) { }
        try
        {
            if(!id.match(/[0-9]/))
            {
                id = id + '_1';
            }
            while($('#' + id).length > 0)
            {
                id = id.replace(/[0-9]+/g, function(num) { return ++num; })
            }
            return id;
        } catch (ex) { }
    }
};

$(function()
{
	$('[rel="tooltip"]').tooltip();
    $(document).on('click', 'a.addThing[data-prototype]', function(e)
    {
        e.preventDefault();
        $($(this).attr('data-prototype').replace(/__name__/g, debbUtils.generateUniqueId())).hide().appendTo($(this).parents('div:first')).show('slow');
    });
    $(document).on('click', 'a.trash[obj]', function(e)
    {
        e.preventDefault();
        eval($(this).attr('obj')).hide('slow', function()
        {
            $(this).remove();
        });
    });
});
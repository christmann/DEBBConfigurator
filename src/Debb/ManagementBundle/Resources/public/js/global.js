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
	$('[rel="tooltip"]').tooltip({html: true});
	$('label[data-title]').popover({html: true});
	$(document).on('click', 'label[data-title], [data-title][data-content][data-typ="popover"]', function()
	{
		var t = $(this);
		if(t.is('[ispopover]'))
		{
			t.popover('toggle');
		}
		else
		{
			t.attr('ispopover', true).popover({html: true}).popover('show');
		}
	});
    $(document).on('click', 'a.addThing[data-prototype]', function(e)
    {
        e.preventDefault();
        var counter = $(eval($(this).attr('obj'))).find('div').length,
            maxDefined = typeof $(this).attr('maxt') != 'undefined';
        if(!maxDefined || counter < $(this).attr('maxt'))
        {
            $($(this).attr('data-prototype').replace(/__name__/g, debbUtils.generateUniqueId())).hide().appendTo(eval($(this).attr('obj'))).show('slow');
	        $.event.trigger( { type: 'addedThing' } );
        }
        else
        {
            alert(Translator.get('Maximum reached!'));
        }
    });
    $(document).on('click', 'a.trash[obj]', function(e)
    {
        e.preventDefault();
        if(typeof($(this).attr('slow')) !== 'undefined' && $(this).attr('slow').toLowerCase() === 'false')
        {
            eval($(this).attr('obj')).remove();
	        $.event.trigger( { type: 'deletedThing' } );
        }
        else
        {
            eval($(this).attr('obj')).hide('slow', function()
            {
                $(this).remove();
	            $.event.trigger( { type: 'deletedThing' } );
            });
        }
    });
});
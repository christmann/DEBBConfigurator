var rackDragOpt = {
        containment: '#rackContainer',
        scroll: true,
        stack: '.rackG',
        grid: [ 10, 10 ],
        stop: function(event, ui) {
            $(this).draggable('option', 'revert', 'invalid');
            updateRackDimensions(ui.helper);
        }
    },
	rackDropOpt = {};

function updateRackDimensions(rack)
{
    if(typeof(rack) === 'undefined')
    {
        var rack = $('.rackG');
    }
    $(rack).each(function()
    {
        var id = getExactId($(this).find('.rackGform').find('div[id]').attr('id')),
            position = $(this).position(),
            left = position.left,
            bottom = $('#rackContainer').height() - position.top - $(this).outerHeight(true);
        $(this).find('#debb_configbundle_roomtype_racks_' + id + '_posx').val(left);
        $(this).find('#debb_configbundle_roomtype_racks_' + id + '_posy').val(parseInt(bottom) + 1);
    });
}

function setStyleOfRack()
{
    var self = $(this).hasClass('draftRack') ? $(this) : $(this).find('.draftRack:first');
	if(self.hasClass('draftRack'))
	{
		var newRack = self.clone().removeClass('draftRack').addClass('rackG');

		var id = 0;
		$('.rackGform').each(function()
		{
			if(getExactId($(this).find('div[id!=""]').attr('id')) > id)
			{
				id = getExactId($(this).children('div').attr('id'));
				id++;
			}
		});
		id++;

		var prototype = $('#rackContainer').attr('data-prototype'),
			newForm = prototype.replace(/__name__/g, id),
			newFormLi = $('<div class="rackGform" style="display: none;"></div>').append($(newForm).children('div'));
		newFormLi.find('#debb_configbundle_roomtype_racks_' + id + '_rack').val(newRack.attr('rackId'));
		newRack.append(newFormLi);

		newRack.appendTo('#rackContainer').draggable(rackDragOpt).droppable(rackDropOpt);

        newRack.prepend('<a href="#" class="removeRack"><i class="icon-trash"></i></a> - <a class="rotateRack" href="#"><i class="icon-arrow-down"></i></a>');
        newRack.addClass('rack0Deg');
	}
    else
    {
        var newRack = $(this);
    }
	newRack.css('width', (parseFloat(newRack.attr('rackX')) <= 0 ? 99 : parseFloat(newRack.attr('rackX')) * 100 - 1) + 'px');
	newRack.css('height', (parseFloat(newRack.attr('rackZ')) <= 0 ? 99 : parseFloat(newRack.attr('rackZ')) * 100 - 1) + 'px');
	if(typeof newRack.attr('posx') != 'undefined')
	{
		newRack.css('left', (parseInt(newRack.attr('posx')) < 0 ? 0 : parseInt(newRack.attr('posx'))) + 'px');
		newRack.removeAttr('posx');
	}
	if(typeof newRack.attr('posy') != 'undefined')
	{
		newRack.css('bottom', (parseInt(newRack.attr('posy')) < 0 ? $('#rackContainer').height() - newRack.outerHeight(true) : parseInt(newRack.attr('posy'))) + 'px');
		newRack.removeAttr('posy');
	}
    if(!newRack.is('[rotated]'))
    {
        var rotation = objToRot(newRack.find('.rotateRack i'));
        if(rotation == 90 || rotation == 270)
        {
            newRack.width(newRack.width() - 3);
        }
        else
        {
            newRack.height(newRack.height() - 3);
        }
        newRack.css('border-' + rotToClass(rotation, true) + '-width', '4px');
        newRack.attr('rotated', true);
    }
    updateRackDimensions(newRack);
}

function setMinimalRoomSize()
{
    var minX = 50,
        minY = 50;
    $('.rackG').each(function()
    {
        var thisX = $(this).position().left + $(this).outerWidth(true) - 1,
            thisY = $(this).position().top + $(this).outerHeight(true) - 1;
        if(thisX > minX)
        {
            minX = thisX;
        }
        if(thisY > minY)
        {
            minY = thisY;
        }
    });
	$('#rackContainer').resizable('option', 'minHeight', minY).resizable('option', 'minWidth', minX);
}

function objToRot(obj)
{
    obj = typeof(obj) != 'undefined' ? $(obj) : $(this);
    return obj.hasClass('icon-arrow-right') ? 270 : (obj.hasClass('icon-arrow-left') ? 90 : (obj.hasClass('icon-arrow-up') ? 180 : 0));
}

function rotToClass(rot, asHtml)
{
    if(typeof(asHtml) == 'undefined')
    {
        asHtml = false;
    }
    return (asHtml ? '' : 'icon-arrow-') + (rot > 0 && rot < 91 ? 'left' : (rot > 90 && rot < 181 ? (asHtml ? 'top' : 'up') : (rot > 180 && rot < 271 ? 'right' : (asHtml ? 'bottom' : 'down'))));
}

$(function()
{
	$('.eDraftRack').on('click', setStyleOfRack);
	// dynamic size for our room
	$('#rackContainer').resizable({
		grid: 10,
		stop: function( event, ui ) {
			$('#debb_configbundle_roomtype_sizeX').val(ui.helper.width());
			$('#debb_configbundle_roomtype_sizeY').val(ui.helper.height());
            updateRackDimensions();
		},
		resize: function ( event, ui ) {
			$('#rackSizeX').html((parseInt(ui.size.width) / 100).toFixed(2));
			$('#rackSizeY').html((parseInt(ui.size.height) / 100).toFixed(2));
            $('#content').width(parseInt(ui.size.width) + 21);
            ui.helper.css('background-position', '1px ' + parseInt(parseInt(ui.size.height) + 1) + 'px');
		},
        start: function ( event, ui ) {
            setMinimalRoomSize();
        }
	}).droppable({tolerance: 'fit'});
	$(document).on('click', '.removeRack', function(e)
	{
		e.preventDefault();
		$(this).parent('.rackG').remove();
	});
    $(document).on('click', '.rotateRack', function(e)
    {
        e.preventDefault();
        var i = $(this).find('i'),
            rack = $(this).parents('.rackG'),
            rotation = objToRot(i);
        i.removeClass(rotToClass(rotation));
        rack.css('border-' + rotToClass(rotation, true) + '-width', '1px');
        rotation += 90;
        if ( rotation > 270 ) { rotation = 0; }
        if(rotation == 90 || rotation == 270)
        {
            rack.height(rack.height() + 3);
            rack.width(rack.width() - 3);
        }
        else
        {
            rack.height(rack.height() - 3);
            rack.width(rack.width() + 3);
        }
        rack.css('border-' + rotToClass(rotation, true) + '-width', '4px');
        i.addClass(rotToClass(rotation));
        rack.find('input[id$="_rotation"]').val(rotation);
    });
	// a single rack which we could move in our room
	$('.rackG').draggable(rackDragOpt).droppable(rackDropOpt);
	$('.rackG').each(setStyleOfRack);
    $('.rackG').each(function() { $(this).css('top', $(this).position().top + 1); });
});

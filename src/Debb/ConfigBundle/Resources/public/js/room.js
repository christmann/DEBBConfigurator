var rackDragOpt = {
	containment: '#rackContainer',
	scroll: true,
	stack: '.rackG',
	grid: [ 10, 10 ],
	stop: function(event, ui) {
		$(this).draggable('option', 'revert', 'invalid');
		var id = getExactId(ui.helper.find('.rackGform').find('div[id!=""]').attr('id'));
        var left = ui.position.left;
        var bottom = $('#rackContainer').height() - ui.helper.height() - ui.position.top - 1;
        ui.helper.find('#debb_configbundle_roomtype_racks_' + id + '_posx').val(left);
        ui.helper.find('#debb_configbundle_roomtype_racks_' + id + '_posy').val(parseInt(bottom));
	}
},
	rackDropOpt = {};

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
		newRack.css('bottom', (parseInt(newRack.attr('posy')) < 0 ? $('#rackContainer').height() - newRack.outerHeight() : parseInt(newRack.attr('posy'))) + 'px');
		newRack.removeAttr('posy');
	}
}

function setMinimalRoomSize()
{
    var minX = 50;
        minY = 50;
    $('.rackG').each(function()
    {
        var thisX = $(this).position().left + $(this).width() + parseInt($(this).css('borderLeftWidth')),
            thisY = $(this).position().top + $(this).height() + parseInt($(this).css('borderTopWidth'));
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
    return obj.hasClass('icon-arrow-down') ? 0 : (obj.hasClass('icon-arrow-left') ? 90 : (obj.hasClass('icon-arrow-up') ? 180 : 270));
}

function rotToClass(rot)
{
    return 'icon-arrow-' + ( rot > 0 && rot < 91 ? 'left' : (rot > 90 && rot < 181 ? 'up' : (rot > 180 && rot < 271 ? 'right' : 'down')) );
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
            rotation = objToRot(i);
        i.removeClass(rotToClass(rotation));
        rotation += 90;
        i.addClass(rotToClass(rotation));
        $(this).parents('.rackG').find('input[id$="_rotation"]').val(rotation);
    });
	// a single rack which we could move in our room
	$('.rackG').draggable(rackDragOpt).droppable(rackDropOpt);
	$('.rackG').each(setStyleOfRack);
    $('.rackG').each(function() { $(this).css('top', $(this).position().top + parseInt($(this).css('borderTopWidth'))); });
});

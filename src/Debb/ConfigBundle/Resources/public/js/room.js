var rackDragOpt = {
	containment: '#rackContainer',
	scroll: true,
	stack: '.rackG',
	grid: [ 10, 10 ],
	stop: function(event, ui) {
		$(this).draggable('option', 'revert', 'invalid');
		var id = getExactId(ui.helper.find('.rackGform').find('div[id!=""]').attr('id'));
		ui.helper.find('#debb_configbundle_roomtype_racks_' + id + '_posx').val(ui.position.left);
		ui.helper.find('#debb_configbundle_roomtype_racks_' + id + '_posy').val(parseInt(ui.helper.css('bottom')));
	}
},
	rackDropOpt = {};

function setStyleOfRack(newRack)
{
	if(typeof param == 'undefined')
	{
		var newRack = $(this);
	}
	if(newRack.hasClass('draftRack'))
	{
		newRack = $(this).clone().removeClass('draftRack').addClass('rackG');

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
			newFormLi = $('<div class="rackGform" style="display: none;"></div>').append($(newForm).children('div')).before(' - <a href="#" class="removeRack"><i class="icon-trash"></i></a>');
		newFormLi.find('#debb_configbundle_roomtype_racks_' + id + '_rack').val(newRack.attr('rackId'));
		newRack.append(newFormLi);

		newRack.appendTo('#rackContainer').draggable(rackDragOpt).droppable(rackDropOpt);
	}
	newRack.css('width', (parseFloat(newRack.attr('rackX')) <= 0 ? 99 : parseFloat(newRack.attr('rackX')) * 100 - 1) + 'px');
	newRack.css('height', (parseFloat(newRack.attr('rackY')) <= 0 ? 99 : parseFloat(newRack.attr('rackY')) * 100 - 1) + 'px');
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
    var minX = 10;
        minY = 10;
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

$(function()
{
	$('.draftRack').on('click', setStyleOfRack);
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
	// a single rack which we could move in our room
	$('.rackG').draggable(rackDragOpt).droppable(rackDropOpt);
	$('.rackG').each(setStyleOfRack);
    $('.rackG').each(function() { $(this).css('top', ($(this).offset().top - $(this).offsetParent().offset().top - 2)); });
});

var rackDragOpt = {
	containment: '#rackContainer',
	scroll: true,
	snap: '.rackG',
	snapMode: 'outer',
	stack: '.rackG',
	revert: 'invalid',
	stop: function(event, ui) {
		$(this).draggable('option', 'revert', 'invalid');
		var id = getExactId(ui.helper.find('.rackGform').find('div[id!=""]').attr('id'));
		ui.helper.find('#debb_configbundle_roomtype_racks_' + id + '_posx').val(ui.position.left);
		ui.helper.find('#debb_configbundle_roomtype_racks_' + id + '_posy').val(parseInt(ui.helper.css('bottom')));
	}
},
	rackDropOpt = {
	greedy: true,
	tolerance: 'touch',
	drop: function(event, ui){
		ui.draggable.draggable('option', 'revert', true);
	}
};

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
			newFormLi = $('<div class="rackGform" style="display: none;"></div>').append($(newForm).children('div'));
		newFormLi.find('#debb_configbundle_roomtype_racks_' + id + '_rack').val(newRack.attr('rackId'));
		newRack.append(newFormLi);

		newRack.appendTo('#rackContainer').draggable(rackDragOpt).droppable(rackDropOpt);
	}
	newRack.css('width', (parseInt(newRack.attr('rackX')) < 1 ? 100 : parseInt(newRack.attr('rackX'))) + 'px');
	newRack.css('height', (parseInt(newRack.attr('rackY')) < 1 ? 100 : parseInt(newRack.attr('rackY'))) + 'px');
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

$(function()
{
	$('.draftRack').on('click', setStyleOfRack);
	// dynamic size for our room
	$('#rackContainer').resizable({
		stop: function( event, ui ) {
			$('#debb_configbundle_roomtype_sizeX').val(ui.helper.width());
			$('#debb_configbundle_roomtype_sizeY').val(ui.helper.height());
		}
	}).droppable({tolerance: 'fit'});
	// a single rack which we could move in our room
	$('.rackG').draggable(rackDragOpt).droppable(rackDropOpt);
	$('.rackG').each(setStyleOfRack);
});

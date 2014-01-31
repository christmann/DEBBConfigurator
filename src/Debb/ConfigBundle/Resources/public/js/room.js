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
            bottom = Math.round(parseInt($('#rackContainer').height() - position.top - $(this).outerHeight(true)) / 10) * 10,
			oldPosX = parseInt($(this).find('[id$="_posX"], [id$="_posx"]').val()),
			oldPosY = parseInt($(this).find('[id$="_posY"], [id$="_posy"]').val()),
	        selector = $(this).is('[flowPumpId]') ? 'flowPumps' : 'racks';
		if(oldPosX != left && oldPosY != bottom)
		{
			clearCustomPos(this);
		}
		else if(oldPosX != left || oldPosY != bottom)
		{
			clearCustomPos(this, oldPosX != left ? 'X' : 'Y');
		}
        $(this).find('#debb_configbundle_roomtype_' + selector + '_' + id + '_posX').val(left);
        $(this).find('#debb_configbundle_roomtype_' + selector + '_' + id + '_posY').val(bottom);
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

		var prototype = $('#rackContainer').attr('data-prototype-' + (newRack.is('[flowPumpId]') ? 'flowpump' : 'rack')),
			newForm = prototype.replace(/__name__/g, id),
			newFormLi = $('<div class="rackGform" style="display: none;"></div>').append($(newForm).children('div'));
		newFormLi.find('#debb_configbundle_roomtype_' + (newRack.is('[flowPumpId]') ? 'flowPumps' : 'racks') + '_' + id + '_' + (newRack.is('[flowPumpId]') ? 'flowPump' : 'rack')).val(newRack.attr(newRack.is('[flowPumpId]') ? 'flowPumpId' : 'rackId'));
		newRack.append(newFormLi);

		newRack.appendTo('#rackContainer').draggable(rackDragOpt).droppable(rackDropOpt);

        newRack.prepend('<a href="#" class="removeRack"><i class="icon-trash"></i></a> - <a class="rotateRack" href="#"><i class="icon-repeat" style="transform: rotateZ(' + (objToRot(newRack) + 90) + 'deg);"></i></a><br />');
        newRack.addClass('rack0Deg');
	}
    else
    {
        var newRack = $(this);
    }
	newRack.css('width', (parseFloat(newRack.attr('rackx')) <= 0 ? 99 : parseFloat(newRack.attr('rackx')) * 100 - 1) + 'px');
	newRack.css('height', (parseFloat(newRack.attr('rackz')) <= 0 ? 99 : parseFloat(newRack.attr('rackz')) * 100 - 1) + 'px');
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
        var rotation = objToRot(newRack);
        newRack.css('border-' + rotToClass(rotation) + '-width', '4px');
        if(rotation == 90 || rotation == 270)
        {
            var rackHeight = newRack.height();
            newRack.height(newRack.width()).width(rackHeight);
        }
        if(rotation == 90 || rotation == 270)
        {
            newRack.width(newRack.width() - 3);
        }
        else
        {
            newRack.height(newRack.height() - 3);
        }
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
    var rot = parseInt($(obj).find('input[type="hidden"][id$="_rotation"][name$="[rotation]"]').val());
    return isNaN(rot) ? 0 : rot;
}

function rotToClass(rot)
{
    return rot > 0 && rot < 91 ? 'left' : (rot > 90 && rot < 181 ? 'top' : (rot > 180 && rot < 271 ? 'right' : 'bottom'));
}

/**
 * Clears the custom position of object
 * @param obj
 * @returns {jQuery}
 */
function clearCustomPos(obj, mode)
{
	var obj = typeof obj == 'undefined' ? $(this) : $(obj);
	obj.find('[name*="customPos' + (typeof mode == 'undefined' ? '' : mode) + '"]').val('');
	return obj;
}

/**
 * Generates the content of a rack popover (per click on rack)
 *
 * @returns {string} the data-content
 */
function generateTipContent()
{
    var obj = $(this),
        resObj = $('<div style="height: 300px;"></div>'),
		posX = parseInt(obj.find('[name*="posX"]').val()),
		posY = parseInt(obj.find('[name*="posY"]').val()),
		posZ = obj.find('[name*="posZ"]'),
//		rotation = objToRot(obj),
		customPosX = obj.find('[name*="customPosX"]'),
		customPosY = obj.find('[name*="customPosY"]'),
		customPosZ = obj.find('[name*="customPosZ"]');

//	if(rotation == 90 || rotation == 180)
//	{
//		posY += obj.outerHeight(true);
//	}
//	if(rotation == 180 || rotation == 270)
//	{
//		posX += obj.outerWidth(true) - 1;
//	}

    resObj.append('<div>' + Translator.get('Size') + ': ' + obj.attr('rackx') + 'm /' + obj.attr('racky') + 'm /' + obj.attr('rackz') + 'm' + '</div>');
    resObj.append($('<div>' + Translator.get('Actions') + ': </div>').append('<a href="#" class="removeRack"><i class="icon-trash"></i></a> - <a class="rotateRack" href="#"><i class="icon-repeat" style="transform: rotateZ(' + (objToRot(obj) + 90) + 'deg);"></i></a>'
		+ '<br /><br />X: <input type="text" style="width: 100px;" value="' + customPosX.val() + '" class="syncwith" syncwith="#' + customPosX.attr('id') + '" placeholder="' + toNextTen(posX / 100) + '" />m'
		+ '<br />Y: <input type="text" style="width: 100px;" value="' + customPosY.val() + '" class="syncwith" syncwith="#' + customPosY.attr('id') + '" placeholder="' + toNextTen(posY / 100) + '" />m'
		+ '<br />Z: <input type="text" style="width: 100px;" value="' + customPosZ.val() + '" class="syncwith" syncwith="#' + customPosZ.attr('id') + '" placeholder="' + toNextTen(posZ.val() / 100) + '" />m'));
	return resObj;
}

function toNextTen(decimal)
{
	return Math.round(parseFloat(decimal) * 10) / 10;
}

$(function()
{
	$('.eDraftRack').on('click', setStyleOfRack);
	// dynamic size for our room
	$('#rackContainer').resizable({
		grid: 10,
		stop: function( event, ui ) {
			$('#debb_configbundle_roomtype_sizeX').val(ui.helper.width().toFixed(0));
			$('#debb_configbundle_roomtype_sizeZ').val(ui.helper.height().toFixed(0));
            updateRackDimensions();
		},
		resize: function ( event, ui ) {
			$('#rackSizeX').html((parseInt(ui.size.width) / 100).toFixed(2));
			$('#rackSizeZ').html((parseInt(ui.size.height) / 100).toFixed(2));
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
        var obj = $(this).parents('.rackG:first, .popover:first');
        if(obj.is('.popover'))
        {
            obj = obj.prev('.rackG');
        }
        if(typeof(obj.data('popover')) != 'undefined')
        {
            obj.popover('destroy');
        }
        obj.remove();
	});
	// Copied to /src/Debb/ManagementBundle/Resources/public/js/chassis.js:116
    $(document).on('change, keyup', '.syncwith[syncwith]', function(e)
    {
        var obj = $($(this).attr('syncwith'));
        if(obj.length > 0)
        {
            var val = $(this).val();
            if(typeof($(this).attr('maxval')) != 'undefined')
            {
                var maxval = parseFloat($($(this).attr('maxval')).val());
                if(parseFloat(val) > maxval)
                {
                    val = maxval;
                    $(this).val(maxval);
                    e.preventDefault();
                }
            }
            obj.val(val);
        }
    });
    $(document).on('click', '.rotateRack', function(e)
    {
        e.preventDefault();
        var obj = $(this).parents('.rackG:first, .popover:first'),
            rack = obj.is('.popover') ? obj.prev('.rackG') : obj,
            rotation = objToRot(rack);
        rack.css('border-' + rotToClass(rotation) + '-width', '1px');
        rotation += 90;
        if ( rotation > 270 ) { rotation = 0; }
        rack.find('input[id$="_rotation"]').val(rotation);

        var newRack = rack;
        newRack.css('width', (parseFloat(newRack.attr('rackx')) <= 0 ? 99 : parseFloat(newRack.attr('rackx')) * 100 - 1) + 'px');
        newRack.css('height', (parseFloat(newRack.attr('rackz')) <= 0 ? 99 : parseFloat(newRack.attr('rackz')) * 100 - 1) + 'px');
        newRack.css('border-' + rotToClass(rotation) + '-width', '4px');
        if(rotation == 90 || rotation == 270)
        {
            var rackHeight = newRack.height();
            newRack.height(newRack.width()).width(rackHeight);
        }
        if(rotation == 90 || rotation == 270)
        {
            newRack.width(newRack.width() - 3);
        }
        else
        {
            newRack.height(newRack.height() - 3);
        }
        newRack.find('.rotateRack .icon-repeat').css('transform', 'rotateZ(' + (rotation + 90) + 'deg)');
        if(newRack.next().is('.popover'))
        {
            newRack.next('.popover').find('.rotateRack .icon-repeat').css('transform', 'rotateZ(' + (rotation + 90) + 'deg)');
        }
    });
    $(document).on('click', '.rackG', function(e)
    {
        if($(e.target).is('div.rackG'))
        {
            e.preventDefault();
            var mainObj = $(this);
            if(typeof(mainObj.data('popover')) == 'undefined')
            {
                mainObj.popover({html: true, trigger: 'manual', content: generateTipContent}).popover('show');
            }
            else
            {
                mainObj.popover(mainObj.next('div').is('.popover.in:visible') ? 'hide' : 'show');
            }
        }
    });
	// a single rack which we could move in our room
	$('.rackG').draggable(rackDragOpt).droppable(rackDropOpt);
	$('.rackG').each(setStyleOfRack);
    $('.rackG').each(function() { $(this).css('top', $(this).position().top + 1); });
    $('.rackG').popover({html: true, trigger: 'manual', content: generateTipContent});
});

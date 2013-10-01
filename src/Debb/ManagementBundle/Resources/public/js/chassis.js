var currentNode = null,
    rackDragOpt = {
        containment: '#nodegroupContainer',
        scroll: true,
        stack: '.node',
        zIndex: 10000,
        grid: [ 10, 10 ],
        stop: function(event, ui) {
            updateNodeDimensions(ui.helper);
        }
    },
    rackDropOpt = {};

function updateNodeDimensions(node)
{
    if(typeof(node) === 'undefined')
    {
        var node = $('.node');
    }
    $(node).each(function()
    {
        var id = getExactId($(this).find('div[id]').attr('id')),
            position = $(this).position(),
            left = position.left,
            bottom = $('#nodegroupContainer').height() - position.top - $(this).outerHeight(true);
        $(this).find('[id$="_posX"], [id$="_posx"]').val(left);
        $(this).find('[id$="_posY"], [id$="_posy"]').val(parseInt(bottom));
    });
}

function setMinimalRoomSize()
{
    var minX = 150,
        minY = 50;
    $('.node').each(function()
    {
        var thisX = $(this).position().left + $(this).outerWidth(true) - 10,
            thisY = $(this).position().top + $(this).outerHeight(true);
        if(thisX > minX)
        {
            minX = thisX;
        }
        if(thisY > minY)
        {
            minY = thisY;
        }
    });
    minX = minX < 150 ? 150 : minX;
    minY = minY < 50 ? 50 : minY;
    $('#nodegroupContainer').resizable('option', 'minHeight', minY).resizable('option', 'minWidth', minX);
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
 * Generates the content of a node or flow pump popover (per click on node or flow pump)
 *
 * @returns {string} the data-content
 */
function generateTipContent()
{
    var obj = $(this),
        resObj = $('<div style="height: 300px;"></div>');
    resObj.append('<div>' + Translator.get('Size') + ': ' + obj.attr('sizex') + 'm /' + obj.attr('sizey') + 'm /' + obj.attr('sizez') + 'm' + '</div>');
    resObj.append($('<div>' + Translator.get('Actions') + ': </div>').append('<a href="#" class="removeNode"><i class="icon-trash"></i></a> - <a class="rotateNode" href="#"><i class="icon-repeat" style="transform: rotateZ(' + (objToRot(obj) + 90) + 'deg);"></i></a>'));
    return resObj;
}

$(function ()
{
    $('#nodegroupContainer').resizable({
        grid: 10,
        stop: function( event, ui ) {
            $('#debb_managementbundle_chassistype_sizeX').val(ui.helper.width());
            $('#debb_managementbundle_chassistype_sizeY').val(ui.helper.height());
            updateNodeDimensions();
        },
        resize: function ( event, ui ) {
            $('#chassisSizeX').html((parseInt(ui.size.width) / 1000).toFixed(2));
            $('#chassisSizeY').html((parseInt(ui.size.height) / 1000).toFixed(2));
            $('#chassiscontainer').width(parseInt(ui.size.width) + 10);
            $('#content').width(parseInt($('#chassiscontainer').outerWidth(true)) + 16);
            ui.helper.css('background-position', '1px ' + parseInt(parseInt(ui.size.height) + 1) + 'px');
        },
        start: function ( event, ui ) {
            setMinimalRoomSize();
        }
    }).droppable({tolerance: 'fit'});
    $('.node').draggable(rackDragOpt).droppable(rackDropOpt);
    $('.addNode, .addFlowPump').click(function(e)
    {
        e.preventDefault();

        var id = 0;
        $('.node').each(function()
        {
            if(getExactId($(this).find('div[id]').attr('id')) > id)
            {
                id = getExactId($(this).children('div').attr('id'));
                id++;
            }
        });
        id++;

        var container = $('#nodegroupContainer'),
            newNode = $(container.attr('data-prototype' + ($(this).is('.addFlowPump') ? '-flowpump' : '')).replace(/__name__/g, id));

        newNode.appendTo(container).draggable(rackDragOpt).droppable(rackDropOpt);
        updateNodeDimensions(newNode);
	    if($(this).is('.addFlowPump'))
	    {
            var flowPumpTitle = $(this).find('[flowPumpId][title]').attr('title');
		    newNode.find('span.pumpName').text(flowPumpTitle);
		    newNode.attr('data-original-title', flowPumpTitle);
		    newNode.find('[id$="_flowPump"]').val($(this).find('[flowPumpId]').attr('flowPumpId'));
		    var rackX = parseFloat($(this).find('[rackx]').attr('rackx')),
		        rackY = parseFloat($(this).find('[racky]').attr('racky')),
			    rackZ = parseFloat($(this).find('[rackz]').attr('rackz'));
		    newNode.css('width', (rackX <= 0 ? 99 : rackX * 100 - 1) + 'px');
		    newNode.css('height', (rackZ <= 0 ? 99 : rackZ * 100 - 1) + 'px');
            newNode.attr('sizex', rackX).attr('sizey', rackY).attr('sizez', rackZ);
            newNode.find('.rotateNode .icon-repeat').css('transform', 'rotateZ(' + (objToRot(newNode) + 90) + 'deg)');
	    }
    });
    $('.node').each(function()
    {
	    var pump = $(this).find('[id$="_flowPump"]');
	    if(pump.length > 0)
	    {
		    var rackX = parseFloat($('[flowpumpid=' + pump.val() + '][rackx]').attr('rackx')),
			    rackZ = parseFloat($('[flowpumpid=' + pump.val() + '][rackz]').attr('rackz'));
		    $(this).css('width', (rackX <= 0 ? 99 : rackX * 100 - 1) + 'px');
		    $(this).css('height', (rackZ <= 0 ? 99 : rackZ * 100 - 1) + 'px');
	    }
        if(typeof $(this).attr('posx') != 'undefined')
        {
            $(this).css('left', (parseInt($(this).attr('posx')) < 0 ? 0 : parseInt($(this).attr('posx'))) + 'px');
            $(this).removeAttr('posx');
        }
        if(typeof $(this).attr('posy') != 'undefined')
        {
            $(this).css('bottom', (parseInt($(this).attr('posy')) < 0 ? $('#nodegroupContainer').height() - $(this).outerHeight() : parseInt($(this).attr('posy'))) + 'px');
            $(this).removeAttr('posy');
        }
    });
    $(document).on('click', '.removeNode', function(e)
    {
        e.preventDefault();
        var obj = $(this).parents('.node:first, .popover:first');
        if(obj.is('.popover'))
        {
            obj = obj.prev('.node');
        }
        if(typeof(obj.data('popover')) != 'undefined')
        {
            obj.popover('destroy');
        }
        obj.remove();
    });
    $(document).on('click', '.rotateNode', function(e)
    {
        e.preventDefault();
        var obj = $(this).parents('.node:first, .popover:first'),
            node = obj.is('.popover') ? obj.prev('.node') : obj,
            rotation = objToRot(node);
        node.removeClass('node' + rotation + 'Deg');
        rotation += 90;
        if ( rotation > 270 ) { rotation = 0; }
        node.addClass('node' + rotation + 'Deg');
        node.find('input[id$="_rotation"]').val(rotation);
        node.find('.rotateNode .icon-repeat').css('transform', 'rotateZ(' + (rotation + 90) + 'deg)');
        if(node.next().is('.popover'))
        {
            node.next('.popover').find('.rotateNode .icon-repeat').css('transform', 'rotateZ(' + (rotation + 90) + 'deg)');
        }
    });
    $(document).on('click', '.node', function(e)
    {
        if($(e.target).is('div.node, span.pumpName'))
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

	updateNodes();
    $('.node').each(function() { $(this).css('top', $(this).position().top); });
    $('.node').popover({html: true, trigger: 'manual', content: generateTipContent});
});

function updateNodes() {
	var nodes = $('#nodegroup .node'),
		y = 0;
	for(var x = nodes.length - 1; x >= 0; x--)
	{
		$(nodes[x]).find('select').attr('id', 'debb_managementbundle_chassistype_typspec_' + y).attr('name', 'typspec[' + y + ']');
		y++;
	}
}

function getExactId(str) {
	var array = str.split('_');
	return array[array.length - 1];
}

function getFreeId(name, id) {
	if (typeof(id) == 'undefined') {
		id = 0;
	}
	if ($('#' + name + id).length > 0 || $('.' + name + id).length > 0) {
		return getFreeId(name, parseInt(id) + 1);
	}
	return name + id;
}

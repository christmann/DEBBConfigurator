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
        $(this).find('#debb_managementbundle_chassistype_typspecification_' + id + '_posX').val(left);
        $(this).find('#debb_managementbundle_chassistype_typspecification_' + id + '_posY').val(parseInt(bottom));
    });
}

function setMinimalRoomSize()
{
    var minX = 50,
        minY = 50;
    $('.node').each(function()
    {
        var thisX = $(this).position().left + $(this).outerWidth(true),
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
    minY = minY < 50 ? 50 : minY;
    $('#nodegroupContainer').resizable('option', 'minHeight', minY).resizable('option', 'minWidth', minX);
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

$(function ()
{
    $('#nodegroupContainer').resizable({
        grid: 10,
        handles: 's',
        stop: function( event, ui ) {
            $('#debb_managementbundle_chassistype_sizeX').val(ui.helper.width());
            $('#debb_managementbundle_chassistype_sizeY').val(ui.helper.height());
            updateNodeDimensions();
        },
        resize: function ( event, ui ) {
            ui.helper.css('background-position', '1px ' + parseInt(parseInt(ui.size.height) + 1) + 'px');
        },
        start: function ( event, ui ) {
            setMinimalRoomSize();
        }
    }).droppable({tolerance: 'fit'});
    $('.node').draggable(rackDragOpt).droppable(rackDropOpt);
    $('.addNode').click(function(e)
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
            newNode = $(container.attr('data-prototype').replace(/__name__/g, id));

        newNode.appendTo(container).draggable(rackDragOpt).droppable(rackDropOpt);
        updateNodeDimensions(newNode);
    });
    $('.node').each(function()
    {
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
        $(this).parents('.node:first').remove();
    });
    $(document).on('click', '.rotateNode', function(e)
    {
        e.preventDefault();
        var i = $(this).find('i'),
            node = $(this).parents('.node'),
            rotation = objToRot(i);
        i.removeClass(rotToClass(rotation));
        node.removeClass('node' + rotation + 'Deg');
        rotation += 90;
        if ( rotation > 270 ) { rotation = 0; }
        i.addClass(rotToClass(rotation));
        node.addClass('node' + rotation + 'Deg');
        node.find('input[id$="_rotation"]').val(rotation);
    });


	updateNodes();
    $('.node').each(function() { $(this).css('top', $(this).position().top); });
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

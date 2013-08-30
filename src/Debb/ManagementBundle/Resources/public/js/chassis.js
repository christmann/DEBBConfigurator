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
            top = position.top;
        $(this).find('#debb_managementbundle_chassistype_typspecification_' + id + '_posX').val(left);
        $(this).find('#debb_managementbundle_chassistype_typspecification_' + id + '_posY').val(top);
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
            $(this).css('top', (parseInt($(this).attr('posy')) < 0 ? 0 : parseInt($(this).attr('posy'))) + 'px');
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
        var node = $(this).parents('.node'),
            rotation = objToRot(node);
        node.removeClass('node' + rotation + 'Deg');
        rotation += 90;
        if ( rotation > 270 ) { rotation = 0; }
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

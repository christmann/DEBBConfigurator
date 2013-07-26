var currentNode = null,
    rackDragOpt = {
        containment: '#nodegroupContainer',
        scroll: true,
        stack: '.node',
        zIndex: 10000,
        grid: [ 10, 10 ],
        stop: function(event, ui) {
            var id = getExactId(ui.helper.find('div[id]').attr('id')),
                left = ui.position.left,
                bottom = $('#nodegroupContainer').height() - (ui.helper.height() + 1) - ui.position.top - parseInt(ui.helper.css('paddingTop')) - parseInt(ui.helper.css('paddingBottom'));
            ui.helper.find('#debb_managementbundle_chassistype_typspecification_' + id + '_posX').val(left);
            ui.helper.find('#debb_managementbundle_chassistype_typspecification_' + id + '_posY').val(parseInt(bottom));
        }
    },
    rackDropOpt = {};

function setMinimalRoomSize()
{
    var minX = 50,
        minY = 50;
    $('.node').each(function()
    {
        var thisX = $(this).position().left + $(this).width() + parseInt($(this).css('borderLeftWidth')) + parseInt($(this).css('paddingLeft')) + parseInt($(this).css('paddingRight')),
            thisY = $(this).position().top + $(this).height() + parseInt($(this).css('borderTopWidth')) + parseInt($(this).css('paddingTop')) + parseInt($(this).css('paddingBottom'));
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
    return obj.hasClass('icon-arrow-down') ? 0 : (obj.hasClass('icon-arrow-left') ? 90 : (obj.hasClass('icon-arrow-up') ? 180 : 270));
}

function rotToClass(rot, asHtml)
{
    if(typeof(asHtml) == 'undefined')
    {
        asHtml = false;
    }
    return (asHtml ? '' : 'icon-arrow-') + (rot > 0 && rot < 91 ? 'left' : (rot > 90 && rot < 181 ? (asHtml ? 'top' : 'up') : (rot > 180 && rot < 271 ? 'right' : (asHtml ? 'bottom' : 'down'))));
}

$(function () {
	$('#debb_managementbundle_chassistype_slotsX, #debb_managementbundle_chassistype_slotsY').change(function () {
		var slotsX = $('#debb_managementbundle_chassistype_slotsX'),
			slotsY = $('#debb_managementbundle_chassistype_slotsY');
		updateNodegroupSize(slotsX, slotsY);
		$('#nodegroup').width(parseInt(slotsX.val()) * 71);
		$('#nodegroup').height(parseInt(slotsY.val()) * 52);
		var nodes = parseInt(slotsX.val()) * parseInt(slotsY.val()),
			nodeArr = $('#nodegroup').find('.node');
		if (nodeArr.length > nodes) {
			for (var x = nodes; x < nodeArr.length; x++) {
				$(nodeArr[x]).remove();
			}
		}
		else {
			for (var x = nodeArr.length; x < nodes; x++) {
				addNode(x);
			}
		}
		updateNodes();
	}).change();
	/* works with input fields and select fields at the moment */
	$(document).on('keyup change', '[refto!=""]', function()
	{
		$('#' + $(this).attr('refto')).val($(this).val());
	});



    $('#nodegroupContainer').resizable({
        grid: 10,
        handles: 's',
        stop: function( event, ui ) {
            $('#debb_managementbundle_chassistype_sizeX').val(ui.helper.width());
            $('#debb_managementbundle_chassistype_sizeY').val(ui.helper.height());
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
        $(this).css('top', $(this).position().top + parseInt($(this).css('borderTopWidth')));
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
        rotation += 90;
        i.addClass(rotToClass(rotation));
        node.find('input[id$="_rotation"]').val(rotation);
    });


	updateNodes();
});

function updateNodegroupSize(slotsX, slotsY)
{
	if(typeof(slotsX) == 'undefined')
	{
		var slotsX = $('#debb_managementbundle_chassistype_slotsX');
	}
	if(typeof(slotsY) == 'undefined')
	{
		var slotsY = $('#debb_managementbundle_chassistype_slotsY');
	}
	$('#nodegroup').width(parseInt(slotsX.val()) * 71);
	$('#nodegroup').height(parseInt(slotsY.val()) * 48);
	$('.nodegroupSpaceInfo').css('margin-top', parseInt(parseInt($('#nodegroup').height()) * 0.49));
}

function addNode(x)
{
//	var id = getFreeId('debb_managementbundle_chassistype_typspec_', typeof(x) == 'undefined' ? $('#nodegroup .node').length : x);
//	$('#nodegroup').append($('#nodegroup').attr('data-prototype').replace(/__name__/g, getExactId(id)));
}

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

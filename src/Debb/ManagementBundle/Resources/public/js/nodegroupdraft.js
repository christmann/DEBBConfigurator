var currentNode = null;

$(function () {
	$('#debb_managementbundle_nodegroupdrafttype_slotsX, #debb_managementbundle_nodegroupdrafttype_slotsY').change(function () {
		var slotsX = $('#debb_managementbundle_nodegroupdrafttype_slotsX'),
			slotsY = $('#debb_managementbundle_nodegroupdrafttype_slotsY');
		updateNodegroupSize(slotsX, slotsY);
		$('#nodegroup').width(parseInt(slotsX.val()) * 71);
		$('#nodegroup').height(parseInt(slotsY.val()) * 71);
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
	updateNodes();
});

function updateNodegroupSize(slotsX, slotsY)
{
	if(typeof(slotsX) == 'undefined')
	{
		var slotsX = $('#debb_managementbundle_nodegroupdrafttype_slotsX');
	}
	if(typeof(slotsY) == 'undefined')
	{
		var slotsY = $('#debb_managementbundle_nodegroupdrafttype_slotsY');
	}
	$('#nodegroup').width(parseInt(slotsX.val()) * 71);
	$('#nodegroup').height(parseInt(slotsY.val()) * 71);
	$('.nodegroupSpaceInfo').css('margin-top', parseInt(parseInt($('#nodegroup').height()) * 0.49));
}

function addNode(x)
{
	var id = getFreeId('debb_managementbundle_nodegroupdrafttype_typspec_', typeof(x) == 'undefined' ? $('#nodegroup .node').length : x);
	$('#nodegroup').append($('#nodegroup').attr('data-prototype').replace(/__name__/g, getExactId(id)));
}

function updateNodes() {
	var nodes = $('#nodegroup .node'),
		y = 0;
	for(var x = nodes.length - 1; x >= 0; x--)
	{
		$(nodes[x]).find('select').attr('id', 'debb_managementbundle_nodegroupdrafttype_typspec_' + y).attr('name', 'typspec[' + y + ']');
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

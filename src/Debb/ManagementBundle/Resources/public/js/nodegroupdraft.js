$(function () {
	$('#debb_managementbundle_nodegroupdrafttype_slotsX, #debb_managementbundle_nodegroupdrafttype_slotsY').change(function () {
		var slotsX = $('#debb_managementbundle_nodegroupdrafttype_slotsX'),
			slotsY = $('#debb_managementbundle_nodegroupdrafttype_slotsY');
		$('#nodegroup').width(parseInt(slotsX.val()) * 141);
		$('#nodegroup').height(parseInt(slotsY.val()) * 89);
		var nodes = parseInt(slotsX.val()) * parseInt(slotsY.val()),
			nodeArr = $('#nodegroup').find('.node');
		if (nodeArr.length > nodes) {
			for (var x = nodes; x < nodeArr.length; x++) {
				$(nodeArr[x]).remove();
			}
		}
		else {
			for (var x = nodeArr.length; x < nodes; x++) {
				var id = getFreeId('debb_managementbundle_nodegroupdrafttype_typspec_', x);
				$('#nodegroup').append($('#nodegroup').attr('data-prototype').replace(/__name__/g, getExactId(id)));
			}
		}
		updateNodes();
	});
	$('#debb_managementbundle_nodegroupdrafttype_slotsX').change();
	updateNodes();
});

function updateNodes() {
	var nodes = $('.node'),
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

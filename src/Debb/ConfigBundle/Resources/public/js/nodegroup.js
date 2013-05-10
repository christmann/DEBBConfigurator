$(function () {
	$('#node-chooser').on('change', function () {
		var selected = $(this).find('option:selected');
		if (typeof(selected.attr('img')) != 'undefined') {
			$('#node-pic').css('background-image', 'url("' + selected.attr('img') + '")');
		}
		else {
			$('#node-pic').css('background-image', '');
		}
		if (typeof(selected.attr('text')) != 'undefined') {
			$('#node-pic').html(selected.attr('text'));
			$('#node-pic [rel="tooltip"]').tooltip();
		}
		else {
			$('#node-pic').html('');
		}
	});
	$(document).on('click', '.selectNode', function (e) {
		if ($('.adopt').attr('field') != null) {
			$('#debb_configbundle_nodegrouptype_nodes_' + $('.adopt').attr('field') + '_node').parents('.node').removeClass('nodeSelected');
		}
		var nodeId = $(this).parents('.node').find('[id$="_node"]').val(),
			field = getExactId($(this).parents('.node').find('div:first').attr('id'));
		if (nodeId == null) {
			nodeId = 0;
		}
		$('#node-chooser').val(nodeId);
		$('#node-chooser').change();
		$('.adopt').show();
		$('.adopt').attr('field', field);
		$(this).parents('.node').addClass('nodeSelected');
		e.preventDefault();
	});
	$('#debb_configbundle_nodegrouptype_draft').change(function () {
		var obj = $(this).find('option:selected:first');
		if (obj.length > 0) {
			$('#nodegroup').css('background-image', 'url("' + obj.attr('image') + '")');
			$('#nodegroup').width(parseInt(obj.attr('slotsx')) * 141);
			$('#nodegroup').height(parseInt(obj.attr('slotsy')) * 89);
			var nodes = parseInt(obj.attr('slotsx')) * parseInt(obj.attr('slotsy')),
				nodeArr = $('#nodegroup').find('.node');
			if (nodeArr.length > nodes) {
				for (var x = nodes; x < nodeArr.length; x++) {
					$(nodeArr[x]).remove();
				}
			}
			else {
				for (var x = nodeArr.length; x < nodes; x++) {
					var id = getFreeId('debb_configbundle_nodegrouptype_nodes_', x);
					$('#nodegroup').append($('#nodegroup').attr('data-protoype').replace(/__name__/g, getExactId(id)));
					$('#' + id + '_nodeGroup').val(nodeGroupId);
				}
			}
			updateNodes();
		}
	});
	$('.adopt').on('click', function (e) {
		var field = $(this).attr('field');
		$('#debb_configbundle_nodegrouptype_nodes_' + field + '_node').val($('#node-chooser').val() > 0 ? $('#node-chooser').val() : '');
		$('#debb_configbundle_nodegrouptype_nodes_' + field + '_node').parents('.node').removeClass('nodeSelected');
		$('.adopt').removeAttr('field');
		$('#node-chooser').val(0);
		$('#node-chooser').change();
		$('.adopt').hide();
		updateNodes();
		e.preventDefault();
	});
	$('#node-chooser').change();
	$('#debb_configbundle_nodegrouptype_draft').change();
	updateNodes();
});

function updateNodes() {
	$('.nodeTitle').each(function () {
		var node = $(this).parents('.node'),
			nodeId = $(node).find('[id$="_node"]').val();
		$(this).html($('#node-chooser [value="' + (nodeId == null ? '0' : nodeId) + '"]').html());
	});
	var nodes = $('.node'),
		y = 0;
	for(var x = nodes.length - 1; x >= 0; x--)
	{
		$(nodes[x]).find('input[id$="_field"]').val(y);
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

$(function()
	{
		$('#node-chooser').on('change', function()
		{
			var selected = $(this).find('option:selected');
			if(typeof(selected.attr('img')) != 'undefined')
			{
				$('#node-pic').css('background-image', 'url("' + selected.attr('img') + '")');
			}
		});
		$(document).on('click', '.selectNode', function(e)
		{
			var nodeId = $(this).parents('.node').find('[id$="_node"]').val(),
				field = getExactId($(this).parents('.node').find('div:first').attr('id'));
			if(nodeId == null)
			{
				nodeId = 0;
			}
			$('#node-chooser').val(nodeId);
			$('#node-chooser').change();
			$('#node-chooser').removeAttr('disabled');
			$('.adopt').attr('field', field);
			e.preventDefault();
		});
		$('.adopt').on('click', function(e)
		{
			var field = $(this).attr('field');
			$('#debb_configbundle_nodegrouptype_nodes_' + field + '_node').val($('#node-chooser').val());
			$('.adopt').removeAttr('field');
			$('#node-chooser').attr('disabled', 'disabled');
			$('#node-chooser').val(0);
			updateNodes();
			e.preventDefault();
		});
		$('#node-chooser').change();
		updateNodes();
	});

function updateNodes()
{
	$('.nodeTitle').each(function()
	{
		var node = $(this).parents('.node'),
			nodeId = $(node).find('[id$="_node"]').val();
		$(this).html($('#node-chooser [value="' + nodeId + '"]').html());
	});
}

function getExactId(str)
{
	var array = str.split('_');
	return array[array.length - 1];
}

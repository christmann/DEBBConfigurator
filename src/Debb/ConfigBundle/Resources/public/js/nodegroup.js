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
			var nodeId = $(this).parents('.node').find('[id$="_node"] [selected="selected"]').val(),
				field = getExactId($(this).parents('.node').find('div:first').attr('id'));
			if(typeof(nodeId) == undefined || nodeId.length < 1)
			{
				nodeId = 0;
			}
			$('#node-chooser').val(nodeId);
			$('.adopt').attr('field', field);
			e.preventDefault();
		});
		$('.adopt').on('click', function(e)
		{
			var field = $(this).attr('field');
			$('#debb_configbundle_nodegrouptype_nodes_' + field + '_node option[value="' + $('#node-chooser option:selected') + '"]').attr('selected', 'selected')
			$('.adopt').removeAttr('field');
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
		var node = $(this).parents('node'),
			nodeId = $(node).find('[id$="_node"]').val();
		$(this).html($('#node-chooser [value="' + nodeId + '"]').html());
	});
}

function getExactId(str)
{
	var array = str.split('_');
	return array[array.length - 1];
}

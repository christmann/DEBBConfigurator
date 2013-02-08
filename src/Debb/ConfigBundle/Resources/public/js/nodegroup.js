$(function()
	{
		$('#node-chooser').on('change', function()
		{
			var selected = $(this).find('option:selected');
			if(typeof(selected.attr('img')) != 'undefined')
			{
				$('#node-pic').css('background-image', 'url("' + selected.attr('img') + '")');
			}
			else
			{
				$('#node-pic').css('background-image', '');
			}
			if(typeof(selected.attr('text')) != 'undefined')
			{
				$('#node-pic').html(selected.attr('text'));
				$('#node-pic [rel="tooltip"]').tooltip();
			}
			else
			{
				$('#node-pic').html('');
			}
		});
		$(document).on('click', '.selectNode', function(e)
		{
			if($('.adopt').attr('field') != null)
			{
				$('#debb_configbundle_nodegrouptype_nodes_' + $('.adopt').attr('field') + '_node').parents('.node').removeClass('nodeSelected');
			}
			var nodeId = $(this).parents('.node').find('[id$="_node"]').val(),
				field = getExactId($(this).parents('.node').find('div:first').attr('id'));
			if(nodeId == null)
			{
				nodeId = 0;
			}
			$('#node-chooser').val(nodeId);
			$('#node-chooser').change();
			$('.adopt').show();
			$('.adopt').attr('field', field);
			$(this).parents('.node').addClass('nodeSelected');
			e.preventDefault();
		});
		$('.adopt').on('click', function(e)
		{
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
		updateNodes();
	});

function updateNodes()
{
	$('.nodeTitle').each(function()
	{
		var node = $(this).parents('.node'),
			nodeId = $(node).find('[id$="_node"]').val();
		$(this).html($('#node-chooser [value="' + (nodeId == null ? '0' : nodeId) + '"]').html());
	});
}

function getExactId(str)
{
	var array = str.split('_');
	return array[array.length - 1];
}

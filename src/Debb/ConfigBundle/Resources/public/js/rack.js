$(function()
	{
		$('#selectedNodeGroup').on('change', function()
		{
			var fieldId = $(this).attr('field');
			if(fieldId != null)
			{
				$('#selectedNodeGroup').removeAttr('field');
				$('#debb_configbundle_racktype_nodegroups_' + fieldId + '_nodegroup').val($('#selectedNodeGroup').val());
				$('#selectedNodeGroup').val(0);
				$('#selectedNodeGroup').attr('disabled', 'disabled');
				updateRack();
			}
		});
		$(document).on('click', '.nodegroup', function(e)
		{
			var nodeGroupId = $(this).find('[id$="_nodegroup"]').val(),
				field = getExactId($(this).find('div:first').attr('id'));
			if(nodeGroupId == null)
			{
				nodeGroupId = 0;
			}
			$('#selectedNodeGroup').val(nodeGroupId);
			$('#selectedNodeGroup').attr('field', field);
			$('#selectedNodeGroup').removeAttr('disabled');
			updateRack();
			e.preventDefault();
		});
		updateRack();
	});

function updateRack()
{
	// free units
	var freeUnits = 0;
	$('[id$="_nodegroup"]').each(function()
	{
		if($(this).val() == null && $(this).val() < 1)
		{
			freeUnits++;
			if($(this).parents('.nodegroup:first').hasClass('nodegroup-selected'))
			{
				$(this).parents('.nodegroup:first').removeClass('nodegroup-selected');
			}
		}
		else if(!$(this).parents('.nodegroup:first').hasClass('nodegroup-selected'))
		{
			$(this).parents('.nodegroup:first').addClass('nodegroup-selected');
		}
	});
	$('#freeUnits').html(freeUnits);

	// selected unit
	var selectedFieldId = $('#selectedNodeGroup').attr('field');
	if(selectedFieldId != null)
	{
		$('#selectedUnit').html(parseInt($('#debb_configbundle_racktype_nodegroups_' + selectedFieldId + '_field').val()) + 1);
	}
	else
	{
		$('#selectedUnit').html(Translator.get('none'));
	}
}

function getExactId(str)
{
	var array = str.split('_');
	return array[array.length - 1];
}

$(function()
	{
		$('#selectedNodeGroup').on('change', function()
		{
			$('[class^="nodegroup_infos_"]').hide();
			$('.nodegroup_infos_' + $(this).val()).show();
		});
		$('.selectNodeGroup').on('click', function(e)
		{
			e.preventDefault();
			var fieldId = $('#selectedNodeGroup').attr('field');
			if(fieldId != null)
			{
				$('#debb_configbundle_racktype_nodegroups_' + fieldId).parent().removeClass('nodegroup-checked');
				$('#selectedNodeGroup').removeAttr('field');
				var value = $('#selectedNodeGroup').val();
				$('#debb_configbundle_racktype_nodegroups_' + fieldId + '_nodegroup').val(value);
				$('.nodegroup_infos_' + value).hide();
				$('#selectedNodeGroup').val(0);
				$('#selectedNodeGroup').attr('disabled', 'disabled');
				$('#selectedNodeGroup').change();
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
			if($('#selectedNodeGroup').attr('field') != null)
			{
				$('.nodegroup-checked').removeClass('nodegroup-checked');
				$('[class^="nodegroup_infos_"]').hide();
			}
			$(this).addClass('nodegroup-checked');
			$('#selectedNodeGroup').val(nodeGroupId);
			$('#selectedNodeGroup').attr('field', field);
			$('#selectedNodeGroup').removeAttr('disabled');
			$('#selectedNodeGroup').change();
			updateRack();
			e.preventDefault();
		});
		updateRack();
		$('#selectedNodeGroup').change();
		$('[class^="nodegroup_infos_"] [rel="tooltip"]').tooltip();
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

	// names of node groups in rack
	$('[id^="debb_configbundle_racktype_nodegroups_"][id$="_title"]').each(function()
	{
		$(this).html($('#selectedNodeGroup option[value="' + $(this).prev('div[id!=""]').find('select[id$="_nodegroup"]').val() + '"]').html());
	});
}

function getExactId(str)
{
	var array = str.split('_');
	return array[array.length - 1];
}

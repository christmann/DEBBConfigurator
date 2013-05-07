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

                // get HE size
                var size = parseInt($('#selectedNodeGroup').find(':selected').attr('size'));

                // Check size
                var enoughSpace = true,
                    i = parseInt(fieldId)
                    max = parseInt(fieldId) + size;


                for (y = 0; y < max; y++)
                {
                    var obj = $('#debb_configbundle_racktype_nodegroups_' + i + '_nodegroup');
                    console.log(obj);
                    if (obj != 'undefined')
                    {
                        if (obj.val() != '')
                        {
                            enoughSpace  = false;
                            break;
                        }
                    }
                    else
                    {
                        enoughSpace  = false;
                        break;
                    }
                    i++;
                }

                if (enoughSpace)
                {
                    $('#debb_configbundle_racktype_nodegroups_' + fieldId + '_nodegroup').val(value > 0 ? value : '');
                    $('.nodegroup_infos_' + value).hide();
                    $('#selectedNodeGroup').val(0);
                    $('#selectedNodeGroup').attr('disabled', 'disabled');
                    $('#selectedNodeGroup').change();
                    $('#emptyval').hide();
                    updateRack();
                }
                else
                {
                    alert('Not enough space..');
                }
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
			$('#emptyval').show();
			updateRack();
			e.preventDefault();
		});
		$(document).on('change', '.updateRackSize', function()
		{
			var rack = $('.rack'),
				nodeGroup = $('.nodegroup'),
				nodeGroupSize = $(this).val();
			if(nodeGroup.length < nodeGroupSize)
			{
				var counter = nodeGroup.length < 1 ? -1 : getExactId($(nodeGroup[nodeGroup.length - 1]).find('div[id!=""]').attr('id'));
				for(var id = parseInt(counter) + 1; id < nodeGroupSize; id++)
				{
					var prototype = rack.attr('data-prototype'),
						newForm = prototype.replace(/__name__/g, id),
						newFormLi = $('<div />').addClass('nodegroup').append($(newForm).children('div').css('display', 'none'));
					newFormLi.append($('<span />').attr('id', 'debb_configbundle_racktype_nodegroups_' + id + '_title'));
					rack.append(newFormLi);
				}
			}
			else if(nodeGroup.length > nodeGroupSize)
			{
				var i = 0;
				nodeGroup.each(function()
				{
					i++;
					if(i > nodeGroupSize)
					{
						$(this).remove();
					}
				});
			}
			updateRack();
		});
		$('#selectedNodeGroup').change();
		$('.updateRackSize').change();
		updateRack();
		$('[class^="nodegroup_infos_"] [rel="tooltip"]').tooltip();
	});

function updateRack()
{
    console.log('Updateing...');
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
		var value = $(this).prev('div[id!=""]').find('select[id$="_nodegroup"]').val();
		$(this).html(value > 0 ? $('#selectedNodeGroup option[value="' + value + '"]').html() : '');
	});

	// update field ids
	var nodeGroups = $('.nodegroup'),
		x = 0;
	nodeGroups.each(function()
	{
		x++;
		$(this).find('input[id$="_field"]').val(nodeGroups.length - x);
	});
}

function getExactId(str)
{
	var array = str.split('_');
	return array[array.length - 1];
}

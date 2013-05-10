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
				var value = parseInt($('#selectedNodeGroup').val());

                // get HE and rack size
                var size = parseInt($('#selectedNodeGroup').find(':selected').attr('size'));
                var rackSize = parseInt($('#debb_configbundle_racktype_nodeGroupSize').val());

                var enoughSpace = true;
                var startSlot = fieldId;

                // Check rack size
                if (value > 0 && size <= rackSize && size != 1)
                {
                    var up = parseInt(fieldId);
                    var freeSlots = 1;
                    enoughSpace = false;

                    // Free slots up
                    for (i=up-1; i >= 0; i--)
                    {
                        var obj = $('#debb_configbundle_racktype_nodegroups_' + i + '_nodegroup');

                        // empty object??
                        if (obj != 'undefined' && obj.val() == '' && obj.parent().parent().parent().css('display') != 'none')
                        {
                            startSlot = i;
                            freeSlots++;

                            if (freeSlots >= size)
                            {
                                enoughSpace = true;
                                break;
                            }
                        }
                        else
                        {
                            break;
                        }
                    }

                    // Free slots down
                    if (!enoughSpace)
                    {
                        for (i=up+1; i <= rackSize; i++)
                        {
                            var obj = $('#debb_configbundle_racktype_nodegroups_' + i + '_nodegroup');

                            // empty object??
                            if (obj != 'undefined' && obj.val() == '')
                            {
                                freeSlots++;

                                if (freeSlots >= size)
                                {
                                    enoughSpace = true;
                                    break;
                                }
                            }
                            else
                            {
                                break;
                            }
                        }
                    }
                }
                else if (size > rackSize)
                {
                    enoughSpace = false;
                }

                if (enoughSpace)
                {
                    $('#debb_configbundle_racktype_nodegroups_' + startSlot + '_nodegroup').val(value > 0 ? value : '');
                    $('#debb_configbundle_racktype_nodegroups_' + startSlot + '_title').attr('size', size);
                    $('.nodegroup_infos_' + value).hide();
                    $('#selectedNodeGroup').val(0);
                    $('#selectedNodeGroup').attr('disabled', 'disabled');
                    $('#selectedNodeGroup').change();
                    $('#emptyval').hide();
                    updateRack();
                }
                else
                {
                    alert(Translator.get('nospace'));
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

    // Change sizes...
    $('.nodegroup').show();
    $('.nodegroup').css('height', '10px');

    // Modify sizes
    $('.nodegroup').each(function()
    {
        var num = $(this).children('div').attr('id').split('_');
        num = parseInt(num[num.length-1]);
        var group = this;
        if ($(this).find('select[id$="_nodegroup"]').val() != '')
        {
            var size = parseInt($(this).children('span').attr('size'));
            var hei = $(this).height() * size;
            $(this).css('height', hei + 'px');
            if (size > 1)
            {
                var end = size + num;
                for (i = num + 1; i < end; i++)
                {
                    $('#debb_configbundle_racktype_nodegroups_' + i + '_title').parent().hide();
                }
            }
        }
    });

	// names of node groups in rack
	$('[id^="debb_configbundle_racktype_nodegroups_"][id$="_title"]').each(function()
	{
		var value = $(this).prev('div[id!=""]').find('select[id$="_nodegroup"]').val();
		$(this).html(value > 0 ? $('#selectedNodeGroup option[value="' + value + '"]').html() : '');
	});

	// update field ids
	var nodeGroups = $('.nodegroup:visible'),
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

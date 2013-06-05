var TYPE_NOTHING = 0;
var TYPE_MAINBOARD = 1;
var TYPE_PROCESSOR = 2;
var TYPE_COOLING_DEVICE = 3;
var TYPE_MEMORY = 4;
var TYPE_POWER_SUPPLY = 5;
var TYPE_STORAGE = 6;

$(function()
	{
		$(document).on('click', '.addComponent', function(e)
		{
			var id = 0;
			$('.component').each(function()
			{
				if(getExactId($(this).find('div[id!=""]').attr('id')) > id)
				{
					id = getExactId($(this).children('div').attr('id'));
					id++;
				}
			});
			id++;
			var type = $(this).parents('.component:first').find('input[id$="_type"]').attr('value'),
				selectBox = $(this).parents('.component:first').find('[id$="_amount"]');
			if(parseInt(selectBox.val()) < 1 || (type != TYPE_PROCESSOR && type != TYPE_POWER_SUPPLY && type != TYPE_MAINBOARD))
			{
				var prototype = $('.componentBox').attr('data-prototype'),
					newForm = prototype.replace(/__name__/g, id),
					newFormLi = $('<div class="component"></div>').append($(newForm).children('div'))
						.append('<div class="componentExtras"><div class="addComponent"><i class="icon-plus"></i></div><div class="delComponent"><i class="icon-remove"></i></div></div>');
				$(newFormLi).find('#debb_configbundle_nodetype_components_' + id + '_amount').val(1);
				$(this).parents('.component:first').after(newFormLi);
				$('#debb_configbundle_nodetype_components_' + id + '_type').attr('value', type);
				if(parseInt(selectBox.val()) < 1)
				{
					$(this).parents('.component:first').remove();
				}
				updateComponents();
			}
			else
			{
				alert(Translator.get('only.one.of.this'));
			}
			e.preventDefault();
		});
		$(document).on('click', '.delComponent', function(e)
		{
			var type = $(this).parents('.component:first').find('[id$="_type"]').attr('value');
			if($(this).parents('[class^="componentBox"]').find('[id$="_type"][value="' + type + '"]').length <= 1)
			{
				var selectBox = $(this).parents('.component:first').find('[id$="_amount"]');
				if(selectBox.find('option[value="0"]').length < 1)
				{
					selectBox.prepend('<option value="0" selected="selected">0</option>');
					$(this).parents('.component').css('height', '33px');
					$(this).parents('.componentExtras').css('height', '29px');
				}
				selectBox.val(0);
			}
			else
			{
				$(this).parents('.component:first').remove();
			}
			updateComponents();
			e.preventDefault();
		});
		$(document).on('click', '.delAmount', function(e)
		{
			var selectBox = $(this).parents('.amountExtras').parent().find('select[id$="_amount"]');
			if(selectBox.find('option:selected').prev().length > 0)
			{
				selectBox.val(parseInt(selectBox.val()) - 1);
			}
			else
			{
				$(this).parents('.component:first').find('.delComponent').click();
			}
			e.preventDefault();
		});
		$(document).on('click', '.addAmount', function(e)
		{
			var selectBox = $(this).parents('.amountExtras').parent().find('select[id$="_amount"]');
			if(selectBox.find('option:selected').next().length > 0)
			{
				selectBox.val(parseInt(selectBox.val()) + 1);
			}
			else if(selectBox.find('option:last').is(':selected'))
			{
				var component = $(this).parents('.component');
				component.find('.addComponent').click();
				var newComponent = component.next('.component');
				component.find('select[id!=""]:not([id$="_amount"])').each(function()
				{
					var cache = $(this).attr('id').split('_');
					cache = cache[cache.length - 1];
					newComponent.find('select[id$="_' + cache + '"]').val($(this).val());
				});
			}
			e.preventDefault();
		});
        $('#debb_configbundle_nodetype_type').change(function()
        {
            if($(this).val() == -1)
            {
                $('#debb_managementbundle_nodetypetype_name').val('');
                $('#addnodetype').modal('show');
            }
        });
        $('#addnodetype [data-dismiss="modal"]').click(function()
        {
            $('#debb_managementbundle_nodetypetype_name').val('');
            $('#debb_configbundle_nodetype_type').val('');
        });
        $('.submitNodeType').click(function(e)
        {
            e.preventDefault();

            var val = $('#debb_managementbundle_nodetypetype_name').val();
            $('#debb_configbundle_nodetype_type option:last').before('<option value="' + val + '">' + val + '</option>');
            $('#debb_configbundle_nodetype_type').val(val);
            $('#addnodetype').modal('hide');
        });
		updateComponents();
	});

function updateComponents() {
	$('.component').find('input, select, label, .amountExtras').hide();
	$('.component').each(function()
	{
		var id = getExactId($(this).find('div:first').attr('id')),
			type = $('#debb_configbundle_nodetype_components_' + id + '_type').attr('value'),
			amount = parseInt($('#debb_configbundle_nodetype_components_' + id + '_amount').attr('value'));

		if(type != TYPE_NOTHING && amount > 0)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_amount').parent().find('input, select, label, .amountExtras').show();
		}
		if(type == TYPE_MAINBOARD)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_mainboard').parent().find('input, select, label, .amountExtras').show();
		}
		else if(type == TYPE_PROCESSOR)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_processor').parent().find('input, select, label, .amountExtras').show();
		}
		else if(type == TYPE_COOLING_DEVICE)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_coolingDevice').parent().find('input, select, label, .amountExtras').show();
		}
		else if(type == TYPE_MEMORY)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_memory').parent().find('input, select, label, .amountExtras').show();
		}
		else if(type == TYPE_POWER_SUPPLY)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_powersupply').parent().find('input, select, label, .amountExtras').show();
		}
		else if(type == TYPE_STORAGE)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_storage').parent().find('input, select, label, .amountExtras').show();
		}
		if(amount < 1)
		{
			$('#debb_configbundle_nodetype_components_' + id).find('select, .amountExtras').hide();
		}
	});
	$('.component select[id$="_amount"]').each(function()
	{
		if($(this).val() > 0)
		{
			if($(this).find('option[value="0"]').length > 0)
			{
				$(this).find('option[value="0"]').remove();
			}
		}
		else
		{
			$(this).parents('.component').css('height', '33px');
			$(this).parents('.component').find('.componentExtras').css('height', '29px');
		}
		if($(this).parent().find('.amountExtras').length < 1)
		{
			$(this).parent().append('<div class="amountExtras"><a href="#" class="addAmount"><i class="icon-plus"></i></a> <a href="#" class="delAmount"><i class="icon-minus"></i></a></div>');
		}
		if($(this).val() < 1)
		{
			$(this).parent().find('.amountExtras').hide();
		}
	});
};

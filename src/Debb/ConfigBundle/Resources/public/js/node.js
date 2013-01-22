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
				}
			});
			id++;
			var prototype = $('.componentBox').attr('data-prototype'),
				newForm = prototype.replace(/__name__/g, id),
				newFormLi = $('<div class="component"></div>').append($(newForm).children('div'))
					.append('<div class="componentExtras"><div class="addComponent"><i class="icon-plus"></i></div><div class="delComponent"><i class="icon-remove"></i></div></div>'),
				type = $(this).parents('.component:first').find('input[id$="_type"]').attr('value');
			$(this).parents('.component:first').after(newFormLi);
			$('#debb_configbundle_nodetype_components_' + id + '_type').attr('value', type);
			updateComponents();
			e.preventDefault();
		});
		$(document).on('click', '.delComponent', function(e)
		{
			var type = $(this).parents('.component:first').find('[id$="_type"]').attr('value');
			if($(this).parents('[class^="componentBox"]').find('[id$="_type"][value="' + type + '"]').length <= 1)
			{
				if(confirm(Translator.get('delete.last.entry')))
				{
					$(this).parents('.component:first').remove();
				}
			}
			else
			{
				$(this).parents('.component:first').remove();
			}
			e.preventDefault();
		});
		updateComponents();
	});

function updateComponents() {
	$('.component').find('input, select, label').hide();
	$('.component').each(function()
	{
		var id = getExactId($(this).find('div:first').attr('id')),
			type = $('#debb_configbundle_nodetype_components_' + id + '_type').attr('value');

		$('#debb_configbundle_nodetype_components_' + id + '_amount').parent().find('input, select, label').show();
		if(type == TYPE_MAINBOARD)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_mainboard').parent().find('input, select, label').show();
		}
		else if(type == TYPE_PROCESSOR)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_processor').parent().find('input, select, label').show();
		}
		else if(type == TYPE_COOLING_DEVICE)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_coolingDevice').parent().find('input, select, label').show();
		}
		else if(type == TYPE_MEMORY)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_memory').parent().find('input, select, label').show();
		}
		else if(type == TYPE_POWER_SUPPLY)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_powersupply').parent().find('input, select, label').show();
		}
		else if(type == TYPE_STORAGE)
		{
			$('#debb_configbundle_nodetype_components_' + id + '_storage').parent().find('input, select, label').show();
		}
	});
}

function getExactId(str)
{
	var array = str.split('_');
	return array[array.length - 1];
}

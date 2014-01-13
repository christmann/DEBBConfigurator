$(function()
{
	return; // We neednt this feature now!

	var configCRAH = $('input#debb_managementbundle_coolingdevicetype_fanEfficiency').parent('div')
					 .add($('input#debb_managementbundle_coolingdevicetype_coolingCoilEfficiency').parent('div'))
					 .add($('input#debb_managementbundle_coolingdevicetype_deltaThEx').parent('div')),
		configChiller = $('input#debb_managementbundle_coolingdevicetype_maxCoolingCapacity').parent('div')
						.add($('input#debb_managementbundle_coolingdevicetype_coolingCapacityRated').parent('div'))
						.add($('input#debb_managementbundle_coolingdevicetype_eERRated').parent('div'))
						.add($('div.cooling-eer')),
		configDryCooler = $('input#debb_managementbundle_coolingdevicetype_deltaThDryCooler').parent('div')
						  .add($('input#debb_managementbundle_coolingdevicetype_dryCoolerEfficiency').parent('div'));

	$('#debb_managementbundle_coolingdevicetype_class').on('change', function()
	{
		configCRAH.hide();
		configChiller.hide();
		configDryCooler.hide();
		var val = $(this).val();
		if(val == 'CRAH')
		{
			configCRAH.show();
		}
		else if (val == 'Free-cooling')
		{
			configChiller.show();
		}
		else if (val == 'LCU')
		{
			configDryCooler.show();
		}
		noBreakClasses();
	}).change();

	$('form.clearfix').submit(function(e)
	{
		var val = $('#debb_managementbundle_coolingdevicetype_class').val();
		if(val == 'CRAH')
		{
			var needs = configCRAH;
		}
		else if (val == 'Free-cooling')
		{
			var needs = configChiller;
		}
		else if (val == 'LCU')
		{
			var needs = configDryCooler;
		}

		if(typeof(needs) != 'undefined')
		{
			needs.each(function()
			{
				if($(this).val().length < 1)
				{
					e.preventDefault();
				}
			});
		}
	});
});
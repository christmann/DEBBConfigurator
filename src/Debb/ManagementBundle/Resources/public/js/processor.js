function makeNumericStates()
{
	var x = 0;
	$('[name^="debb_managementbundle_processortype[cstates]"][name$="[state]"]').each(function()
	{
		$(this).val(++x);
	});
}

$(document).on('addedThing', makeNumericStates);
$(document).on('deletedThing', makeNumericStates);
$(function()
{
	makeNumericStates();
});
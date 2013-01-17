$(function()
	{
		$(document).on('click', '.addComponent', function(e)
		{
			e.preventDefault();
			var prototype = $('.componentBox').attr('data-prototype');
			var newIndex = $('.componentBox .component').length;
			var newForm = prototype.replace(/__name__/g, newIndex);
			var newFormLi = $('<div class="component"></div>').append(newForm);
			$(newFormLi).appendTo('.componentBox');
			updateComponents();
		});
		updateComponents();
	});

function updateComponents() {
	$('.componentBox .component').find('input, select, label').hide();
}

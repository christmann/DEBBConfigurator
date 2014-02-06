$(function()
{
    $(document).on('click', 'a.filedownload', function (e)
    {
        e.preventDefault();
        $.fileDownload($(this).prop('href'),
        {
            preparingMessageHtml: Translator.trans('preparing file') + '<br /><img src="/bundles/debbconfig/img/ajax-loader.gif" />',
            failMessageHtml: Translator.trans('failed file')
        });
    });

	$(document).on('click', 'a.svnUpload:not(.disabled)', function(e)
	{
		e.preventDefault();
		var id = debbUtils.generateUniqueId('svnModal_1');
		$('body').append('<div class="modal hide svnModal" id="' + id + '">'
			+ '	<div class="modal-header">'
			+ '		<button type="button" class="close" data-dismiss="modal">×</button>'
			+ '		<h3>SVN Upload</h3>'
			+ '	</div>'
			+ '	<div class="modal-body">'
			+ '		<p>Change SVN upload path if necessary (the content of the directory will be overwritten):<br />'
			+ ($('#svnuploaddefaultdir').length > 0 ? ($('#svnuploaddefaultdir').val() + '<br />') : '')
			+ '			<input type="text" name="svndir" style="width: 90%;" placeholder="Example: /repository/common/debbs/trunk/PSNC_Little_Server_Room" /><input type="hidden" name="requesturl" value="' + $(this).prop('href') + '" /><br />'
			+ '			The directory would be deleted completely.</p>'
			+ '	</div>'
			+ '	<div class="modal-footer">'
			+ '		<a href="#" class="btn" data-dismiss="modal">Close</a>'
			+ '		<a href="#" class="btn btn-primary">Upload</a>'
			+ '	</div>'
			+ '</div>');

		$('#' + id).modal({
			show: true
		});
	});

	$(document).on('click', '.svnModal.modal .btn-primary:not(".nextBtn")', function(e)
	{
		e.preventDefault();
		var btn = $(this),
			modal = $(this).parents('.svnModal.modal');
		btn.html(btn.html() + ' <img src="' + $('#ajaxloadersmall').val() + '" />');
		btn.prop('disabled', true);

		$.post(modal.find('[name="requesturl"]').val(), {'svndir': modal.find('[name="svndir"]').val()}, function(response)
		{
			btn.html('Next').addClass('nextBtn');
			btn.prop('disabled', false);
			btn.prop('href', response.next);
		}, 'json');
	});
});
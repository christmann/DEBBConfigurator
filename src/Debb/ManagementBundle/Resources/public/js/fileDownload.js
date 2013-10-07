$(function()
{
    $(document).on('click', 'a.filedownload', function (e)
    {
        e.preventDefault();
        $.fileDownload($(this).prop('href'),
        {
            preparingMessageHtml: Translator.get('preparing file') + '<br /><img src="/bundles/debbconfig/img/ajax-loader.gif" />',
            failMessageHtml: Translator.get('failed file')
        });
    });
});
$(function()
{
    $(document).on('click', 'a.filedownload', function (e)
    {
        e.preventDefault();
        $.fileDownload($(this).prop('href'),
        {
            preparingMessageHtml: Translator.get('preparing file'),
            failMessageHtml: Translator.get('failed file')
        });
    });
});
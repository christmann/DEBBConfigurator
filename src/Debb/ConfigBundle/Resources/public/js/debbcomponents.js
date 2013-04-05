function getExactId(str)
{
	if(typeof(str) != 'undefined' && str != null)
	{
		var array = str.split('_');
		return array[array.length - 1];
	}
	return 0;
}

$(function()
{
	
});

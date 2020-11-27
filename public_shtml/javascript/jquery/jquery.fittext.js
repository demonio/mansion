
$.fn.fitText = function()
{
	return this.each(function()
	{
		var $this = $(this);

		var resizer = function() 
		{
		    var container_h = $('.fit-text').height();

		    var content = $('.fit-text').children();
		    var content_h = $(content).height();

		    var content_fs = $(content).css('font-size').replace('px', '');

		    if (content_h < container_h)
		    {
		        $(content).css('font-size', ++content_fs+'px');
		        var content_after = $(content).css('font-size').replace('px', '');
		        resizer();
		    }
		    else
		    {
		        var content_after = content_fs-2;
		        $(content).css('font-size', content_after+'px');
		    	console.log(content_fs+' > '+content_after);
			};
		}

		$(window).on('resize.fittext orientationchange.fittext', resizer);
	});
};

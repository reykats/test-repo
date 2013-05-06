$Core.recipeToggleCategory = function(sName, iId)
{
    
    $('.special_subcategory').each(function(){
	if ($(this).attr('class').indexOf(sName) == -1)
	{	    
	    $(this).hide();	    
	}
    });
    $('.category_show_more_less').each(function(){
    	if ($(this).attr('id').indexOf('show_more_') >= 0)
	{
	    if($(this).attr('id')!='show_more_'+iId)
	    	$(this).show();
	}
	
	if ($(this).attr('id').indexOf('show_less_') >= 0)
	{
	    if($(this).attr('id')!='show_less_'+iId)
	    	$(this).hide();
	}
    });

    $('.' + sName).toggle();    
    $('#show_more_' + iId).toggle();
    $('#show_less_' + iId).toggle();
    
    
}
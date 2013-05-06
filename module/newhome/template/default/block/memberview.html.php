<?php

defined('PHPFOX') or exit('NO DICE!');

?>
{literal}
<script type="text/javascript">
 
$(document).ready(function(){
 
        $(".slidingDiv").hide();
        $(".show_hide").show();

	$(".slidingDivPages").hide();
        $(".show_hide_pages").show();
 
    $('.show_hide_pages').click(function(){
    $(".slidingDivPages").slideToggle();
    });
 

    $('.show_hide').click(function(){
    $(".slidingDiv").slideToggle();
    });
 
});
 
</script>
{/literal}



<div class="recipe_container">
{foreach from=$aRacipes key=recipes item=aRacipe}
		
{if ($recipes<=4)}
<a href="/network/recipe/view/{$aRacipe.title_url}">
{img path='recipe.url_image' file=$aRacipe.image_path suffix='_120' max_width='50' max_height='50' title=$aRacipe.title class='v_middle'}

        {$aRacipe.title}</a>

{/if}
{if ($recipes==5)}
<div class="clear"></div>

<center><a href="javascript:void(0);" class="show_hide">More Information</a></center>

<div class="slidingDiv">


{/if}

{if ($recipes>=5)}

<a href="/network/recipe/view/{$aRacipe.title_url}">
{img path='recipe.url_image' file=$aRacipe.image_path suffix='_120' max_width='50' max_height='50' title=$aRacipe.title class='v_middle'}

        {$aRacipe.title}</a>

{/if}




{if ($recipes==11)}
<!--<a href="javascript:void(0)" class="show_hide">hide</a>-->
</div>
{/if}
{/foreach}


<hr />

{foreach from=$aPages key=pages item=aPages}
		
{if ($pages<=4)}

<a href="{$aPages.pagesUrl}{$aPages.page_id}" title="{$aPages.title|clean}">
{img server_id=$aPages.image_server_id title=$aPages.title path='pages.url_image' file=$aPages.image_path suffix='_square' max_width='50' max_height='50' class='v_middle'} {$aPages.title|clean|shorten:22:'...'}</a>
        
{/if}
{if ($pages==5)}
<div class="clear"></div>

<center><a href="javascript:void(0);" class="show_hide_pages">More Information</a></center>

<div class="slidingDivPages">


{/if}

{if ($pages>=5)}


<a href="{$aPages.pagesUrl}{$aPages.page_id}" title="{$aPages.title|clean}">
{img server_id=$aPages.image_server_id title=$aPages.title path='pages.url_image' file=$aPages.image_path suffix='_square' max_width='50' max_height='50' class='v_middle'} {$aPages.title|clean|shorten:22:'...'}</a>

	


{/if}




{if ($pages==11)}
<!--<a href="javascript:void(0)" class="show_hide">hide</a>-->
</div>
{/if}
{/foreach}
</div>
</div>


<?php

defined('PHPFOX') or exit('NO DICE!');

?>
<div class="block_listing_inline">
	<ul>

{foreach from=$aRacipes name=recipes item=aRacipe}
		<li>

{img thickbox=true path='recipe.url_image' file=$aRacipe.image_path suffix='_120' max_width='25' max_height='25' class='js_mp_fix_width' title=$aRacipe.title}

        <a href="/network/recipe/view/{$aRacipe.title_url}">{$aRacipe.title}</a> <span style="color:#008080;"><span style="font-size: smaller;">(rated: {$aRacipe.total_rating})</span></span>

        </li><div class="clear"></div>

{/foreach}
	</ul>
	<div class="clear"></div>
</div>

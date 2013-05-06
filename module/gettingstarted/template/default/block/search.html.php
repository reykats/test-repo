<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<form method="post" accept-charset="utf-8"  action="{url link='gettingstarted.allarticle'}" >
<div class="p_bottom_15">

{phrase var='gettingstarted.keyword'}
<div class="p_4">
    {$aFilters.title}
</div>
<div class="p_top_4">
	{phrase var='gettingstarted.caterories'}
    <div class="p_4">
        {$aFilters.type}
    </div>
</div>


<div class="p_top_8">
    <input type="hidden" value="search_" name="se"/>
    <input type="submit" name="search[submit]" value="{phrase var='core.submit'}" class="button" />
    <input type="submit" name="search[reset]" value="{phrase var='core.reset'}" class="button" />
</div>

</div>
</form>
<?php

?>
{literal}
	<style type="text/css">
	#main_content_padding
	{
		padding-bottom: 30px;
	}
        .report_this_item
        {
            display:none;
        }
	</style>
{/literal}
<div class="item_view">
	<div class="item_content item_view_content">{$dsarticle.description_parsed}</div>
	{module name='gettingstarted.articledetail'}
	<div class="video_rate_body">
		<div class="video_rate_display">{module name='rate.display'}</div>
	</div>
        <div>
            {module name='feed.comment'}
        </div>
</div>

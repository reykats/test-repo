<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="video_info_box">
	<div class="video_info_box_content">
		<div class="video_info_view">{if $dsarticle.total_view == 0}1{else}{$dsarticle.total_view|number_format}{/if}</div>	

		<ul class="video_info_box_list">
			<li class="full_name first">
				<span id="js_user_name_link_admin" class="user_profile_link_span">
					<a href="{$path_user}">{$username}</a>
				</span>
			</li>
			<li>{$time_stamp}</li>
			<li>{$total_comments} (Comment(s))</li>
		</ul>
		</ul>
		</ul>

		<div class="video_info_box_extra">	
			<div class="table">
				<div class="table_left">
					{phrase var='gettingstarted.category'}:
				</div>
				<div class="table_right">
                	<div class="p_2">
                    	<a href="{$dsarticle.url}" onclick="window.location=this.href; return false;">{$dsarticle.article_category_name}</a>
                    </div>
				</div>
			</div>
		</div>
		

		{*	{if !empty($aVideo.tag_list)}
			<div class="table">
				<div class="table_left">
					{phrase var='video.tags'}:
				</div>
				<div class="table_right">
				{foreach from=$aVideo.tag_list name=tags item=aTag}
					{if $phpfox.iteration.tags != 1}, {/if}<a href="{if isset($sGroup) && $sGroup !=''}{url link='group.'$sGroup'.video.tag.'$aTag.tag_url''}{else}{url link='video.tag.'$aTag.tag_url''}{/if}">{$aTag.tag_text}</a>
				{/foreach}
				</div>
			</div> 
			{/if}	
		</div>*}
	</div>	
	<a href="#" class="video_info_toggle">
		<span class="js_info_toggle_show_more">{phrase var='gettingstarted.show_more'} {img theme='layout/video_show_more.png'}</span>
		<span class="js_info_toggle_show_less">{phrase var='gettingstarted.show_less'} {img theme='layout/video_show_less.png'}</span>
	</a>	
</div>

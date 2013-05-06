{if count($aBlogs)}
{foreach from=$aBlogs name=blogs item=aBlog}
<div class="home-blog-item{if $phpfox.iteration.blogs==1} blog_first{/if}">	
	{if isset($aBlog.destination) && $aBlog.is_image==1}
	<div class="blog_thumb">	
	<a href="{permalink module='blog' id=$aBlog.blog_id title=$aBlog.title}">	
		{img server_id=$aBlog.server_id path='core.url_attachment' file=$aBlog.destination suffix='_view' max_width=290 max_height=180 title=$aBlog.title}		
	</a>
	</div>
	{/if}				
		<div class="p_10 content">
			<div class="title"><a href="{permalink module='blog' id=$aBlog.blog_id title=$aBlog.title}">{$aBlog.title|clean|shorten:50:'...'}</a></div>
			<div class="extra_info" >{$aBlog.time_stamp|date}</div>
			<div>{$aBlog.text_parsed|strip_tags|shorten:150:'...'}</div>
			<div class="p_top_8"><span><a href="{permalink module='blog' id=$aBlog.blog_id title=$aBlog.title}">read more</a></span></div>			
		</div>		
	<div class="clear"></div>
</div>
{/foreach}
{unset var=$aBlog}
<div class="clear"></div>
{/if}
<?php
 
defined('PHPFOX') or exit('');

?>

<div id="mac_pins_wrapper">
                        
  <div class="clear" style="height:20px"></div>
  {if $aPins|count > 0}     
          
  <ul id="mac_pins_items" class="transitions-enabled infinite-scroll clearfix">
                    
      {foreach from=$aPins name=pin item=aPin}
      
      <li class="mac_pins_item">
      
        <div class="mac_pins_items_box">

        {if $aPin.TABLEFLAG == 5}

        <div class="pins_action_links">
        
          <a title="{phrase var='pins.go_to_photo_page'}" class="no_ajax_link" href="{url link='photo'}">
          <img src="{module_path}pins/static/image/photos.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
          
          <a href="{permalink module='photo' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" title="{phrase var='pins.view_this'} {$aPin.ITEMTITLE}">
          <img src="{module_path}pins/static/image/pins.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
  
      		{if Phpfox::isModule('report')}
        		{if $aPin.user_id != Phpfox::getUserId()}
              <a href="#?call=report.add&amp;height=100&amp;width=400&amp;type={$aPin.ITEMTYPENAME}&amp;id={$aPin.ITEMID}" class="inlinePopup" title="{phrase var='pins.report_this_video'}"><img src="{module_path}pins/static/image/report.png" class="pin_link_goto pins_type_icon js_hover_title"/></a>
            {/if}
      		{/if}
          
      		{if Phpfox::isModule('share')}
      			{module name='share.link' type=$aPin.ITEMTYPENAME display='image' url=$aPin.ITEMBOOKMARK title=$aPin.ITEMTITLE}	
      		{/if}
          
        </div>
      
      {if Phpfox::getParam('pins.enable_comments_on_modal_photo')}
        <a href="{$aPin.ITEMBOOKMARK}" title="{$aPin.ITEMTITLE}" class="thickbox photo_holder_image" rel="{$aPin.ITEMID}">
  				{img server_id=$aPin.ITEMSERVERID path='photo.url_photo' file=$aPin.ITEMDESTINATION suffix='_240' max_height='600' max_width='205' title=$aPin.ITEMTITLE class='js_hover_title js_mp_fix_width full_size_image pins_img_width_height'}
  			</a>
      {else}  
        {img thickbox=true server_id=$aPin.ITEMSERVERID path='photo.url_photo' file=$aPin.ITEMDESTINATION suffix='_240' max_height='600' max_width='205' title=$aPin.ITEMTITLE class='js_mp_fix_width photo_holder' rel=$aPin.ITEMID}
      {/if}       
      
        <div class="mac_pins_img_caption">
        
        <h2 class="item_title_h2">{$aPin.ITEMTITLE|feed_strip|split:15}</h2>
        
        {if $aPin.ITEMDESCRIPTION != ''}<p class="pin_item_description">{$aPin.ITEMDESCRIPTION|feed_strip|shorten:'300'|split:25}</p>{/if}
        <p>
        {phrase var='pins.posted'} {$aPin.ITEMPOSTEDON} {phrase var='pins.pins_main_by'} 
        <span id="js_user_name_link_{$aPin.ITEMUSERNAME}" class="user_profile_link_span">
          <a href="{url link=$aPin.ITEMUSERNAME}">{$aPin.ITEMFULLNAME}</a>
        </span>
        {if $aPin.ITEMEXTRATITLE != ''}
        {phrase var='pins.on_the_album'} <a href="{permalink module='photo.album' id=$aPin.ITEMEXTRAID title=$aPin.ITEMEXTRATITLE}">{$aPin.ITEMEXTRATITLE}</a>
        {/if}
        {if $aPin.ITEMCATEGORIES != ''}
        {phrase var='pins.under_category'} {$aPin.ITEMCATEGORIES} 
        {/if}
        <br/>
        {phrase var='pins.total_likes'}: <strong>{$aPin.ITEMTOTALLIKE}</strong>
        <br/>
        </p>
        </div>
       {if Phpfox::getParam('pins.enable_comment_photo')} 
       
       {module name='pins.photocomments' photoCommentItemId=$aPin.ITEMID}
       
       {/if}
     
        {elseif $aPin.TABLEFLAG == 4}

        <div class="pins_action_links">
          
          <a title="{phrase var='pins.go_to_video_page'}" class="no_ajax_link" href="{url link='video'}">
          <img src="{module_path}pins/static/image/videos.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
          
          <a title="{phrase var='pins.watch_this_video'}" href="{permalink module='video' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" class="play_link no_ajax_link" onclick="$Core.box('video.play', 700, 'id={$aPin.ITEMID}&popup=true', 'GET'); return false;">
            <img src="{module_path}pins/static/image/play.png" alt="{phrase var='pins.watch_this_video'}" class="pin_link_goto pins_type_icon js_hover_title" />
          </a>
           
          <a href="{permalink module='video' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" title="{phrase var='pins.view_this'} {$aPin.ITEMTITLE}">
            <img src="{module_path}pins/static/image/pins.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
    
      		{if Phpfox::isModule('report')}
        		{if $aPin.user_id != Phpfox::getUserId()}
              <a href="#?call=report.add&amp;height=100&amp;width=400&amp;type={$aPin.ITEMTYPENAME}&amp;id={$aPin.ITEMID}" class="inlinePopup" title="{phrase var='pins.report_this_video'}"><img src="{module_path}pins/static/image/report.png" class="pin_link_goto pins_type_icon js_hover_title"/></a>
            {/if}
      		{/if}
          
      		{if Phpfox::isModule('share')}
      			{module name='share.link' type=$aPin.ITEMTYPENAME display='image' url=$aPin.ITEMBOOKMARK title=$aPin.ITEMTITLE}	
      		{/if}
          
        </div>
        
        <a title="{phrase var='pins.watch_this_video'}" href="{permalink module='video' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" class="play_link no_ajax_link" onclick="$Core.box('video.play', 700, 'id={$aPin.ITEMID}&popup=true', 'GET'); return false;">
          {img server_id=$aPin.ITEMSERVERID path='video.url_image' file=$aPin.ITEMDESTINATION suffix='_120' width='200' class='pins_img_width_height js_hover_title js_mp_fix_width' title=$aPin.ITEMTITLE}
        </a>
        
        <div class="mac_pins_img_caption">
        
        <h2 class="item_title_h2">{$aPin.ITEMTITLE|feed_strip|split:15}</h2>
        
        {if $aPin.ITEMDESCRIPTION != ''}
        <p class="pin_item_description">
        {$aPin.ITEMDESCRIPTION|feed_strip|shorten:'300'|split:25}
        </p>
        {/if}
        <p>
        {phrase var='pins.posted'} {$aPin.ITEMPOSTEDON} {phrase var='pins.pins_main_by'} 
        <span id="js_user_name_link_{$aPin.ITEMUSERNAME}" class="user_profile_link_span">
          <a href="{url link=$aPin.ITEMUSERNAME}">{$aPin.ITEMFULLNAME}</a>
        </span>
        <br/>
        {phrase var='pins.total_likes'}: <strong>{$aPin.ITEMTOTALLIKE}</strong>
        <br/>
        </p>
        </div>
        
       {if Phpfox::getParam('pins.enable_comment_video')} 
       
       {module name='pins.videocomments' videoCommentItemId=$aPin.ITEMID}
       
       {/if}
       
       {elseif $aPin.TABLEFLAG == 6}

        <div class="pins_action_links">
          
          <a title="{phrase var='pins.go_to_music_page'}" class="no_ajax_link" href="{url link='music'}">
            <img src="{module_path}pins/static/image/musics.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
          
          <a title="{phrase var='pins.play_this_song'}" class="no_ajax_link" onclick="{literal}$Core.player.load({on_start: function() {$.ajaxCall('music.play', 'id={/literal}{$aPin.ITEMID}', 'GET');}{literal},id: 'js_music_player_{/literal}{$aPin.ITEMID}{literal}',type: 'music',auto: true,play: {/literal}'{$aPin.ITEMEXTRADESTINATION}'{literal}});$(this).hide();return false;{/literal}" href="{permalink module='music' id=$aPin.ITEMID title=$aPin.ITEMTITLE}">
            <img src="{module_path}pins/static/image/play.png" alt="{phrase var='pins.play_this_song'}" class="pin_link_goto pins_type_icon js_hover_title" />
          </a>
     
          <a href="{permalink module='music' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" title="{phrase var='pins.view_this'} {$aPin.ITEMTITLE}">
            <img src="{module_path}pins/static/image/pins.png" alt="" class="pin_link_goto pins_type_icon js_hover_title"/>
          </a>
 
      		{if Phpfox::isModule('report')}
        		{if $aPin.user_id != Phpfox::getUserId()}
              <a href="#?call=report.add&amp;height=100&amp;width=400&amp;type={$aPin.ITEMTYPENAME}&amp;id={$aPin.ITEMID}" class="inlinePopup" title="{phrase var='pins.report_this_video'}"><img src="{module_path}pins/static/image/report.png" class="pin_link_goto pins_type_icon js_hover_title"/></a>
            {/if}
      		{/if}
          
      		{if Phpfox::isModule('share')}
      			{module name='share.link' type=$aPin.ITEMTYPENAME display='image' url=$aPin.ITEMBOOKMARK title=$aPin.ITEMTITLE}	
      		{/if}
          
        </div>
      
        
        <a title="{phrase var='pins.play_this_songs'}" class="no_ajax_link" onclick="{literal}$Core.player.load({on_start: function() {$.ajaxCall('music.play', 'id={/literal}{$aPin.ITEMID}', 'GET');}{literal},id: 'js_music_player_{/literal}{$aPin.ITEMID}{literal}',type: 'music',auto: true,play: {/literal}'{$aPin.ITEMEXTRADESTINATION}'{literal}});return false;{/literal}" href="{permalink module='music' id=$aPin.ITEMID title=$aPin.ITEMTITLE}">
        {img server_id=$aPin.ITEMSERVERID path='music.url_image' file=$aPin.ITEMDESTINATION suffix='_120' width='200' class='pins_img_width_height js_mp_fix_width js_hover_title' title=$aPin.ITEMTITLE}
        </a>

        
        <div class="mac_pins_img_caption">
        
        <h2 class="item_title_h2">{$aPin.ITEMTITLE|feed_strip|split:15}</h2>
        
        <p>        
        {phrase var='pins.posted'} {$aPin.ITEMPOSTEDON} {phrase var='pins.pins_main_by'} 
        <span id="js_user_name_link_{$aPin.ITEMUSERNAME}" class="user_profile_link_span">
          <a href="{url link=$aPin.ITEMUSERNAME}">{$aPin.ITEMFULLNAME}</a>
        </span>
        <br/>
        {phrase var='pins.total_likes'}: <strong>{$aPin.ITEMTOTALLIKE}</strong>
        <br/>
        </p>
        </div>
        
	      <div id="js_music_player_{$aPin.ITEMID}" style="height:30px; width:200px;"></div>

       {if Phpfox::getParam('pins.enable_comment_song_with_album')} 
       
        {module name='pins.musiccomments' musicCommentItemId=$aPin.ITEMID typeMusicComment='song_with_album'}
       
       {/if} 
        
        {elseif $aPin.TABLEFLAG == 7} 
        
        <div class="pins_action_links">
          
          <a title="{phrase var='pins.go_to_music_page'}" class="no_ajax_link" href="{url link='music'}">
          <img src="{module_path}pins/static/image/musics.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
        
          <a title="{phrase var='pins.play_this_song'}" class="no_ajax_link" onclick="{literal}$Core.player.load({on_start: function() {$.ajaxCall('music.play', 'id={/literal}{$aPin.ITEMID}', 'GET');}{literal},id: 'js_music_player_{/literal}{$aPin.ITEMID}{literal}',type: 'music',auto: true,play: {/literal}'{$aPin.ITEMEXTRADESTINATION}'{literal}});$(this).hide();return false;{/literal}" href="{permalink module='music' id=$aPin.ITEMID title=$aPin.ITEMTITLE}">
            <img src="{module_path}pins/static/image/play.png" alt="{phrase var='pins.play_this_song'}" class="pin_link_goto pins_type_icon js_hover_title" />
          </a>
 
          <a href="{permalink module='video' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" title="{phrase var='pins.view_this'} {$aPin.ITEMTITLE}">
            <img src="{module_path}pins/static/image/pins.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
    
      		{if Phpfox::isModule('report')}
        		{if $aPin.user_id != Phpfox::getUserId()}
              <a href="#?call=report.add&amp;height=100&amp;width=400&amp;type={$aPin.ITEMTYPENAME}&amp;id={$aPin.ITEMID}" class="inlinePopup" title="{phrase var='pins.report_this_video'}"><img src="{module_path}pins/static/image/report.png" class="pin_link_goto pins_type_icon js_hover_title"/></a>
            {/if}
      		{/if}
          
      		{if Phpfox::isModule('share')}
      			{module name='share.link' type=$aPin.ITEMTYPENAME display='image' url=$aPin.ITEMBOOKMARK title=$aPin.ITEMTITLE}	
      		{/if}
          
        </div>
        
        <a title="{phrase var='pins.play_this_song'}" class="no_ajax_link" onclick="{literal}$Core.player.load({on_start: function() {$.ajaxCall('music.play', 'id={/literal}{$aPin.ITEMID}', 'GET');}{literal},id: 'js_music_player_{/literal}{$aPin.ITEMID}{literal}',type: 'music',auto: true,play: {/literal}'{$aPin.ITEMEXTRADESTINATION}'{literal}});return false;{/literal}" target="_blank" href="{permalink module='music' id=$aPin.ITEMID title=$aPin.ITEMTITLE}">
          {img server_id=$aPin.user_server_id path='core.url_user' file=$aPin.user_image suffix='_200_square' max_width=200 max_height=400 class='pins_img_width_height js_mp_fix_width js_hover_title' title=$aPin.full_name}
        </a>
        <div class="mac_pins_img_caption">
        
        <h2 class="item_title_h2">{$aPin.ITEMTITLE|feed_strip|split:15}</h2>
        
          <p>        
          {phrase var='pins.posted'} {$aPin.ITEMPOSTEDON} {phrase var='pins.pins_main_by'} 
          <span id="js_user_name_link_{$aPin.ITEMUSERNAME}" class="user_profile_link_span">
            <a href="{url link=$aPin.ITEMUSERNAME}">{$aPin.ITEMFULLNAME}</a>
          </span>
          <br/>
          {phrase var='pins.total_likes'}: <strong>{$aPin.ITEMTOTALLIKE}</strong>
          <br/>
          </p>
        </div>
        
	      <div id="js_music_player_{$aPin.ITEMID}" style="height:30px; width:200px;"></div>

       {if Phpfox::getParam('pins.enable_comment_song_without_album')} 
       
        {module name='pins.musiccomments' musicCommentItemId=$aPin.ITEMID typeMusicComment='song_without_album'}

        {/if}

        {elseif $aPin.TABLEFLAG == 3} 

        <div class="pins_action_links">
          
          <a title="{phrase var='pins.go_to_blog_page'}" class="no_ajax_link" href="{url link='blog'}">
          <img src="{module_path}pins/static/image/blogs.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
        
          <a href="{permalink module='blog' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" title="{phrase var='pins.view_this'} {$aPin.ITEMTITLE}">
            <img src="{module_path}pins/static/image/pins.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
    
      		{if Phpfox::isModule('report')}
        		{if $aPin.user_id != Phpfox::getUserId()}
              <a href="#?call=report.add&amp;height=100&amp;width=400&amp;type={$aPin.ITEMTYPENAME}&amp;id={$aPin.ITEMID}" class="inlinePopup" title="{phrase var='pins.report_this_video'}"><img src="{module_path}pins/static/image/report.png" class="pin_link_goto pins_type_icon js_hover_title"/></a>
            {/if}
      		{/if}
          
      		{if Phpfox::isModule('share')}
      			{module name='share.link' type=$aPin.ITEMTYPENAME display='image' url=$aPin.ITEMBOOKMARK title=$aPin.ITEMTITLE}	
      		{/if}
          
        </div>

        <a href="{permalink module='blog' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" title="{$aPin.ITEMTITLE}">
        {img server_id=$aPin.ITEMSERVERID path='core.url_attachment' file=$aPin.ITEMDESTINATION suffix='_view' max_height='400' max_width='200' title=$aPin.ITEMTITLE class='pins_img_width_height js_mp_fix_width js_hover_title'}
        </a>
        
        <div class="mac_pins_img_caption">
        
        <h2 class="item_title_h2">{$aPin.ITEMTITLE|feed_strip|split:15}</h2>
        
        {if $aPin.ITEMDESCRIPTION != ''}
        <p class="pin_item_description">
        {$aPin.ITEMDESCRIPTION|feed_strip|shorten:'300'|split:25}
        </p>
        {/if}
        <p>        
        {phrase var='pins.posted'} {$aPin.ITEMPOSTEDON} {phrase var='pins.pins_main_by'} 
        <span id="js_user_name_link_{$aPin.ITEMUSERNAME}" class="user_profile_link_span">
          <a href="{url link=$aPin.ITEMUSERNAME}">{$aPin.ITEMFULLNAME}</a>
        </span>
          <br/>
          {phrase var='pins.total_likes'}: <strong>{$aPin.ITEMTOTALLIKE}</strong>
          <br/>
        </p>
        </div>
        
        

       {if Phpfox::getParam('pins.enable_comment_blog')} 
       
        {module name='pins.blogcomments' blogCommentItemId=$aPin.ITEMID}

       {/if}
        
        {elseif $aPin.TABLEFLAG == 2}

        <div class="pins_action_links">
          
          <a title="{phrase var='pins.go_to_poll_page'}" class="no_ajax_link" target="_blank" href="{url link='poll'}">
          <img src="{module_path}pins/static/image/polls.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
        
        <a href="{permalink module='poll' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" title="{phrase var='pins.vote_this_poll'}">
         <img src="{module_path}pins/static/image/pins.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
        </a>
    
      		{if Phpfox::isModule('report')}
        		{if $aPin.user_id != Phpfox::getUserId()}
              <a href="#?call=report.add&amp;height=100&amp;width=400&amp;type={$aPin.ITEMTYPENAME}&amp;id={$aPin.ITEMID}" class="inlinePopup" title="{phrase var='pins.report_this_video'}"><img src="{module_path}pins/static/image/report.png" class="pin_link_goto pins_type_icon js_hover_title"/></a>
            {/if}
      		{/if}
          
      		{if Phpfox::isModule('share')}
      			{module name='share.link' type=$aPin.ITEMTYPENAME display='image' url=$aPin.ITEMBOOKMARK title=$aPin.ITEMTITLE}	
      		{/if}
          
        </div>

        
        <div class="pin_who_posted_box_item">
          <div class="pin_who_posted_pic">
            <a title="{$aPin.ITEMTITLE}" class="no_ajax_link" href="{permalink module='poll' id=$aPin.ITEMID title=$aPin.ITEMTITLE}">
              {img server_id=$aPin.ITEMSERVERID title=$aPin.ITEMTITLE path='poll.url_image' file=$aPin.ITEMDESTINATION suffix='_75' max_width='75' max_height='75' class='js_hover_title js_mp_fix_width'}
            </a>
          </div>
          <div class="pin_who_posted_text">
            <div>
               {$aPin.ITEMTITLE|feed_strip|shorten:'300'|split:20}
            </div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
        
        <div class="mac_pins_img_caption">
        
        
        <p>        
        {phrase var='pins.posted'} {$aPin.ITEMPOSTEDON} {phrase var='pins.pins_main_by'} 
        <span id="js_user_name_link_{$aPin.ITEMUSERNAME}" class="user_profile_link_span">
          <a href="{url link=$aPin.ITEMUSERNAME}">{$aPin.ITEMFULLNAME}</a>
        </span>
        <br/>
          {phrase var='pins.total_likes'}: <strong>{$aPin.ITEMTOTALLIKE}</strong>
          <br/>
        </p>
        </div>
        
       {if Phpfox::getParam('pins.enable_comment_poll')} 
       
        {module name='pins.pollcomments' pollCommentItemId=$aPin.ITEMID}

       {/if}
        
        {elseif $aPin.TABLEFLAG == 1}

        <div class="pins_action_links">
        
          <a title="{phrase var='pins.go_to_quiz_page'}" class="no_ajax_link" href="{url link='quiz'}">
            <img src="{module_path}pins/static/image/quizzes.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
          
          <a href="{permalink module='quiz' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" title="{phrase var='pins.solve_this_quiz'}">
           <img src="{module_path}pins/static/image/pins.png" alt="" class="pin_link_goto pins_type_icon js_hover_title">
          </a>
      
      		{if Phpfox::isModule('report')}
        		{if $aPin.user_id != Phpfox::getUserId()}
              <a href="#?call=report.add&amp;height=100&amp;width=400&amp;type={$aPin.ITEMTYPENAME}&amp;id={$aPin.ITEMID}" class="inlinePopup" title="{phrase var='pins.report_this_video'}"><img src="{module_path}pins/static/image/report.png" class="pin_link_goto pins_type_icon js_hover_title"/></a>
            {/if}
      		{/if}
          
      		{if Phpfox::isModule('share')}
      			{module name='share.link' type=$aPin.ITEMTYPENAME display='image' url=$aPin.ITEMBOOKMARK title=$aPin.ITEMTITLE}	
      		{/if}
          
        </div>

        <div class="pin_who_posted_box_item">
          <div class="pin_who_posted_pic">
            <a href="{permalink module='quiz' id=$aPin.ITEMID title=$aPin.ITEMTITLE}" title="{$aPin.ITEMTITLE|clean|shorten:60:'...'}">
              {img server_id=$aPin.ITEMSERVERID title=$aPin.ITEMTITLE path='quiz.url_image' file=$aPin.ITEMDESTINATION suffix='_75' max_width='75' max_height='75' class='js_hover_title js_mp_fix_width'}
            </a>
          </div>
          <div class="pin_who_posted_text">
            <div>
               {$aPin.ITEMDESCRIPTION|feed_strip|shorten:'300'|split:20}
            </div>
          </div>
          <div class="clear"></div>
        </div>
        
        <div class="clear"></div>
        
        <div class="mac_pins_img_caption">
        <p>        
        {phrase var='pins.posted'} {$aPin.ITEMPOSTEDON} {phrase var='pins.pins_main_by'} 
        <span id="js_user_name_link_{$aPin.ITEMUSERNAME}" class="user_profile_link_span">
          <a href="{url link=$aPin.ITEMUSERNAME}">{$aPin.ITEMFULLNAME}</a>
        </span>
          <br/>
          {phrase var='pins.total_likes'}: <strong>{$aPin.ITEMTOTALLIKE}</strong>
          <br/>
        </p>
        </div>
        
       {if Phpfox::getParam('pins.enable_comment_quiz')} 
       
        {module name='pins.quizcomments' quizCommentItemId=$aPin.ITEMID}

        {/if}
        
      {/if}
        
        <div class="clear"></div>
        
        </div>
        
      </li>
      
      {/foreach}
      
  </ul>
  
  {$nextUrlPaginator}

  <div class="t_right macpaginator-hide">
	{$macpager}
	</div>
  {unset var=$aPin}
  {/if}
	
</div>

<link rel="stylesheet" type="text/css" href="{module_path}pins/static/css/default/default/pins.css" />
<link rel="stylesheet" type="text/css" href="{module_path}pins/static/css/default/default/comments.css" />
<script type="text/javascript" src="{module_path}pins/static/jscript/jquery.masonry.min.js"></script>
<script type="text/javascript" src="{module_path}pins/static/jscript/infinitescroll.js"></script>
<script type="text/javascript" src="{module_path}pins/static/jscript/scrolltotop.js"></script>
<script type="text/javascript" src="{module_path}pins/static/jscript/pins.js"></script>
<script type="text/javascript" src="http://macagoraga.com/demo/static/jscript/jquery/plugin/jquery.highlightFade.js"></script>
<script type="text/javascript" src="http://macagoraga.com/demo/static/jscript/jquery/plugin/jquery.scrollTo.js"></script>
<script type="text/javascript" src="http://macagoraga.com/demo/static/jscript/quick_edit.js"></script>
<script type="text/javascript" src="http://macagoraga.com/demo/static/jscript/switch_legend.js"></script>
<script type="text/javascript" src="http://macagoraga.com/demo/static/jscript/switch_menu.js"></script>
<script type="text/javascript" src="http://macagoraga.com/demo/module/feed/static/jscript/feed.js"></script>
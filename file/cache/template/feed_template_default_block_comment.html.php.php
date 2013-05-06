<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 6, 2013, 7:55 am */ ?>
<?php if (isset ( $this->_aVars['bIsViewingComments'] ) && $this->_aVars['bIsViewingComments']): ?>
<div id="comment-view"><a name="#comment-view"></a></div>
<div class="message js_feed_comment_border">
<?php echo Phpfox::getPhrase('comment.viewing_a_single_comment'); ?> <a href="<?php echo $this->_aVars['aFeed']['feed_link']; ?>"><?php echo Phpfox::getPhrase('comment.view_all_comments'); ?></a>
</div>
<?php endif; ?>

<?php if (isset ( $this->_aVars['sFeedType'] )): ?>
<div class="js_parent_feed_entry parent_item_feed">
<?php endif; ?>

<div class="js_feed_comment_border">
	

<?php (($sPlugin = Phpfox_Plugin::get('feed.template_block_comment_border')) ? eval($sPlugin) : false); ?>
<?php (($sPlugin = Phpfox_Plugin::get('core.template_block_comment_border_new')) ? eval($sPlugin) : false); ?>
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] )): ?>
			<div class="comment_mini_link_like">
<?php /* Cached: May 6, 2013, 7:55 am */ ?>
<?php if (PHPFOX_IS_AJAX && Phpfox ::getLib('request')->get('theater') == 'true'): ?>

			
<?php elseif (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view'): ?>
			<div class="feed_share_custom">	
<?php if (Phpfox ::isModule('share') && Phpfox ::getParam('share.share_twitter_link')): ?>
				<div class="feed_share_custom_block"><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo $this->_aVars['aFeed']['feed_link']; ?>" data-count="horizontal" data-via="<?php echo Phpfox::getParam('feed.twitter_share_via'); ?>"><?php echo Phpfox::getPhrase('feed.tweet'); ?></a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>
<?php endif; ?>
<?php if (Phpfox ::isModule('share') && Phpfox ::getParam('share.share_google_plus_one')): ?>
				<div class="feed_share_custom_block">
					<g:plusone href="<?php echo $this->_aVars['aFeed']['feed_link']; ?>" size="medium"></g:plusone>
					<?php echo '
					<script type="text/javascript">
					  (function() {
						var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
						po.src = \'https://apis.google.com/js/plusone.js\';
						var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
					  })();
					</script>
					'; ?>

				</div>
<?php endif; ?>
<?php if (Phpfox ::isModule('share') && Phpfox ::getParam('share.share_facebook_like')): ?>
				<div class="feed_share_custom_block">
					<iframe src="http://www.facebook.com/plugins/like.php?app_id=156226084453194&amp;href=<?php if (! empty ( $this->_aVars['aFeed']['feed_link'] )):  echo $this->_aVars['aFeed']['feed_link'];  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('current');  endif; ?>&amp;send=false&amp;layout=button_count&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;width=90&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height:21px;" allowTransparency="true"></iframe>					
				</div>
<?php endif; ?>
				<div class="clear"></div>
			</div>
<?php endif; ?>
			
			<ul>
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] )): ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_icon'] ) && ! Phpfox ::isMobile()): ?>
				<li><img src="<?php echo $this->_aVars['aFeed']['feed_icon']; ?>" alt="" /></li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aFeed']['time_stamp'] ) && ! Phpfox ::isMobile()): ?>
				<li class="feed_entry_time_stamp">				
					<a href="<?php echo $this->_aVars['aFeed']['feed_link']; ?>" class="feed_permalink"><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aFeed']['time_stamp'], 'feed.feed_display_time_stamp'); ?></a><?php if (! empty ( $this->_aVars['aFeed']['app_link'] )): ?> via <?php echo $this->_aVars['aFeed']['app_link'];  endif; ?>
				</li>
				<li><span>&middot;</span></li>
<?php endif; ?>
				
<?php if ($this->_aVars['aFeed']['privacy'] > 0 && ( $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId() || Phpfox ::getUserParam('core.can_view_private_items'))): ?>
				<li><div class="js_hover_title"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/privacy_icon.png','alt' => $this->_aVars['aFeed']['privacy'])); ?><span class="js_hover_info"><?php echo Phpfox::getService('privacy')->getPhrase($this->_aVars['aFeed']['privacy']); ?></span></div></li>	
				<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
					
<?php if (Phpfox ::isUser() && Phpfox ::isModule('like') && isset ( $this->_aVars['aFeed']['like_type_id'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['like_item_id'] )): ?>
<?php Phpfox::getBlock('like.link', array('like_type_id' => $this->_aVars['aFeed']['like_type_id'],'like_item_id' => $this->_aVars['aFeed']['like_item_id'],'like_is_liked' => $this->_aVars['aFeed']['feed_is_liked'])); ?>
<?php else: ?>
<?php Phpfox::getBlock('like.link', array('like_type_id' => $this->_aVars['aFeed']['like_type_id'],'like_item_id' => $this->_aVars['aFeed']['item_id'],'like_is_liked' => $this->_aVars['aFeed']['feed_is_liked'])); ?>
<?php endif; ?>
<?php if (Phpfox ::isUser() && Phpfox ::isModule('comment') && Phpfox ::getUserParam('feed.can_post_comment_on_feed') && ( isset ( $this->_aVars['aFeed']['comment_type_id'] ) && $this->_aVars['aFeed']['can_post_comment'] ) || ( ! isset ( $this->_aVars['aFeed']['comment_type_id'] ) && isset ( $this->_aVars['aFeed']['total_comment'] ) )): ?>
				<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
				
<?php if (Phpfox ::isUser() && Phpfox ::isModule('comment') && Phpfox ::getUserParam('feed.can_post_comment_on_feed') && ( isset ( $this->_aVars['aFeed']['comment_type_id'] ) && $this->_aVars['aFeed']['can_post_comment'] ) || ( ! isset ( $this->_aVars['aFeed']['comment_type_id'] ) && isset ( $this->_aVars['aFeed']['total_comment'] ) )): ?>
				<li>
					<a href="<?php echo $this->_aVars['aFeed']['feed_link']; ?>add-comment/" class="<?php if (( isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'mini' ) || ( ! isset ( $this->_aVars['aFeed']['comment_type_id'] ) && isset ( $this->_aVars['aFeed']['total_comment'] ) )):  else: ?>js_feed_entry_add_comment no_ajax_link<?php endif; ?>"><?php echo Phpfox::getPhrase('feed.comment'); ?></a>
				</li>				
<?php if (( Phpfox ::isModule('share') && ! isset ( $this->_aVars['aFeed']['no_share'] ) )): ?>
					<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
<?php if (Phpfox ::isModule('share') && ! isset ( $this->_aVars['aFeed']['no_share'] )): ?>
<?php if ($this->_aVars['aFeed']['privacy'] == '0'): ?>
<?php Phpfox::getBlock('share.link', array('type' => 'feed','display' => 'menu','url' => $this->_aVars['aFeed']['feed_link'],'title' => $this->_aVars['aFeed']['feed_title'],'sharefeedid' => $this->_aVars['aFeed']['item_id'],'sharemodule' => $this->_aVars['aFeed']['type_id'])); ?>
<?php else: ?>
<?php Phpfox::getBlock('share.link', array('type' => 'feed','display' => 'menu','url' => $this->_aVars['aFeed']['feed_link'],'title' => $this->_aVars['aFeed']['feed_title'])); ?>
<?php endif; ?>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aFeed']['report_module'] ) && isset ( $this->_aVars['aFeed']['force_report'] )): ?>
					<li><span>&middot;</span></li>	
					<li><a href="#?call=report.add&amp;height=100&amp;width=400&amp;type=<?php echo $this->_aVars['aFeed']['report_module']; ?>&amp;id=<?php echo $this->_aVars['aFeed']['item_id']; ?>" class="inlinePopup activity_feed_report" title="<?php echo $this->_aVars['aFeed']['report_phrase']; ?>"><?php echo Phpfox::getPhrase('feed.report'); ?></a></li>				
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('feed.template_block_entry_2')) ? eval($sPlugin) : false); ?>
<?php if (Phpfox ::isMobile() && ( ( defined ( 'PHPFOX_FEED_CAN_DELETE' ) ) || ( Phpfox ::getUserParam('feed.can_delete_own_feed') && $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('feed.can_delete_other_feeds'))): ?>
				<li><span>&middot;</span></li>
				<li><a href="#" onclick="if (confirm(getPhrase('core.are_you_sure'))){$.ajaxCall('feed.delete', 'id=<?php echo $this->_aVars['aFeed']['feed_id'];  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&amp;module=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&amp;item=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>', 'GET');} return false;"><?php echo Phpfox::getPhrase('feed.delete'); ?></a></li>
<?php endif; ?>
			</ul>
			<div class="clear"></div>		
			</div>
<?php endif; ?>

<div class="comment_mini_content_holder"<?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view' && $this->_aVars['aFeed']['can_post_comment']):  else:  if (isset ( $this->_aVars['aFeed']['likes'] ) || ( isset ( $this->_aVars['aFeed']['total_comment'] ) && $this->_aVars['aFeed']['total_comment'] > 0 )):  else:  if (( ( isset ( $this->_aVars['aFeed']['comments'] ) && ! count ( $this->_aVars['aFeed']['comments'] ) ) || ! isset ( $this->_aVars['aFeed']['comments'] ) )): ?> style="display:none;"<?php endif;  endif;  endif; ?>>	
	<div class="comment_mini_content_holder_icon"></div>
	<div class="comment_mini_content_border">						
		<div class="js_comment_like_holder" id="js_feed_like_holder_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
			<div id="js_like_body_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
<?php if (isset ( $this->_aVars['aFeed']['likes'] ) && is_array ( $this->_aVars['aFeed']['likes'] )): ?>
<?php /* Cached: May 6, 2013, 7:55 am */  if (Phpfox ::getParam('like.show_user_photos')): ?>
<div class="activity_like_holder comment_mini" style="position:relative;">
	<a href="#" class="like_count_link js_hover_title" onclick="return $Core.box('like.browse', 400, 'type_id=<?php echo $this->_aVars['aFeed']['like_type_id']; ?>&amp;item_id=<?php echo $this->_aVars['aFeed']['item_id']; ?>');"><?php echo number_format($this->_aVars['aFeed']['feed_total_like']); ?><span class="js_hover_info"><?php if (defined ( 'PHPFOX_IS_THEATER_MODE' )):  echo Phpfox::getPhrase('like.likes');  else:  echo Phpfox::getPhrase('like.people_who_like_this');  endif; ?></span></a>
	<div class="like_count_link_holder"><?php if (count((array)$this->_aVars['aFeed']['likes'])):  $this->_aPhpfoxVars['iteration']['likes'] = 0;  foreach ((array) $this->_aVars['aFeed']['likes'] as $this->_aVars['aLikeRow']):  $this->_aPhpfoxVars['iteration']['likes']++;  echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aLikeRow'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32,'class' => 'js_hover_title v_middle')); ?>&nbsp;<?php endforeach; endif; ?></div>
</div>
<?php else: ?><div class="activity_like_holder comment_mini"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/like.png','class' => 'v_middle')); ?>&nbsp;<?php if ($this->_aVars['aFeed']['feed_is_liked']):  if (! count ( $this->_aVars['aFeed']['likes'] ) == 1):  echo Phpfox::getPhrase('like.you');  elseif (count ( $this->_aVars['aFeed']['likes'] ) == 1):  echo Phpfox::getPhrase('like.you_and'); ?>&nbsp;<?php else:  echo Phpfox::getPhrase('like.you_comma'); ?> <?php endif;  else:  echo Phpfox::getPhrase('like.article_to_upper');  endif;  if (count((array)$this->_aVars['aFeed']['likes'])):  $this->_aPhpfoxVars['iteration']['likes'] = 0;  foreach ((array) $this->_aVars['aFeed']['likes'] as $this->_aVars['aLikeRow']):  $this->_aPhpfoxVars['iteration']['likes']++;  if ($this->_aVars['aFeed']['feed_is_liked'] || $this->_aPhpfoxVars['iteration']['likes'] > 1):  echo Phpfox::getPhrase('like.article_to_lower');  endif;  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aLikeRow']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aLikeRow']['user_name'], ((empty($this->_aVars['aLikeRow']['user_name']) && isset($this->_aVars['aLikeRow']['profile_page_id'])) ? $this->_aVars['aLikeRow']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aLikeRow']['full_name'], 30, '...') . '</a></span>';  if ($this->_aPhpfoxVars['iteration']['likes'] == ( count ( $this->_aVars['aFeed']['likes'] ) - 1 ) && $this->_aVars['aFeed']['feed_total_like'] <= Phpfox ::getParam('feed.total_likes_to_display')): ?>&nbsp;<?php echo Phpfox::getPhrase('like.and'); ?>&nbsp;<?php elseif ($this->_aPhpfoxVars['iteration']['likes'] != count ( $this->_aVars['aFeed']['likes'] )): ?>,&nbsp;<?php endif;  endforeach; endif;  if ($this->_aVars['aFeed']['feed_total_like'] > Phpfox ::getParam('feed.total_likes_to_display')): ?><a href="#" onclick="return $Core.box('like.browse', 400, 'type_id=<?php echo $this->_aVars['aFeed']['like_type_id']; ?>&amp;item_id=<?php echo $this->_aVars['aFeed']['item_id']; ?>');"><?php if ($this->_aVars['iTotalLeftShow'] = ( $this->_aVars['aFeed']['feed_total_like'] - Phpfox ::getParam('feed.total_likes_to_display'))):  endif;  if ($this->_aVars['iTotalLeftShow'] == 1): ?>&nbsp;<?php echo Phpfox::getPhrase('like.and'); ?>&nbsp;<?php echo Phpfox::getPhrase('like.1_other_person'); ?>&nbsp;<?php else: ?>&nbsp;<?php echo Phpfox::getPhrase('like.and'); ?>&nbsp;<?php echo number_format($this->_aVars['iTotalLeftShow']); ?>&nbsp;<?php echo Phpfox::getPhrase('like.others'); ?>&nbsp;<?php endif; ?></a><?php echo Phpfox::getPhrase('like.likes_this');  else:  if (( count ( $this->_aVars['aFeed']['likes'] ) > 1 )): ?>&nbsp;<?php echo Phpfox::getPhrase('like.like_this');  else:  if ($this->_aVars['aFeed']['feed_is_liked']):  if (count ( $this->_aVars['aFeed']['likes'] ) == 1): ?>&nbsp;<?php echo Phpfox::getPhrase('like.like_this');  else:  if (count ( $this->_aVars['aFeed']['likes'] ) == 0): ?>&nbsp;<?php echo Phpfox::getPhrase('like.you_like');  else:  echo Phpfox::getPhrase('like.likes_this');  endif;  endif;  else:  if (count ( $this->_aVars['aFeed']['likes'] ) == 1): ?>&nbsp;<?php echo Phpfox::getPhrase('like.likes_this');  else:  echo Phpfox::getPhrase('like.like_this');  endif;  endif;  endif;  endif; ?></div><?php endif; ?>
<?php endif; ?>
			</div>
		</div><!-- // #js_feed_like_holder_<?php echo $this->_aVars['aFeed']['feed_id']; ?> -->
					
<?php if (Phpfox ::isModule('comment') && Phpfox ::getParam('feed.allow_comments_on_feeds')): ?>
		<div id="js_feed_comment_post_<?php echo $this->_aVars['aFeed']['feed_id']; ?>" class="js_feed_comment_view_more_holder">
<?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view'): ?>
		
<?php else: ?>
<?php if (isset ( $this->_aVars['aFeed']['comment_type_id'] ) && isset ( $this->_aVars['aFeed']['total_comment'] ) && ( isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'mini' ? $this->_aVars['aFeed']['total_comment'] > 0 : $this->_aVars['aFeed']['total_comment'] > Phpfox ::getParam('comment.total_comments_in_activity_feed'))): ?>
			<div class="comment_mini comment_mini_link_holder" id="js_feed_comment_view_more_link_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
				<div class="comment_mini_link_image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/comment.png','class' => 'v_middle')); ?>
				</div>
				<div class="comment_mini_link_loader" id="js_feed_comment_ajax_link_<?php echo $this->_aVars['aFeed']['feed_id']; ?>" style="display:none;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'v_middle')); ?></div>
				<div class="comment_mini_link">
					<a href="#" class="comment_mini_link_block comment_mini_link_block_hidden" style="display:none;" onclick="return false;"><?php echo Phpfox::getPhrase('feed.loading'); ?></a>
					<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_comment'] )):  echo $this->_aVars['aFeed']['feed_link_comment'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>comment/"<?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'mini'):  else:  if (Phpfox ::getParam('comment.total_amount_of_comments_to_load') > $this->_aVars['aFeed']['total_comment']): ?>onclick="$('#js_feed_comment_ajax_link_<?php echo $this->_aVars['aFeed']['feed_id']; ?>').show(); $(this).parent().find('.comment_mini_link_block_hidden').show(); $(this).hide(); $.ajaxCall('comment.viewMoreFeed', 'comment_type_id=<?php echo $this->_aVars['aFeed']['comment_type_id']; ?>&amp;item_id=<?php echo $this->_aVars['aFeed']['item_id']; ?>&amp;feed_id=<?php echo $this->_aVars['aFeed']['feed_id']; ?>', 'GET'); return false;"<?php endif;  endif; ?> class="comment_mini_link_block no_ajax_link"><?php echo Phpfox::getPhrase('comment.view_all_total_left_comments', array('total_left' => $this->_aVars['aFeed']['total_comment'])); ?></a>					
				</div>
			</div><!-- // #js_feed_comment_view_more_link_<?php echo $this->_aVars['aFeed']['feed_id']; ?> -->
<?php endif; ?>
<?php if (isset ( $this->_aVars['aFeed']['total_comment'] ) && ! isset ( $this->_aVars['aFeed']['comment_type_id'] ) && $this->_aVars['aFeed']['total_comment'] > 0): ?>
			<div class="comment_mini comment_mini_link_holder" id="js_feed_comment_view_more_link_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
				<div class="comment_mini_link_image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/comment.png','class' => 'v_middle')); ?>
				</div>	
				<div class="comment_mini_link">	
					<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_comment'] )):  echo $this->_aVars['aFeed']['feed_link_comment'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>comment/" class="comment_mini_link_block"><?php echo Phpfox::getPhrase('comment.view_all_total_left_comments', array('total_left' => $this->_aVars['aFeed']['total_comment'])); ?></a>					
				</div>
			</div>
<?php endif; ?>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aFeed']['comments'] ) && count ( $this->_aVars['aFeed']['comments'] )): ?>
<?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view' && $this->_aVars['aFeed']['total_comment'] > Phpfox ::getParam('comment.comment_page_limit')): ?>
			<div class="comment_mini" id="js_feed_comment_pager_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager'); ?>
			</div>
<?php endif; ?>
			<div id="js_feed_comment_view_more_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
<?php Phpfox::getLib('parse.output')->setImageParser(array('width' => 200,'height' => 200)); ?>
<?php if (count((array)$this->_aVars['aFeed']['comments'])):  $this->_aPhpfoxVars['iteration']['comments'] = 0;  foreach ((array) $this->_aVars['aFeed']['comments'] as $this->_aVars['aComment']):  $this->_aPhpfoxVars['iteration']['comments']++; ?>

				<?php /* Cached: May 6, 2013, 7:55 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: mini.html.php 5011 2012-11-12 09:02:36Z Raymond_Benc $
 */
 
 

?>
	<div id="js_comment_<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="js_mini_feed_comment comment_mini js_mini_comment_item_<?php echo $this->_aVars['aComment']['item_id']; ?>">
<?php if (( Phpfox ::getUserParam('comment.delete_own_comment') && Phpfox ::getUserId() == $this->_aVars['aComment']['user_id'] ) || Phpfox ::getUserParam('comment.delete_user_comment') || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('comment.can_delete_comments_posted_on_own_profile')) || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
		<div class="feed_comment_delete_link"><a href="#" class="action_delete js_hover_title" onclick="$.ajaxCall('comment.InlineDelete', 'type_id=<?php echo $this->_aVars['aComment']['type_id']; ?>&amp;comment_id=<?php echo $this->_aVars['aComment']['comment_id'];  if (defined ( 'PHPFOX_IS_THEATER_MODE' )): ?>&photo_theater=1<?php endif; ?>', 'GET'); return false;"><span class="js_hover_info"><?php if (defined ( 'PHPFOX_IS_THEATER_MODE' )):  echo Phpfox::getPhrase('comment.delete');  else:  echo Phpfox::getPhrase('comment.delete_this_comment');  endif; ?></span></a></div>
<?php elseif (Phpfox ::getUserParam('comment.can_delete_comment_on_own_item')&& isset ( $this->_aVars['aFeed'] ) && isset ( $this->_aVars['aFeed']['feed_link'] ) && $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId()): ?>
		<div class="feed_comment_delete_link"><a href="<?php echo $this->_aVars['aFeed']['feed_link']; ?>ownerdeletecmt_<?php echo $this->_aVars['aComment']['comment_id']; ?>/" class="action_delete js_hover_title sJsConfirm"><span class="js_hover_info"><?php if (defined ( 'PHPFOX_IS_THEATER_MODE' )):  echo Phpfox::getPhrase('comment.delete');  else:  echo Phpfox::getPhrase('comment.delete_this_comment');  endif; ?></span></a></div>
<?php endif; ?>
		<div class="comment_mini_image">
<?php if (Phpfox ::isMobile()): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aComment'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32)); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aComment'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32)); ?>
<?php endif; ?>
		</div>
		<div class="comment_mini_content">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aComment']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aComment']['user_name'], ((empty($this->_aVars['aComment']['user_name']) && isset($this->_aVars['aComment']['profile_page_id'])) ? $this->_aVars['aComment']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aComment']['full_name'], 30, '...') . '</a></span>'; ?><div id="js_comment_text_<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="comment_mini_text <?php if ($this->_aVars['aComment']['view_id'] == '1'): ?>row_moderate<?php endif; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aComment']['text']), '300', 'comment.view_more', true), 30); ?></div>
			<div class="comment_mini_action">
				<ul>
					<li class="comment_mini_entry_time_stamp"><?php echo $this->_aVars['aComment']['post_convert_time']; ?></li>
					<li><span>&middot;</span></li>
<?php if (! Phpfox ::isMobile()): ?>
<?php if (( Phpfox ::getUserParam('comment.edit_own_comment') && Phpfox ::getUserId() == $this->_aVars['aComment']['user_id'] ) || Phpfox ::getUserParam('comment.edit_user_comment')): ?>
					<li>
						<a href="inline#?type=text&amp;&amp;simple=true&amp;id=js_comment_text_<?php echo $this->_aVars['aComment']['comment_id']; ?>&amp;call=comment.updateText&amp;comment_id=<?php echo $this->_aVars['aComment']['comment_id']; ?>&amp;data=comment.getText" class="quickEdit"><?php echo Phpfox::getPhrase('comment.edit'); ?></a>
					</li>
					<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
					
<?php if (Phpfox ::getParam('comment.comment_is_threaded') && Phpfox ::getUserParam('feed.can_post_comment_on_feed')): ?>
<?php if (( isset ( $this->_aVars['aComment']['iteration'] ) && $this->_aVars['aComment']['iteration'] >= Phpfox ::getParam('comment.total_child_comments')) || isset ( $this->_aVars['bForceNoReply'] )): ?>
					
<?php else: ?>
					<li><a href="#" class="js_comment_feed_new_reply" rel="<?php echo $this->_aVars['aComment']['comment_id']; ?>"><?php echo Phpfox::getPhrase('comment.reply'); ?></a></li>
					<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
					
<?php if (Phpfox ::isModule('report') && Phpfox ::getUserParam('report.can_report_comments')): ?>
<?php if ($this->_aVars['aComment']['user_id'] != Phpfox ::getUserId()): ?><li><a href="#?call=report.add&amp;height=210&amp;width=400&amp;type=comment&amp;id=<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="inlinePopup" title="<?php echo Phpfox::getPhrase('report.report_a_comment'); ?>"><?php echo Phpfox::getPhrase('report.report'); ?></a></li>
						<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
					
<?php Phpfox::getBlock('like.link', array('like_type_id' => 'feed_mini','like_item_id' => $this->_aVars['aComment']['comment_id'],'like_is_liked' => $this->_aVars['aComment']['is_liked'],'like_is_custom' => true)); ?>
					<li class="js_like_link_holder"<?php if ($this->_aVars['aComment']['total_like'] == 0): ?> style="display:none;"<?php endif; ?>><span>&middot;</span></li>
					<li class="js_like_link_holder"<?php if ($this->_aVars['aComment']['total_like'] == 0): ?> style="display:none;"<?php endif; ?>><a href="#" onclick="return $Core.box('like.browse', 400, 'type_id=feed_mini&amp;item_id=<?php echo $this->_aVars['aComment']['comment_id']; ?>');"><span class="js_like_link_holder_info"><?php if ($this->_aVars['aComment']['total_like'] == 1):  echo Phpfox::getPhrase('comment.1_person');  else:  echo Phpfox::getPhrase('comment.total_people', array('total' => number_format($this->_aVars['aComment']['total_like'])));  endif; ?></span></a></li>
					
<?php if (Phpfox ::getUserParam('comment.can_moderate_comments') && $this->_aVars['aComment']['view_id'] == '1'): ?>
					<li>
						<a href="#" onclick="$('#js_comment_text_<?php echo $this->_aVars['aComment']['comment_id']; ?>').removeClass('row_moderate'); $(this).remove(); $.ajaxCall('comment.moderateSpam', 'id=<?php echo $this->_aVars['aComment']['comment_id']; ?>&amp;action=approve&amp;inacp=0'); return false;"><?php echo Phpfox::getPhrase('comment.approve'); ?></a>					
					</li>					
<?php endif; ?>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		
		<div id="js_comment_form_holder_<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="js_comment_form_holder"></div>

		<div class="comment_mini_child_holder<?php if (isset ( $this->_aVars['aComment']['children'] ) && $this->_aVars['aComment']['children']['total'] > 0): ?> comment_mini_child_holder_padding<?php endif; ?>">
<?php if (isset ( $this->_aVars['aComment']['children'] ) && $this->_aVars['aComment']['children']['total'] > 0): ?>
			<div class="comment_mini_child_view_holder" id="comment_mini_child_view_holder_<?php echo $this->_aVars['aComment']['comment_id']; ?>">
				<a href="#" onclick="$.ajaxCall('comment.viewAllComments', 'comment_type_id=<?php echo $this->_aVars['aComment']['type_id']; ?>&amp;item_id=<?php echo $this->_aVars['aComment']['item_id']; ?>&amp;comment_id=<?php echo $this->_aVars['aComment']['comment_id']; ?>', 'GET'); return false;"><?php echo Phpfox::getPhrase('comment.view_total_more', array('total' => number_format($this->_aVars['aComment']['children']['total']))); ?></a>
			</div>
<?php endif; ?>

			<div id="js_comment_children_holder_<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="comment_mini_child_content">
<?php if (isset ( $this->_aVars['aComment']['children'] ) && count ( $this->_aVars['aComment']['children']['comments'] )): ?>
<?php if (count((array)$this->_aVars['aComment']['children']['comments'])):  foreach ((array) $this->_aVars['aComment']['children']['comments'] as $this->_aVars['aCommentChild']): ?>
<?php Phpfox::getBlock('comment.mini', array('comment_custom' => $this->_aVars['aCommentChild'])); ?>
<?php endforeach; endif; ?>
<?php endif; ?>
			</div>
		</div>		
		
	</div>
<?php endforeach; endif; ?>
<?php Phpfox::getLib('parse.output')->setImageParser(array('clear' => true)); ?>
			</div><!-- // #js_feed_comment_view_more_<?php echo $this->_aVars['aFeed']['feed_id']; ?> -->		
<?php else: ?>
			<div id="js_feed_comment_view_more_<?php echo $this->_aVars['aFeed']['feed_id']; ?>"></div><!-- // #js_feed_comment_view_more_<?php echo $this->_aVars['aFeed']['feed_id']; ?> -->
<?php endif; ?>
		</div><!-- // #js_feed_comment_post_<?php echo $this->_aVars['aFeed']['feed_id']; ?> -->		
<?php endif; ?>
		
<?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'mini'): ?>
		
<?php else: ?>
<?php if (Phpfox ::isModule('comment') && isset ( $this->_aVars['aFeed']['comment_type_id'] ) && Phpfox ::getParam('feed.allow_comments_on_feeds') && Phpfox ::isUser() && $this->_aVars['aFeed']['can_post_comment'] && Phpfox ::getUserParam('feed.can_post_comment_on_feed')): ?>
		<div class="js_feed_comment_form" <?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view'): ?> id="js_feed_comment_form_<?php echo $this->_aVars['aFeed']['feed_id']; ?>"<?php endif; ?>>
			<div class="js_comment_feed_textarea_browse"></div>
			<div class="<?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view'): ?> feed_item_view<?php endif; ?> comment_mini comment_mini_end">
				<form method="post" action="#" class="js_comment_feed_form">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
					<div><input type="hidden" name="val[type]" value="<?php echo $this->_aVars['aFeed']['comment_type_id']; ?>" /></div>			
					<div><input type="hidden" name="val[item_id]" value="<?php echo $this->_aVars['aFeed']['item_id']; ?>" /></div>
					<div><input type="hidden" name="val[parent_id]" value="0" class="js_feed_comment_parent_id" /></div>
					<div><input type="hidden" name="val[is_via_feed]" value="<?php echo $this->_aVars['aFeed']['feed_id']; ?>" /></div>
<?php if (defined ( 'PHPFOX_IS_THEATER_MODE' )): ?>
					<div><input type="hidden" name="ajax_post_photo_theater" value="1" /></div>	
<?php endif; ?>
<?php if (Phpfox ::isUser()): ?>
					<div class="comment_mini_image"<?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view'): ?> <?php else: ?>style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aGlobalUser'],'suffix' => '_50_square','max_width' => '32','max_height' => '32')); ?>
					</div>				
<?php endif; ?>
					<div class="<?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view'): ?>comment_mini_content <?php endif; ?>comment_mini_textarea_holder">
						<div><input type="hidden" name="val[default_feed_value]" value="<?php echo Phpfox::getPhrase('feed.write_a_comment'); ?>" /></div>						
						<div class="js_comment_feed_value"><?php echo Phpfox::getPhrase('feed.write_a_comment'); ?></div>
						<textarea cols="60" rows="4" name="val[text]" class="js_comment_feed_textarea" id="js_feed_comment_form_textarea_<?php echo $this->_aVars['aFeed']['feed_id']; ?>"><?php if (isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view' && Phpfox ::getUserParam('comment.wysiwyg_on_comments') && Phpfox ::getParam('core.wysiwyg') == 'tiny_mce'):  else:  echo Phpfox::getPhrase('feed.write_a_comment');  endif; ?></textarea>
						<div class="js_feed_comment_process_form"><?php echo Phpfox::getPhrase('feed.adding_your_comment');  echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></div>
					</div>
					<div class="feed_comment_buttons_wrap" style="display:block;">
						<div class="js_feed_add_comment_button t_right">
							<input type="submit" value="<?php echo Phpfox::getPhrase('feed.comment'); ?>" class="button" />									
						</div>								
					</div>			
<?php if (! PHPFOX_IS_AJAX && ! Phpfox ::isMobile() && isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'view' && Phpfox ::getUserParam('comment.wysiwyg_on_comments') && Phpfox ::getParam('core.wysiwyg') == 'tiny_mce'): ?>
					<div><input type="hidden" name="val[is_in_view]" value="1" /></div>
					<script type="text/javascript">
						 $Behavior.commentPreLoadTinymce = function(){
							customTinyMCE_init('js_feed_comment_form_textarea_<?php echo $this->_aVars['aFeed']['feed_id']; ?>');
							$Behavior.commentPreLoadTinymce = function(){}
						 }			
					</script>
<?php endif; ?>
				
</form>

			</div>
		</div>
<?php endif; ?>
<?php endif; ?>
		
	</div><!-- // .comment_mini_content_border -->
</div><!-- // .comment_mini_content_holder -->

</div>
<?php if (Phpfox ::isModule('report') && isset ( $this->_aVars['aFeed']['report_module'] ) && ( isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] != 'mini' )): ?>
<div class="report_this_item">
	<a href="#?call=report.add&amp;height=100&amp;width=400&amp;type=<?php echo $this->_aVars['aFeed']['report_module']; ?>&amp;id=<?php echo $this->_aVars['aFeed']['item_id']; ?>" class="item_bar_flag inlinePopup" title="<?php echo $this->_aVars['aFeed']['report_phrase']; ?>"><?php echo $this->_aVars['aFeed']['report_phrase']; ?></a>
</div>
<?php if (Phpfox ::isModule('captcha') && Phpfox ::getUserParam('captcha.captcha_on_comment')): ?>
<?php Phpfox::getBlock('captcha.form', array('sType' => 'comment','captcha_popup' => true)); ?>
<?php endif; ?>
<?php endif; ?>
<?php if (isset ( $this->_aVars['sFeedType'] )): ?>
</div>
<?php endif; ?>

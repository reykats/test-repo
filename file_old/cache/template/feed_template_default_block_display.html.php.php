<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: block.html.php 3952 2012-02-28 14:15:08Z Raymond_Benc $
 */
 
 

?>
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
<div class="block<?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?> js_sortable<?php endif;  if (isset ( $this->_aVars['sCustomClassName'] )): ?> <?php echo $this->_aVars['sCustomClassName'];  endif; ?>"<?php if (isset ( $this->_aVars['sBlockBorderJsId'] )): ?> id="js_block_border_<?php echo $this->_aVars['sBlockBorderJsId']; ?>"<?php endif;  if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) && Phpfox ::getLib('module')->blockIsHidden('js_block_border_' . $this->_aVars['sBlockBorderJsId'] . '' )): ?> style="display:none;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['sHeader'] ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
		<div class="title <?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?>js_sortable_header<?php endif; ?>">		
<?php if (isset ( $this->_aVars['sBlockTitleBar'] )): ?>
<?php echo $this->_aVars['sBlockTitleBar']; ?>
<?php endif; ?>
<?php if (( isset ( $this->_aVars['aEditBar'] ) && Phpfox ::isUser())): ?>
			<div class="js_edit_header_bar">
				<a href="#" title="<?php echo Phpfox::getPhrase('core.edit_this_block'); ?>" onclick="$.ajaxCall('<?php echo $this->_aVars['aEditBar']['ajax_call']; ?>', 'block_id=<?php echo $this->_aVars['sBlockBorderJsId'];  if (isset ( $this->_aVars['aEditBar']['params'] )):  echo $this->_aVars['aEditBar']['params'];  endif; ?>'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_edit.png','alt' => '','class' => 'v_middle')); ?></a>				
			</div>
<?php endif; ?>
<?php if (true || isset ( $this->_aVars['sDeleteBlock'] )): ?>
			<div class="js_edit_header_bar js_edit_header_hover" style="display:none;">
<?php if (Phpfox ::getService('theme')->isInDnDMode()): ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')){
					$(this).parents('.block:first').remove(); $.ajaxCall('core.removeBlockDnD', 'sController=' + oParams['sController'] 
					+ '&amp;block_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>');} return false;"title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>
<?php else: ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')) { $(this).parents('.block:first').remove();
					$.ajaxCall('core.hideBlock', '<?php if (isset ( $this->_aVars['sCustomDesignId'] )): ?>custom_item_id=<?php echo $this->_aVars['sCustomDesignId']; ?>&amp;<?php endif; ?>sController=' + oParams['sController'] + '&amp;type_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>&amp;block_id=' + $(this).parents('.block:first').attr('id')); } return false;" title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>				
<?php endif; ?>
			</div>
			
<?php endif; ?>
<?php if (empty ( $this->_aVars['sHeader'] )): ?>
<?php echo $this->_aVars['sBlockShowName']; ?>
<?php else: ?>
<?php echo $this->_aVars['sHeader']; ?>
<?php endif; ?>
		</div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aEditBar'] )): ?>
	<div id="js_edit_block_<?php echo $this->_aVars['sBlockBorderJsId']; ?>" class="edit_bar" style="display:none;"></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aMenu'] ) && count ( $this->_aVars['aMenu'] )): ?>
	<div class="menu">
	<ul>
<?php if (count((array)$this->_aVars['aMenu'])):  $this->_aPhpfoxVars['iteration']['content'] = 0;  foreach ((array) $this->_aVars['aMenu'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['content']++; ?>
 
		<li class="<?php if (count ( $this->_aVars['aMenu'] ) == $this->_aPhpfoxVars['iteration']['content']): ?> last<?php endif;  if ($this->_aPhpfoxVars['iteration']['content'] == 1): ?> first active<?php endif; ?>"><a href="<?php echo $this->_aVars['sLink']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a></li>
<?php endforeach; endif; ?>
	</ul>
	<div class="clear"></div>
	</div>
<?php unset($this->_aVars['aMenu']); ?>
<?php endif; ?>
	<div class="content"<?php if (isset ( $this->_aVars['sBlockJsId'] )): ?> id="js_block_content_<?php echo $this->_aVars['sBlockJsId']; ?>"<?php endif; ?>>
<?php endif; ?>
		<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: display.html.php 4757 2012-09-25 08:21:09Z Raymond_Benc $
 */
 
 

?>
<?php if (Phpfox ::getService('profile')->timeline()): ?>
<div class="main_timeline" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/timeline.png','return_url' => true)); ?>') repeat-y 50%;">
<?php endif; ?>

<?php if (Phpfox ::isUser() && ! PHPFOX_IS_AJAX && $this->_aVars['sCustomViewType'] === null): ?>
<?php if (( Phpfox ::getUserBy('profile_page_id') > 0 && defined ( 'PHPFOX_IS_USER_PROFILE' ) ) || ( isset ( $this->_aVars['aFeedCallback']['disable_share'] ) && $this->_aVars['aFeedCallback']['disable_share'] ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'feed.share_on_wall' ) ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! Phpfox ::getUserParam('profile.can_post_comment_on_profile') && $this->_aVars['aUser']['user_id'] != Phpfox ::getUserId())): ?>

<?php else: ?>
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: display.html.php 4176 2012-05-16 10:49:38Z Raymond_Benc $
 */
 
 

?>
<div class="activity_feed_form_share">
	<div class="activity_feed_form_share_process"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'v_middle')); ?></div>
<?php if (! isset ( $this->_aVars['bSkipShare'] )): ?>
		<ul class="activity_feed_form_attach">
<?php if (! Phpfox ::isMobile()): ?>
			<li class="share"><?php echo Phpfox::getPhrase('feed.share'); ?>:</li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>
			<li><a href="#" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/comment_add.png','return_url' => true)); ?>') no-repeat center left;" rel="global_attachment_status" class="active"><div><?php echo Phpfox::getPhrase('feed.post'); ?><span class="activity_feed_link_form_ajax"><?php echo $this->_aVars['aFeedCallback']['ajax_request']; ?></span></div><div class="drop"></div></a></li>
<?php elseif (! isset ( $this->_aVars['bFeedIsParentItem'] ) && ( ! defined ( 'PHPFOX_IS_USER_PROFILE' ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()))): ?>
			<li><a href="#" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_add.png','return_url' => true)); ?>') no-repeat center left;" rel="global_attachment_status" class="active"><div><?php echo Phpfox::getPhrase('feed.status'); ?><span class="activity_feed_link_form_ajax">user.updateStatus</span></div><div class="drop"></div></a></li>
<?php else: ?>
			<li><a href="#" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/comment_add.png','return_url' => true)); ?>') no-repeat center left;" rel="global_attachment_status" class="active"><div><?php echo Phpfox::getPhrase('feed.post'); ?><span class="activity_feed_link_form_ajax">feed.addComment</span></div><div class="drop"></div></a></li>
<?php endif; ?>
			
<?php if (count((array)$this->_aVars['aFeedStatusLinks'])):  $this->_aPhpfoxVars['iteration']['feedlinks'] = 0;  foreach ((array) $this->_aVars['aFeedStatusLinks'] as $this->_aVars['aFeedStatusLink']):  $this->_aPhpfoxVars['iteration']['feedlinks']++; ?>

			
<?php if ($this->_aPhpfoxVars['iteration']['feedlinks'] == 3 && Phpfox ::getService('profile')->timeline()): ?>
			<li><a href="#" rel="view_more_link" class="timeline_view_more js_hover_title"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.view_more'); ?></span></a>
				<ul class="view_more_drop">
<?php endif; ?>
			
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] ) && $this->_aVars['aFeedStatusLink']['no_profile']): ?>
<?php else: ?>
<?php if (( $this->_aVars['aFeedStatusLink']['no_profile'] && ! isset ( $this->_aVars['bFeedIsParentItem'] ) && ( ! defined ( 'PHPFOX_IS_USER_PROFILE' ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()))) || ! $this->_aVars['aFeedStatusLink']['no_profile']): ?>
			
			<li>
				<a href="#" style="background-image:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'feed/'.$this->_aVars['aFeedStatusLink']['icon'].'','return_url' => true)); ?>'); background-repeat:no-repeat; background-position:<?php if (Phpfox ::getService('profile')->timeline() && $this->_aPhpfoxVars['iteration']['feedlinks'] >= 3): ?>5px center<?php else: ?>center left<?php endif; ?>;" rel="global_attachment_<?php echo $this->_aVars['aFeedStatusLink']['module_id']; ?>"<?php if ($this->_aVars['aFeedStatusLink']['no_input']): ?> class="no_text_input"<?php endif; ?>>
					<div>
<?php echo Phpfox::getLib('locale')->convert($this->_aVars['aFeedStatusLink']['title']); ?>
<?php if ($this->_aVars['aFeedStatusLink']['is_frame']): ?>
						<span class="activity_feed_link_form"><?php echo Phpfox::getLib('phpfox.url')->makeUrl(''.$this->_aVars['aFeedStatusLink']['module_id'].'.frame'); ?></span>
<?php else: ?>
						<span class="activity_feed_link_form_ajax"><?php echo $this->_aVars['aFeedStatusLink']['module_id']; ?>.<?php echo $this->_aVars['aFeedStatusLink']['ajax_request']; ?></span>
<?php endif; ?>
						<span class="activity_feed_extra_info"><?php echo Phpfox::getLib('locale')->convert($this->_aVars['aFeedStatusLink']['description']); ?></span>
					</div>
					<div class="drop"></div>
				</a>
			</li>
			
<?php endif; ?>
<?php endif; ?>
			
<?php if ($this->_aPhpfoxVars['iteration']['feedlinks'] == count ( $this->_aVars['aFeedStatusLinks'] ) && Phpfox ::getService('profile')->timeline()): ?>
				</ul>
			</li>			
<?php endif; ?>
			
<?php endforeach; endif; ?>
		</ul>
<?php endif; ?>
	<div class="clear"></div>
</div>	

<div class="activity_feed_form">
	<form method="post" action="#" id="js_activity_feed_form" enctype="multipart/form-data">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div id="js_custom_privacy_input_holder"></div>
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>
		<div><input type="hidden" name="val[callback_item_id]" value="<?php echo $this->_aVars['aFeedCallback']['item_id']; ?>" /></div>
		<div><input type="hidden" name="val[callback_module]" value="<?php echo $this->_aVars['aFeedCallback']['module']; ?>" /></div>
		<div><input type="hidden" name="val[parent_user_id]" value="<?php echo $this->_aVars['aFeedCallback']['item_id']; ?>" /></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['bFeedIsParentItem'] )): ?>
		<div><input type="hidden" name="val[parent_table_change]" value="<?php echo $this->_aVars['sFeedIsParentItemModule']; ?>" /></div>
<?php endif; ?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] != Phpfox ::getUserId()): ?>
		<div><input type="hidden" name="val[parent_user_id]" value="<?php echo $this->_aVars['aUser']['user_id']; ?>" /></div>
<?php endif; ?>
		<div class="activity_feed_form_holder">		
			
			<div id="activity_feed_upload_error" style="display:none;"><div class="error_message" id="activity_feed_upload_error_message"></div></div>
			
			<div class="global_attachment_holder_section" id="global_attachment_status" style="display:block;">
				<div id="global_attachment_status_value" style="display:none;"><?php if (isset ( $this->_aVars['aFeedCallback']['module'] ) || defined ( 'PHPFOX_IS_USER_PROFILE' )):  echo Phpfox::getPhrase('feed.write_something');  else:  echo Phpfox::getPhrase('feed.what_s_on_your_mind');  endif; ?></div>
				<textarea <?php if (isset ( $this->_aVars['aPage'] )): ?> id="pageFeedTextarea" <?php else: ?> <?php if (isset ( $this->_aVars['aEvent'] )): ?> id="eventFeedTextarea" <?php else: ?> <?php if (isset ( $this->_aVars['bOwnProfile'] ) && $this->_aVars['bOwnProfile'] == false): ?>id="profileFeedTextarea" <?php endif;  endif;  endif; ?> cols="60" rows="8" name="val[user_status]"><?php if (isset ( $this->_aVars['aFeedCallback']['module'] ) || defined ( 'PHPFOX_IS_USER_PROFILE' )):  echo Phpfox::getPhrase('feed.write_something');  else:  echo Phpfox::getPhrase('feed.what_s_on_your_mind');  endif; ?></textarea>
			</div>
			
<?php if (count((array)$this->_aVars['aFeedStatusLinks'])):  foreach ((array) $this->_aVars['aFeedStatusLinks'] as $this->_aVars['aFeedStatusLink']): ?>
<?php if (! empty ( $this->_aVars['aFeedStatusLink']['module_block'] )): ?>
<?php Phpfox::getBlock($this->_aVars['aFeedStatusLink']['module_block'], array()); ?>
<?php endif; ?>
<?php endforeach; endif; ?>
<?php if (Phpfox ::isModule('egift')): ?>
<?php Phpfox::getBlock('egift.display', array()); ?>
<?php endif; ?>
		</div>
		<div class="activity_feed_form_button">
			<div class="activity_feed_form_button_status_info">
				<textarea id="activity_feed_textarea_status_info" cols="60" rows="8" name="val[status_info]"></textarea>
			</div>
			<div class="activity_feed_form_button_position">
			
<?php if (defined ( 'PHPFOX_IS_PAGES_VIEW' ) && $this->_aVars['aPage']['is_admin'] && $this->_aVars['aPage']['page_id'] != Phpfox ::getUserBy('profile_page_id')): ?>
				<div class="activity_feed_pages_post_as_page">
<?php echo Phpfox::getPhrase('feed.post_as'); ?>:
					<select name="custom_pages_post_as_page">
						<option value="<?php echo $this->_aVars['aPage']['page_id']; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPage']['full_name']), 20, '...'); ?></option>
						<option value="0"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['sGlobalUserFullName'], 20, '...'); ?></option>
					</select>
				</div>
<?php else: ?>
<?php if (( Phpfox ::isModule('share') && ! defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! defined ( 'PHPFOX_IS_PAGES_VIEW' ) && ! defined ( 'PHPFOX_IS_EVENT_VIEW' ) && ( Phpfox ::getParam('share.share_on_facebook') || Phpfox ::getParam('share.share_on_twitter'))) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getService('profile')->timeline() && Phpfox ::getParam('feed.can_add_past_dates'))): ?>
				<div id="activity_feed_share_this_one">
					<ul>
<?php if (( Phpfox ::isModule('share') && ! defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! defined ( 'PHPFOX_IS_PAGES_VIEW' ) && ! defined ( 'PHPFOX_IS_EVENT_VIEW' ) && ( Phpfox ::getParam('share.share_on_facebook') || Phpfox ::getParam('share.share_on_twitter')))): ?>
						<li><a href="#" class="activity_feed_share_this_one_link parent feed_share_site js_hover_title" rel="feed_share_on_holder"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.share_this_on'); ?></span></a></li>
<?php endif; ?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getService('profile')->timeline() && Phpfox ::getParam('feed.can_add_past_dates')): ?>
						<li>
							<a href="#" class="activity_feed_share_this_one_link parent feed_share_watch js_hover_title" rel="timeline_date_holder_share"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.set_a_date'); ?></span></a>
						</li>
<?php endif; ?>
					</ul>
					<div class="clear"></div>
				</div>
<?php endif; ?>
<?php endif; ?>
<?php if (Phpfox ::isModule('share')): ?>
				<div class="feed_share_on_holder timeline_date_holder">						
<?php if (Phpfox ::getParam('share.share_on_facebook')): ?>
					<div class="feed_share_on_item"><a href="#" onclick="$(this).toggleClass('active'); $.ajaxCall('share.connect', 'connect-id=facebook', 'GET'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/facebook.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('feed.facebook'); ?></a></div>
<?php endif; ?>
<?php if (Phpfox ::getParam('share.share_on_twitter')): ?>
					<div class="feed_share_on_item"><a href="#" onclick="$(this).toggleClass('active'); $.ajaxCall('share.connect', 'connect-id=twitter', 'GET'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/twitter.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('feed.twitter'); ?></a></div>
<?php endif; ?>
					<div class="clear"></div>
					<div><input type="hidden" name="val[connection][facebook]" value="0" id="js_share_connection_facebook" class="js_share_connection" /></div>
					<div><input type="hidden" name="val[connection][twitter]" value="0" id="js_share_connection_twitter" class="js_share_connection" /></div>
				</div>					
<?php endif; ?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getService('profile')->timeline() && Phpfox ::getParam('feed.can_add_past_dates')): ?>
				<div class="timeline_date_holder_share timeline_date_holder">					
					<select name="val[start_month]" id="start_month" class="js_datepicker_month">
			<option value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '1')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '1')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('1' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'January' : Phpfox::getPhrase('core.january')); ?></option>
			<option value="2"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '2')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '2')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('2' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'February' : Phpfox::getPhrase('core.february')); ?></option>
			<option value="3"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '3')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '3')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('3' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'March' : Phpfox::getPhrase('core.march')); ?></option>
			<option value="4"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '4')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '4')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('4' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'April' : Phpfox::getPhrase('core.april')); ?></option>
			<option value="5"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '5')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '5')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('5' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'May' : Phpfox::getPhrase('core.may')); ?></option>
			<option value="6"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '6')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '6')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('6' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'June' : Phpfox::getPhrase('core.june')); ?></option>
			<option value="7"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '7')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '7')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('7' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'July' : Phpfox::getPhrase('core.july')); ?></option>
			<option value="8"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '8')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '8')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('8' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'August' : Phpfox::getPhrase('core.august')); ?></option>
			<option value="9"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '9')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '9')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('9' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'September' : Phpfox::getPhrase('core.september')); ?></option>
			<option value="10"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '10')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '10')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('10' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'October' : Phpfox::getPhrase('core.october')); ?></option>
			<option value="11"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '11')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '11')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('11' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'November' : Phpfox::getPhrase('core.november')); ?></option>
			<option value="12"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '12')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '12')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('12' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'December' : Phpfox::getPhrase('core.december')); ?></option>
		</select>
 / 		<select name="val[start_day]" id="start_day" class="js_datepicker_day">
			<option value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '1')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '1')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('1' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>1</option>
			<option value="2"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '2')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '2')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('2' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>2</option>
			<option value="3"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '3')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '3')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('3' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>3</option>
			<option value="4"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '4')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '4')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('4' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>4</option>
			<option value="5"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '5')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '5')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('5' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>5</option>
			<option value="6"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '6')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '6')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('6' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>6</option>
			<option value="7"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '7')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '7')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('7' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>7</option>
			<option value="8"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '8')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '8')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('8' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>8</option>
			<option value="9"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '9')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '9')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('9' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>9</option>
			<option value="10"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '10')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '10')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('10' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>10</option>
			<option value="11"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '11')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '11')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('11' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>11</option>
			<option value="12"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '12')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '12')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('12' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>12</option>
			<option value="13"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '13')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '13')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('13' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>13</option>
			<option value="14"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '14')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '14')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('14' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>14</option>
			<option value="15"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '15')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '15')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('15' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>15</option>
			<option value="16"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '16')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '16')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('16' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>16</option>
			<option value="17"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '17')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '17')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('17' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>17</option>
			<option value="18"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '18')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '18')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('18' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>18</option>
			<option value="19"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '19')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '19')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('19' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>19</option>
			<option value="20"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '20')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '20')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('20' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>20</option>
			<option value="21"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '21')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '21')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('21' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>21</option>
			<option value="22"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '22')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '22')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('22' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>22</option>
			<option value="23"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '23')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '23')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('23' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>23</option>
			<option value="24"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '24')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '24')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('24' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>24</option>
			<option value="25"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '25')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '25')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('25' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>25</option>
			<option value="26"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '26')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '26')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('26' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>26</option>
			<option value="27"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '27')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '27')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('27' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>27</option>
			<option value="28"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '28')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '28')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('28' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>28</option>
			<option value="29"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '29')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '29')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('29' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>29</option>
			<option value="30"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '30')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '30')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('30' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>30</option>
			<option value="31"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '31')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '31')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('31' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>31</option>
		</select>
 / <?php $aYears = range(2013, 1900);   $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); ?>		<select name="val[start_year]" id="start_year" class="js_datepicker_year">
<?php foreach ($aYears as $iYear): ?>			<option value="<?php echo $iYear; ?>"<?php echo ((isset($aParams['start_year']) && $aParams['start_year'] == $iYear) ? ' selected="selected"' : (!isset($this->_aVars['aForms']['start_year']) ? ($iYear == Phpfox::getTime('Y') ? ' selected="selected"' : '') : ($this->_aVars['aForms']['start_year'] == $iYear ? ' selected="selected"' : ''))); ?>><?php echo $iYear; ?></option>
<?php endforeach; ?>		</select>
					
				</div>
<?php endif; ?>
				
				<div class="activity_feed_form_button_position_button">
					<input type="submit" value="<?php echo Phpfox::getPhrase('feed.share'); ?>"  id="activity_feed_submit" class="button" />
				</div>				
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>
<?php else: ?>
<?php if (! isset ( $this->_aVars['bFeedIsParentItem'] ) && ( ! defined ( 'PHPFOX_IS_USER_PROFILE' ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()))): ?>
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy','privacy_type' => 'mini')); ?>
<?php endif; ?>
<?php endif; ?>
				<div class="clear"></div>
			</div>
		</div>			
	
</form>

	<div class="activity_feed_form_iframe"></div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php if (! defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! PHPFOX_IS_AJAX): ?>
<div class="feed_sort_order">
	<a href="#" class="feed_sort_order_link"><?php echo Phpfox::getPhrase('feed.sort'); ?></a>
	<div class="feed_sort_holder">
		<ul>
			<li><a href="#"<?php if (! $this->_aVars['iFeedUserSortOrder']): ?> class="active"<?php endif; ?> rel="0"><?php echo Phpfox::getPhrase('feed.top_stories'); ?></a></li>
			<li><a href="#"<?php if ($this->_aVars['iFeedUserSortOrder']): ?> class="active"<?php endif; ?> rel="1"><?php echo Phpfox::getPhrase('feed.most_recent'); ?></a></li>
		</ul>
	</div>
</div>
<?php endif; ?>
<?php if (Phpfox ::getParam('feed.refresh_activity_feed') > 0 && Phpfox ::getLib('module')->getFullControllerName() == 'core.index-member'): ?>
<div id="activity_feed_updates_link_holder">
    <a href="#" id="activity_feed_updates_link_single" class="activity_feed_updates_link" onclick="return $Core.loadMoreFeeds();"><?php echo Phpfox::getPhrase('feed.1_new_update'); ?></a>
    <a href="#" id="activity_feed_updates_link_plural" class="activity_feed_updates_link" onclick="return $Core.loadMoreFeeds();"><?php echo Phpfox::getPhrase('feed.span_id_js_new_update_view_span_new_updates'); ?></a>
</div>
<?php endif; ?>
<?php if (Phpfox ::isModule('captcha') && Phpfox ::getUserParam('captcha.captcha_on_comment')): ?>
<?php Phpfox::getBlock('captcha.form', array('sType' => 'comment','captcha_popup' => true)); ?>
<?php endif; ?>
<div id="feed"><a name="feed"></a></div>
<div id="js_feed_content">
<?php if ($this->_aVars['sCustomViewType'] !== null): ?>
	<h2><?php echo $this->_aVars['sCustomViewType']; ?></h2>
<?php endif; ?>
	<div id="js_new_feed_comment"></div>
	<div id="js_new_feed_update"></div>
<?php if (Phpfox ::getService('profile')->timeline()): ?>
	<div>
<?php if (PHPFOX_IS_AJAX && ! empty ( $this->_aVars['sLastDayInfo'] ) && ! Phpfox ::getLib('request')->get('resettimeline')): ?>
		<div class="timeline_date">
			<span><?php echo $this->_aVars['sLastDayInfo']; ?></span>
		</div>
<?php endif; ?>
		<div class="timeline_left">			
<?php if (( ! PHPFOX_IS_AJAX && Phpfox ::getService('profile')->timeline()) || Phpfox ::getLib('request')->get('resettimeline')): ?>
<?php if (( Phpfox ::isUser() && ! PHPFOX_IS_AJAX && $this->_aVars['sCustomViewType'] === null ) || Phpfox ::getLib('request')->get('resettimeline')): ?>
<?php if (( Phpfox ::getUserBy('profile_page_id') > 0 && defined ( 'PHPFOX_IS_USER_PROFILE' ) ) || ( isset ( $this->_aVars['aFeedCallback']['disable_share'] ) && $this->_aVars['aFeedCallback']['disable_share'] ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'feed.share_on_wall' ) ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! Phpfox ::getUserParam('profile.can_post_comment_on_profile') && $this->_aVars['aUser']['user_id'] != Phpfox ::getUserId())): ?>

<?php else: ?>
			<div class="timeline_feed_row">
				<div class="timeline_arrow_left">0</div>
				<div class="timeline_float_left">0</div>			
				<div class="timeline_holder">
					<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: display.html.php 4176 2012-05-16 10:49:38Z Raymond_Benc $
 */
 
 

?>
<div class="activity_feed_form_share">
	<div class="activity_feed_form_share_process"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'v_middle')); ?></div>
<?php if (! isset ( $this->_aVars['bSkipShare'] )): ?>
		<ul class="activity_feed_form_attach">
<?php if (! Phpfox ::isMobile()): ?>
			<li class="share"><?php echo Phpfox::getPhrase('feed.share'); ?>:</li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>
			<li><a href="#" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/comment_add.png','return_url' => true)); ?>') no-repeat center left;" rel="global_attachment_status" class="active"><div><?php echo Phpfox::getPhrase('feed.post'); ?><span class="activity_feed_link_form_ajax"><?php echo $this->_aVars['aFeedCallback']['ajax_request']; ?></span></div><div class="drop"></div></a></li>
<?php elseif (! isset ( $this->_aVars['bFeedIsParentItem'] ) && ( ! defined ( 'PHPFOX_IS_USER_PROFILE' ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()))): ?>
			<li><a href="#" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_add.png','return_url' => true)); ?>') no-repeat center left;" rel="global_attachment_status" class="active"><div><?php echo Phpfox::getPhrase('feed.status'); ?><span class="activity_feed_link_form_ajax">user.updateStatus</span></div><div class="drop"></div></a></li>
<?php else: ?>
			<li><a href="#" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/comment_add.png','return_url' => true)); ?>') no-repeat center left;" rel="global_attachment_status" class="active"><div><?php echo Phpfox::getPhrase('feed.post'); ?><span class="activity_feed_link_form_ajax">feed.addComment</span></div><div class="drop"></div></a></li>
<?php endif; ?>
			
<?php if (count((array)$this->_aVars['aFeedStatusLinks'])):  $this->_aPhpfoxVars['iteration']['feedlinks'] = 0;  foreach ((array) $this->_aVars['aFeedStatusLinks'] as $this->_aVars['aFeedStatusLink']):  $this->_aPhpfoxVars['iteration']['feedlinks']++; ?>

			
<?php if ($this->_aPhpfoxVars['iteration']['feedlinks'] == 3 && Phpfox ::getService('profile')->timeline()): ?>
			<li><a href="#" rel="view_more_link" class="timeline_view_more js_hover_title"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.view_more'); ?></span></a>
				<ul class="view_more_drop">
<?php endif; ?>
			
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] ) && $this->_aVars['aFeedStatusLink']['no_profile']): ?>
<?php else: ?>
<?php if (( $this->_aVars['aFeedStatusLink']['no_profile'] && ! isset ( $this->_aVars['bFeedIsParentItem'] ) && ( ! defined ( 'PHPFOX_IS_USER_PROFILE' ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()))) || ! $this->_aVars['aFeedStatusLink']['no_profile']): ?>
			
			<li>
				<a href="#" style="background-image:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'feed/'.$this->_aVars['aFeedStatusLink']['icon'].'','return_url' => true)); ?>'); background-repeat:no-repeat; background-position:<?php if (Phpfox ::getService('profile')->timeline() && $this->_aPhpfoxVars['iteration']['feedlinks'] >= 3): ?>5px center<?php else: ?>center left<?php endif; ?>;" rel="global_attachment_<?php echo $this->_aVars['aFeedStatusLink']['module_id']; ?>"<?php if ($this->_aVars['aFeedStatusLink']['no_input']): ?> class="no_text_input"<?php endif; ?>>
					<div>
<?php echo Phpfox::getLib('locale')->convert($this->_aVars['aFeedStatusLink']['title']); ?>
<?php if ($this->_aVars['aFeedStatusLink']['is_frame']): ?>
						<span class="activity_feed_link_form"><?php echo Phpfox::getLib('phpfox.url')->makeUrl(''.$this->_aVars['aFeedStatusLink']['module_id'].'.frame'); ?></span>
<?php else: ?>
						<span class="activity_feed_link_form_ajax"><?php echo $this->_aVars['aFeedStatusLink']['module_id']; ?>.<?php echo $this->_aVars['aFeedStatusLink']['ajax_request']; ?></span>
<?php endif; ?>
						<span class="activity_feed_extra_info"><?php echo Phpfox::getLib('locale')->convert($this->_aVars['aFeedStatusLink']['description']); ?></span>
					</div>
					<div class="drop"></div>
				</a>
			</li>
			
<?php endif; ?>
<?php endif; ?>
			
<?php if ($this->_aPhpfoxVars['iteration']['feedlinks'] == count ( $this->_aVars['aFeedStatusLinks'] ) && Phpfox ::getService('profile')->timeline()): ?>
				</ul>
			</li>			
<?php endif; ?>
			
<?php endforeach; endif; ?>
		</ul>
<?php endif; ?>
	<div class="clear"></div>
</div>	

<div class="activity_feed_form">
	<form method="post" action="#" id="js_activity_feed_form" enctype="multipart/form-data">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div id="js_custom_privacy_input_holder"></div>
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>
		<div><input type="hidden" name="val[callback_item_id]" value="<?php echo $this->_aVars['aFeedCallback']['item_id']; ?>" /></div>
		<div><input type="hidden" name="val[callback_module]" value="<?php echo $this->_aVars['aFeedCallback']['module']; ?>" /></div>
		<div><input type="hidden" name="val[parent_user_id]" value="<?php echo $this->_aVars['aFeedCallback']['item_id']; ?>" /></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['bFeedIsParentItem'] )): ?>
		<div><input type="hidden" name="val[parent_table_change]" value="<?php echo $this->_aVars['sFeedIsParentItemModule']; ?>" /></div>
<?php endif; ?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] != Phpfox ::getUserId()): ?>
		<div><input type="hidden" name="val[parent_user_id]" value="<?php echo $this->_aVars['aUser']['user_id']; ?>" /></div>
<?php endif; ?>
		<div class="activity_feed_form_holder">		
			
			<div id="activity_feed_upload_error" style="display:none;"><div class="error_message" id="activity_feed_upload_error_message"></div></div>
			
			<div class="global_attachment_holder_section" id="global_attachment_status" style="display:block;">
				<div id="global_attachment_status_value" style="display:none;"><?php if (isset ( $this->_aVars['aFeedCallback']['module'] ) || defined ( 'PHPFOX_IS_USER_PROFILE' )):  echo Phpfox::getPhrase('feed.write_something');  else:  echo Phpfox::getPhrase('feed.what_s_on_your_mind');  endif; ?></div>
				<textarea <?php if (isset ( $this->_aVars['aPage'] )): ?> id="pageFeedTextarea" <?php else: ?> <?php if (isset ( $this->_aVars['aEvent'] )): ?> id="eventFeedTextarea" <?php else: ?> <?php if (isset ( $this->_aVars['bOwnProfile'] ) && $this->_aVars['bOwnProfile'] == false): ?>id="profileFeedTextarea" <?php endif;  endif;  endif; ?> cols="60" rows="8" name="val[user_status]"><?php if (isset ( $this->_aVars['aFeedCallback']['module'] ) || defined ( 'PHPFOX_IS_USER_PROFILE' )):  echo Phpfox::getPhrase('feed.write_something');  else:  echo Phpfox::getPhrase('feed.what_s_on_your_mind');  endif; ?></textarea>
			</div>
			
<?php if (count((array)$this->_aVars['aFeedStatusLinks'])):  foreach ((array) $this->_aVars['aFeedStatusLinks'] as $this->_aVars['aFeedStatusLink']): ?>
<?php if (! empty ( $this->_aVars['aFeedStatusLink']['module_block'] )): ?>
<?php Phpfox::getBlock($this->_aVars['aFeedStatusLink']['module_block'], array()); ?>
<?php endif; ?>
<?php endforeach; endif; ?>
<?php if (Phpfox ::isModule('egift')): ?>
<?php Phpfox::getBlock('egift.display', array()); ?>
<?php endif; ?>
		</div>
		<div class="activity_feed_form_button">
			<div class="activity_feed_form_button_status_info">
				<textarea id="activity_feed_textarea_status_info" cols="60" rows="8" name="val[status_info]"></textarea>
			</div>
			<div class="activity_feed_form_button_position">
			
<?php if (defined ( 'PHPFOX_IS_PAGES_VIEW' ) && $this->_aVars['aPage']['is_admin'] && $this->_aVars['aPage']['page_id'] != Phpfox ::getUserBy('profile_page_id')): ?>
				<div class="activity_feed_pages_post_as_page">
<?php echo Phpfox::getPhrase('feed.post_as'); ?>:
					<select name="custom_pages_post_as_page">
						<option value="<?php echo $this->_aVars['aPage']['page_id']; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPage']['full_name']), 20, '...'); ?></option>
						<option value="0"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['sGlobalUserFullName'], 20, '...'); ?></option>
					</select>
				</div>
<?php else: ?>
<?php if (( Phpfox ::isModule('share') && ! defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! defined ( 'PHPFOX_IS_PAGES_VIEW' ) && ! defined ( 'PHPFOX_IS_EVENT_VIEW' ) && ( Phpfox ::getParam('share.share_on_facebook') || Phpfox ::getParam('share.share_on_twitter'))) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getService('profile')->timeline() && Phpfox ::getParam('feed.can_add_past_dates'))): ?>
				<div id="activity_feed_share_this_one">
					<ul>
<?php if (( Phpfox ::isModule('share') && ! defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! defined ( 'PHPFOX_IS_PAGES_VIEW' ) && ! defined ( 'PHPFOX_IS_EVENT_VIEW' ) && ( Phpfox ::getParam('share.share_on_facebook') || Phpfox ::getParam('share.share_on_twitter')))): ?>
						<li><a href="#" class="activity_feed_share_this_one_link parent feed_share_site js_hover_title" rel="feed_share_on_holder"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.share_this_on'); ?></span></a></li>
<?php endif; ?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getService('profile')->timeline() && Phpfox ::getParam('feed.can_add_past_dates')): ?>
						<li>
							<a href="#" class="activity_feed_share_this_one_link parent feed_share_watch js_hover_title" rel="timeline_date_holder_share"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.set_a_date'); ?></span></a>
						</li>
<?php endif; ?>
					</ul>
					<div class="clear"></div>
				</div>
<?php endif; ?>
<?php endif; ?>
<?php if (Phpfox ::isModule('share')): ?>
				<div class="feed_share_on_holder timeline_date_holder">						
<?php if (Phpfox ::getParam('share.share_on_facebook')): ?>
					<div class="feed_share_on_item"><a href="#" onclick="$(this).toggleClass('active'); $.ajaxCall('share.connect', 'connect-id=facebook', 'GET'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/facebook.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('feed.facebook'); ?></a></div>
<?php endif; ?>
<?php if (Phpfox ::getParam('share.share_on_twitter')): ?>
					<div class="feed_share_on_item"><a href="#" onclick="$(this).toggleClass('active'); $.ajaxCall('share.connect', 'connect-id=twitter', 'GET'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/twitter.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('feed.twitter'); ?></a></div>
<?php endif; ?>
					<div class="clear"></div>
					<div><input type="hidden" name="val[connection][facebook]" value="0" id="js_share_connection_facebook" class="js_share_connection" /></div>
					<div><input type="hidden" name="val[connection][twitter]" value="0" id="js_share_connection_twitter" class="js_share_connection" /></div>
				</div>					
<?php endif; ?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getService('profile')->timeline() && Phpfox ::getParam('feed.can_add_past_dates')): ?>
				<div class="timeline_date_holder_share timeline_date_holder">					
					<select name="val[start_month]" id="start_month" class="js_datepicker_month">
			<option value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '1')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '1')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('1' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'January' : Phpfox::getPhrase('core.january')); ?></option>
			<option value="2"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '2')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '2')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('2' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'February' : Phpfox::getPhrase('core.february')); ?></option>
			<option value="3"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '3')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '3')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('3' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'March' : Phpfox::getPhrase('core.march')); ?></option>
			<option value="4"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '4')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '4')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('4' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'April' : Phpfox::getPhrase('core.april')); ?></option>
			<option value="5"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '5')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '5')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('5' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'May' : Phpfox::getPhrase('core.may')); ?></option>
			<option value="6"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '6')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '6')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('6' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'June' : Phpfox::getPhrase('core.june')); ?></option>
			<option value="7"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '7')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '7')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('7' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'July' : Phpfox::getPhrase('core.july')); ?></option>
			<option value="8"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '8')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '8')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('8' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'August' : Phpfox::getPhrase('core.august')); ?></option>
			<option value="9"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '9')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '9')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('9' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'September' : Phpfox::getPhrase('core.september')); ?></option>
			<option value="10"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '10')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '10')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('10' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'October' : Phpfox::getPhrase('core.october')); ?></option>
			<option value="11"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '11')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '11')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('11' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'November' : Phpfox::getPhrase('core.november')); ?></option>
			<option value="12"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_month') && in_array('start_month', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_month'])
								&& $aParams['start_month'] == '12')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_month'])
									&& !isset($aParams['start_month'])
									&& $this->_aVars['aForms']['start_month'] == '12')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_month']) ? ('12' == Phpfox::getTime('n') ? ' selected="selected"' : '') : ''); ?>><?php echo (defined('PHPFOX_INSTALLER') ? 'December' : Phpfox::getPhrase('core.december')); ?></option>
		</select>
 / 		<select name="val[start_day]" id="start_day" class="js_datepicker_day">
			<option value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '1')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '1')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('1' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>1</option>
			<option value="2"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '2')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '2')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('2' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>2</option>
			<option value="3"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '3')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '3')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('3' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>3</option>
			<option value="4"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '4')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '4')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('4' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>4</option>
			<option value="5"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '5')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '5')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('5' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>5</option>
			<option value="6"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '6')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '6')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('6' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>6</option>
			<option value="7"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '7')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '7')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('7' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>7</option>
			<option value="8"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '8')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '8')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('8' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>8</option>
			<option value="9"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '9')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '9')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('9' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>9</option>
			<option value="10"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '10')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '10')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('10' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>10</option>
			<option value="11"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '11')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '11')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('11' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>11</option>
			<option value="12"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '12')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '12')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('12' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>12</option>
			<option value="13"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '13')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '13')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('13' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>13</option>
			<option value="14"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '14')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '14')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('14' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>14</option>
			<option value="15"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '15')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '15')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('15' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>15</option>
			<option value="16"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '16')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '16')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('16' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>16</option>
			<option value="17"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '17')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '17')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('17' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>17</option>
			<option value="18"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '18')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '18')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('18' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>18</option>
			<option value="19"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '19')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '19')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('19' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>19</option>
			<option value="20"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '20')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '20')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('20' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>20</option>
			<option value="21"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '21')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '21')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('21' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>21</option>
			<option value="22"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '22')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '22')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('22' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>22</option>
			<option value="23"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '23')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '23')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('23' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>23</option>
			<option value="24"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '24')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '24')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('24' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>24</option>
			<option value="25"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '25')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '25')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('25' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>25</option>
			<option value="26"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '26')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '26')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('26' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>26</option>
			<option value="27"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '27')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '27')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('27' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>27</option>
			<option value="28"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '28')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '28')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('28' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>28</option>
			<option value="29"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '29')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '29')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('29' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>29</option>
			<option value="30"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '30')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '30')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('30' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>30</option>
			<option value="31"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('start_day') && in_array('start_day', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['start_day'])
								&& $aParams['start_day'] == '31')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['start_day'])
									&& !isset($aParams['start_day'])
									&& $this->_aVars['aForms']['start_day'] == '31')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 echo (!isset($this->_aVars['aForms']['start_day']) ? ('31' == Phpfox::getTime('j') ? ' selected="selected"' : '') : ''); ?>>31</option>
		</select>
 / <?php $aYears = range(2013, 1900);   $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); ?>		<select name="val[start_year]" id="start_year" class="js_datepicker_year">
<?php foreach ($aYears as $iYear): ?>			<option value="<?php echo $iYear; ?>"<?php echo ((isset($aParams['start_year']) && $aParams['start_year'] == $iYear) ? ' selected="selected"' : (!isset($this->_aVars['aForms']['start_year']) ? ($iYear == Phpfox::getTime('Y') ? ' selected="selected"' : '') : ($this->_aVars['aForms']['start_year'] == $iYear ? ' selected="selected"' : ''))); ?>><?php echo $iYear; ?></option>
<?php endforeach; ?>		</select>
					
				</div>
<?php endif; ?>
				
				<div class="activity_feed_form_button_position_button">
					<input type="submit" value="<?php echo Phpfox::getPhrase('feed.share'); ?>"  id="activity_feed_submit" class="button" />
				</div>				
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>
<?php else: ?>
<?php if (! isset ( $this->_aVars['bFeedIsParentItem'] ) && ( ! defined ( 'PHPFOX_IS_USER_PROFILE' ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()))): ?>
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy','privacy_type' => 'mini')); ?>
<?php endif; ?>
<?php endif; ?>
				<div class="clear"></div>
			</div>
		</div>			
	
</form>

	<div class="activity_feed_form_iframe"></div>
</div>
				</div>
			</div>
			<div class="timeline_left_new"></div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php if (count((array)$this->_aVars['aFeedTimeline']['left'])):  $this->_aPhpfoxVars['iteration']['iFeed'] = 0;  foreach ((array) $this->_aVars['aFeedTimeline']['left'] as $this->_aVars['aFeed']):  $this->_aPhpfoxVars['iteration']['iFeed']++; ?>

			<div class="timeline_feed_row">
				<div class="timeline_arrow_left"><?php echo $this->_aVars['aFeed']['feed_id']; ?></div>
				<div class="timeline_float_left"><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aFeed']['time_stamp']); ?></div>
				<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: timeline.html.php 4398 2012-06-27 15:07:37Z Raymond_Benc $
 */
 
 

?>
<div class="timeline_holder js_parent_feed_entry" id="js_item_feed_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
	
<?php if (! Phpfox ::isMobile() && ( ( defined ( 'PHPFOX_FEED_CAN_DELETE' ) ) || ( Phpfox ::getUserParam('feed.can_delete_own_feed') && $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('feed.can_delete_other_feeds'))): ?>
			<div class="feed_delete_link"><a href="#" class="action_delete js_hover_title" onclick="$.ajaxCall('feed.delete', 'id=<?php echo $this->_aVars['aFeed']['feed_id'];  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&amp;module=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&amp;item=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>', 'GET'); return false;"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.delete_this_feed'); ?></span></a></div>
<?php endif; ?>
	
	<div>
		<div style="float:left;">
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['is_custom_app'] ) && $this->_aVars['aFeed']['is_custom_app'] && ( ( isset ( $this->_aVars['aFeed']['view_id'] ) && $this->_aVars['aFeed']['view_id'] == 7 ) || ( isset ( $this->_aVars['aFeed']['gender'] ) && $this->_aVars['aFeed']['gender'] < 1 ) )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => 0,'path' => 'app.url_image','file' => $this->_aVars['aFeed']['app_image_path'],'suffix' => '_square','max_width' => 32,'max_height' => 32)); ?>
<?php else: ?>
<?php if (isset ( $this->_aVars['aFeed']['user_name'] ) && ! empty ( $this->_aVars['aFeed']['user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32)); ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['parent_user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32,'href' => $this->_aVars['aFeed']['parent_user_name'])); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32,'href' => '')); ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
		</div>
		<div style="margin-left:36px; overflow:hidden; width:85%;">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['user_name'], ((empty($this->_aVars['aFeed']['user_name']) && isset($this->_aVars['aFeed']['profile_page_id'])) ? $this->_aVars['aFeed']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['full_name'], 25, '...') . '</a></span>';  if ($this->_aVars['aFeed']['parent_feed_id'] > 0): ?> <?php echo Phpfox::getPhrase('feed.shared');  else:  if (isset ( $this->_aVars['aFeed']['parent_user'] )): ?> <?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/arrow.png','class' => 'v_middle')); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['parent_user']['parent_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['parent_user']['parent_user_name'], ((empty($this->_aVars['aFeed']['parent_user']['parent_user_name']) && isset($this->_aVars['aFeed']['parent_user']['parent_profile_page_id'])) ? $this->_aVars['aFeed']['parent_user']['parent_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['parent_user']['parent_full_name'], 25, '...') . '</a></span>'; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_info'] )): ?> <?php echo $this->_aVars['aFeed']['feed_info'];  endif;  endif; ?>
			<div class="extra_info">
<?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aFeed']['feed_time_stamp'], 'feed.feed_display_time_stamp'); ?>
<?php if ($this->_aVars['aFeed']['privacy'] > 0 && ( $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId() || Phpfox ::getUserParam('core.can_view_private_items'))): ?>
				<div class="js_hover_title"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/privacy_icon.png','alt' => $this->_aVars['aFeed']['privacy'])); ?><span class="js_hover_info"><?php echo Phpfox::getService('privacy')->getPhrase($this->_aVars['aFeed']['privacy']); ?></span></div>
<?php endif; ?>
			</div>
		</div>
		
		<div class="clear"></div>
				
	<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: content.html.php 4909 2012-10-22 05:56:49Z Raymond_Benc $
 */
 
 

?>	
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
	<div class="activity_feed_content">							
<?php endif; ?>
		<div class="activity_feed_content_text">
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] ) && ! Phpfox ::getService('profile')->timeline()): ?>
			<div class="activity_feed_content_info">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['user_name'], ((empty($this->_aVars['aFeed']['user_name']) && isset($this->_aVars['aFeed']['profile_page_id'])) ? $this->_aVars['aFeed']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['full_name'], 50, '...') . '</a></span>';  if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?> <?php echo Phpfox::getPhrase('feed.shared');  else:  if (isset ( $this->_aVars['aFeed']['parent_user'] )): ?> <?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/arrow.png','class' => 'v_middle')); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['parent_user']['parent_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['parent_user']['parent_user_name'], ((empty($this->_aVars['aFeed']['parent_user']['parent_user_name']) && isset($this->_aVars['aFeed']['parent_user']['parent_profile_page_id'])) ? $this->_aVars['aFeed']['parent_user']['parent_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['parent_user']['parent_full_name'], 50, '...') . '</a></span>'; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_info'] )): ?> <?php echo $this->_aVars['aFeed']['feed_info'];  endif;  endif; ?>
			</div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_mini_content'] )): ?>
			<div class="activity_feed_content_status">
				<div class="activity_feed_content_status_left">
					<img src="<?php echo $this->_aVars['aFeed']['feed_icon']; ?>" alt="" class="v_middle" /> <?php echo $this->_aVars['aFeed']['feed_mini_content']; ?> 
				</div>
				<div class="activity_feed_content_status_right">
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
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
				<div class="clear"></div>
			</div>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aFeed']['feed_status'] ) && ( ! empty ( $this->_aVars['aFeed']['feed_status'] ) || $this->_aVars['aFeed']['feed_status'] == '0' )): ?>
			<div class="activity_feed_content_status">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_status']), 200, 'feed.view_more', true), 55); ?>
			</div>
<?php endif; ?>
			
			<div class="activity_feed_content_link">
				
<?php if ($this->_aVars['aFeed']['type_id'] == 'friend' && isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if (count((array)$this->_aVars['aFeed']['more_feed_rows'])):  foreach ((array) $this->_aVars['aFeed']['more_feed_rows'] as $this->_aVars['aFriends']): ?>
<?php echo $this->_aVars['aFriends']['feed_image']; ?>
<?php endforeach; endif; ?>
<?php echo $this->_aVars['aFeed']['feed_image']; ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
				<div class="activity_feed_content_image"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="width:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (is_array ( $this->_aVars['aFeed']['feed_image'] )): ?>
						<ul class="activity_feed_multiple_image">
<?php if (count((array)$this->_aVars['aFeed']['feed_image'])):  foreach ((array) $this->_aVars['aFeed']['feed_image'] as $this->_aVars['sFeedImage']): ?>
								<li><?php echo $this->_aVars['sFeedImage']; ?></li>
<?php endforeach; endif; ?>
						</ul>
						<div class="clear"></div>
<?php else: ?>
						<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>"<?php if (! isset ( $this->_aVars['aFeed']['no_target_blank'] )): ?> target="_blank"<?php endif; ?> class="<?php if (isset ( $this->_aVars['aFeed']['custom_css'] )): ?> <?php echo $this->_aVars['aFeed']['custom_css']; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?>play_link <?php endif; ?> no_ajax_link<?php endif; ?>"<?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )): ?> onclick="<?php echo $this->_aVars['aFeed']['feed_image_onclick']; ?>"<?php endif;  if (! empty ( $this->_aVars['aFeed']['custom_rel'] )): ?> rel="<?php echo $this->_aVars['aFeed']['custom_rel']; ?>"<?php endif;  if (isset ( $this->_aVars['aFeed']['custom_js'] )): ?> <?php echo $this->_aVars['aFeed']['custom_js']; ?> <?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?><span class="play_link_img"><?php echo Phpfox::getPhrase('feed.play'); ?></span><?php endif;  endif;  echo $this->_aVars['aFeed']['feed_image']; ?></a>						
<?php endif; ?>
				</div>
<?php endif; ?>
				<div class="<?php if (( ! empty ( $this->_aVars['aFeed']['feed_content'] ) || ! empty ( $this->_aVars['aFeed']['feed_custom_html'] ) ) && empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_no_image<?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_float<?php endif; ?>"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="margin-left:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
					<span class="user_profile_link_span" id="js_user_name_link_<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_sub']); ?>">
<?php endif; ?>
					<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>" class="activity_feed_content_link_title"<?php if (isset ( $this->_aVars['aFeed']['feed_title_extra_link'] )): ?> target="_blank"<?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title']), 30); ?></a>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
					</span>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title_extra'] )): ?>
					<div class="activity_feed_content_link_title_link">
						<a href="<?php echo $this->_aVars['aFeed']['feed_title_extra_link']; ?>" target="_blank"<?php if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_extra']); ?></a>
					</div>
<?php endif; ?>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_content'] )): ?>
					<div class="activity_feed_content_display">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_content']), 200, '...'), 55); ?>
					</div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_custom_html'] )): ?>
					<div class="activity_feed_content_display_custom">
<?php echo $this->_aVars['aFeed']['feed_custom_html']; ?>
					</div>
<?php endif; ?>
					
<?php if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?>
<?php Phpfox::getBlock('feed.mini', array('parent_feed_id' => $this->_aVars['aFeed']['parent_feed_id'],'parent_module_id' => $this->_aVars['aFeed']['parent_module_id'])); ?>
<?php endif; ?>
					
				</div>	
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
				<div class="clear"></div>
<?php endif; ?>
<?php endif; ?>
			</div>
		</div><!-- // .activity_feed_content_text -->	

<?php if (isset ( $this->_aVars['aFeed']['feed_view_comment'] )): ?>
<?php Phpfox::getBlock('feed.comment', array()); ?>
<?php else: ?>
<?php /* Cached: May 9, 2013, 6:42 am */  if (isset ( $this->_aVars['bIsViewingComments'] ) && $this->_aVars['bIsViewingComments']): ?>
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
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
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
<?php /* Cached: May 9, 2013, 6:42 am */  if (Phpfox ::getParam('like.show_user_photos')): ?>
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

				<?php /* Cached: May 9, 2013, 6:42 am */  
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
<?php endif; ?>
<?php if ($this->_aVars['aFeed']['type_id'] != 'friend'): ?>
<?php if (isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if ($this->_aVars['iTotalExtraFeedsToShow'] = count ( $this->_aVars['aFeed']['more_feed_rows'] )):  endif; ?>
		<a href="#" class="activity_feed_content_view_more" onclick="$(this).parents('.js_feed_view_more_entry_holder:first').find('.js_feed_view_more_entry').show(); $(this).remove(); return false;"><?php echo Phpfox::getPhrase('feed.see_total_more_posts_from_full_name', array('total' => $this->_aVars['iTotalExtraFeedsToShow'],'full_name' => Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getFirstname($this->_aVars['aFeed']['full_name']), 40, '...'))); ?></a>			
<?php endif; ?>
<?php endif; ?>
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
	</div><!-- // .activity_feed_content -->
<?php endif; ?>
		
	</div>		
</div>
<?php if (! PHPFOX_IS_AJAX && is_int ( $this->_aPhpfoxVars['iteration']['iFeed'] / 2 )): ?>
<div class="clear"></div>
<?php endif; ?>
			</div>		
<?php endforeach; endif; ?>
		</div>
		<div class="timeline_right">
<?php if (! PHPFOX_IS_AJAX || Phpfox ::getLib('request')->get('resettimeline')): ?>
			<div class="timeline_feed_row">				
<?php Phpfox::getBlock('friend.timeline', array()); ?>
			</div>
<?php endif; ?>
<?php if (count((array)$this->_aVars['aFeedTimeline']['right'])):  $this->_aPhpfoxVars['iteration']['iFeed'] = 0;  foreach ((array) $this->_aVars['aFeedTimeline']['right'] as $this->_aVars['aFeed']):  $this->_aPhpfoxVars['iteration']['iFeed']++; ?>

			<div class="timeline_feed_row">
				<div class="timeline_arrow_right"><?php echo $this->_aVars['aFeed']['feed_id']; ?></div>
				<div class="timeline_float_right"><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aFeed']['time_stamp']); ?></div>
				<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: timeline.html.php 4398 2012-06-27 15:07:37Z Raymond_Benc $
 */
 
 

?>
<div class="timeline_holder js_parent_feed_entry" id="js_item_feed_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
	
<?php if (! Phpfox ::isMobile() && ( ( defined ( 'PHPFOX_FEED_CAN_DELETE' ) ) || ( Phpfox ::getUserParam('feed.can_delete_own_feed') && $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('feed.can_delete_other_feeds'))): ?>
			<div class="feed_delete_link"><a href="#" class="action_delete js_hover_title" onclick="$.ajaxCall('feed.delete', 'id=<?php echo $this->_aVars['aFeed']['feed_id'];  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&amp;module=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&amp;item=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>', 'GET'); return false;"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.delete_this_feed'); ?></span></a></div>
<?php endif; ?>
	
	<div>
		<div style="float:left;">
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['is_custom_app'] ) && $this->_aVars['aFeed']['is_custom_app'] && ( ( isset ( $this->_aVars['aFeed']['view_id'] ) && $this->_aVars['aFeed']['view_id'] == 7 ) || ( isset ( $this->_aVars['aFeed']['gender'] ) && $this->_aVars['aFeed']['gender'] < 1 ) )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => 0,'path' => 'app.url_image','file' => $this->_aVars['aFeed']['app_image_path'],'suffix' => '_square','max_width' => 32,'max_height' => 32)); ?>
<?php else: ?>
<?php if (isset ( $this->_aVars['aFeed']['user_name'] ) && ! empty ( $this->_aVars['aFeed']['user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32)); ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['parent_user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32,'href' => $this->_aVars['aFeed']['parent_user_name'])); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32,'href' => '')); ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
		</div>
		<div style="margin-left:36px; overflow:hidden; width:85%;">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['user_name'], ((empty($this->_aVars['aFeed']['user_name']) && isset($this->_aVars['aFeed']['profile_page_id'])) ? $this->_aVars['aFeed']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['full_name'], 25, '...') . '</a></span>';  if ($this->_aVars['aFeed']['parent_feed_id'] > 0): ?> <?php echo Phpfox::getPhrase('feed.shared');  else:  if (isset ( $this->_aVars['aFeed']['parent_user'] )): ?> <?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/arrow.png','class' => 'v_middle')); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['parent_user']['parent_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['parent_user']['parent_user_name'], ((empty($this->_aVars['aFeed']['parent_user']['parent_user_name']) && isset($this->_aVars['aFeed']['parent_user']['parent_profile_page_id'])) ? $this->_aVars['aFeed']['parent_user']['parent_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['parent_user']['parent_full_name'], 25, '...') . '</a></span>'; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_info'] )): ?> <?php echo $this->_aVars['aFeed']['feed_info'];  endif;  endif; ?>
			<div class="extra_info">
<?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aFeed']['feed_time_stamp'], 'feed.feed_display_time_stamp'); ?>
<?php if ($this->_aVars['aFeed']['privacy'] > 0 && ( $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId() || Phpfox ::getUserParam('core.can_view_private_items'))): ?>
				<div class="js_hover_title"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/privacy_icon.png','alt' => $this->_aVars['aFeed']['privacy'])); ?><span class="js_hover_info"><?php echo Phpfox::getService('privacy')->getPhrase($this->_aVars['aFeed']['privacy']); ?></span></div>
<?php endif; ?>
			</div>
		</div>
		
		<div class="clear"></div>
				
	<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: content.html.php 4909 2012-10-22 05:56:49Z Raymond_Benc $
 */
 
 

?>	
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
	<div class="activity_feed_content">							
<?php endif; ?>
		<div class="activity_feed_content_text">
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] ) && ! Phpfox ::getService('profile')->timeline()): ?>
			<div class="activity_feed_content_info">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['user_name'], ((empty($this->_aVars['aFeed']['user_name']) && isset($this->_aVars['aFeed']['profile_page_id'])) ? $this->_aVars['aFeed']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['full_name'], 50, '...') . '</a></span>';  if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?> <?php echo Phpfox::getPhrase('feed.shared');  else:  if (isset ( $this->_aVars['aFeed']['parent_user'] )): ?> <?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/arrow.png','class' => 'v_middle')); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['parent_user']['parent_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['parent_user']['parent_user_name'], ((empty($this->_aVars['aFeed']['parent_user']['parent_user_name']) && isset($this->_aVars['aFeed']['parent_user']['parent_profile_page_id'])) ? $this->_aVars['aFeed']['parent_user']['parent_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['parent_user']['parent_full_name'], 50, '...') . '</a></span>'; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_info'] )): ?> <?php echo $this->_aVars['aFeed']['feed_info'];  endif;  endif; ?>
			</div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_mini_content'] )): ?>
			<div class="activity_feed_content_status">
				<div class="activity_feed_content_status_left">
					<img src="<?php echo $this->_aVars['aFeed']['feed_icon']; ?>" alt="" class="v_middle" /> <?php echo $this->_aVars['aFeed']['feed_mini_content']; ?> 
				</div>
				<div class="activity_feed_content_status_right">
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
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
				<div class="clear"></div>
			</div>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aFeed']['feed_status'] ) && ( ! empty ( $this->_aVars['aFeed']['feed_status'] ) || $this->_aVars['aFeed']['feed_status'] == '0' )): ?>
			<div class="activity_feed_content_status">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_status']), 200, 'feed.view_more', true), 55); ?>
			</div>
<?php endif; ?>
			
			<div class="activity_feed_content_link">
				
<?php if ($this->_aVars['aFeed']['type_id'] == 'friend' && isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if (count((array)$this->_aVars['aFeed']['more_feed_rows'])):  foreach ((array) $this->_aVars['aFeed']['more_feed_rows'] as $this->_aVars['aFriends']): ?>
<?php echo $this->_aVars['aFriends']['feed_image']; ?>
<?php endforeach; endif; ?>
<?php echo $this->_aVars['aFeed']['feed_image']; ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
				<div class="activity_feed_content_image"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="width:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (is_array ( $this->_aVars['aFeed']['feed_image'] )): ?>
						<ul class="activity_feed_multiple_image">
<?php if (count((array)$this->_aVars['aFeed']['feed_image'])):  foreach ((array) $this->_aVars['aFeed']['feed_image'] as $this->_aVars['sFeedImage']): ?>
								<li><?php echo $this->_aVars['sFeedImage']; ?></li>
<?php endforeach; endif; ?>
						</ul>
						<div class="clear"></div>
<?php else: ?>
						<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>"<?php if (! isset ( $this->_aVars['aFeed']['no_target_blank'] )): ?> target="_blank"<?php endif; ?> class="<?php if (isset ( $this->_aVars['aFeed']['custom_css'] )): ?> <?php echo $this->_aVars['aFeed']['custom_css']; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?>play_link <?php endif; ?> no_ajax_link<?php endif; ?>"<?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )): ?> onclick="<?php echo $this->_aVars['aFeed']['feed_image_onclick']; ?>"<?php endif;  if (! empty ( $this->_aVars['aFeed']['custom_rel'] )): ?> rel="<?php echo $this->_aVars['aFeed']['custom_rel']; ?>"<?php endif;  if (isset ( $this->_aVars['aFeed']['custom_js'] )): ?> <?php echo $this->_aVars['aFeed']['custom_js']; ?> <?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?><span class="play_link_img"><?php echo Phpfox::getPhrase('feed.play'); ?></span><?php endif;  endif;  echo $this->_aVars['aFeed']['feed_image']; ?></a>						
<?php endif; ?>
				</div>
<?php endif; ?>
				<div class="<?php if (( ! empty ( $this->_aVars['aFeed']['feed_content'] ) || ! empty ( $this->_aVars['aFeed']['feed_custom_html'] ) ) && empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_no_image<?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_float<?php endif; ?>"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="margin-left:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
					<span class="user_profile_link_span" id="js_user_name_link_<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_sub']); ?>">
<?php endif; ?>
					<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>" class="activity_feed_content_link_title"<?php if (isset ( $this->_aVars['aFeed']['feed_title_extra_link'] )): ?> target="_blank"<?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title']), 30); ?></a>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
					</span>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title_extra'] )): ?>
					<div class="activity_feed_content_link_title_link">
						<a href="<?php echo $this->_aVars['aFeed']['feed_title_extra_link']; ?>" target="_blank"<?php if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_extra']); ?></a>
					</div>
<?php endif; ?>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_content'] )): ?>
					<div class="activity_feed_content_display">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_content']), 200, '...'), 55); ?>
					</div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_custom_html'] )): ?>
					<div class="activity_feed_content_display_custom">
<?php echo $this->_aVars['aFeed']['feed_custom_html']; ?>
					</div>
<?php endif; ?>
					
<?php if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?>
<?php Phpfox::getBlock('feed.mini', array('parent_feed_id' => $this->_aVars['aFeed']['parent_feed_id'],'parent_module_id' => $this->_aVars['aFeed']['parent_module_id'])); ?>
<?php endif; ?>
					
				</div>	
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
				<div class="clear"></div>
<?php endif; ?>
<?php endif; ?>
			</div>
		</div><!-- // .activity_feed_content_text -->	

<?php if (isset ( $this->_aVars['aFeed']['feed_view_comment'] )): ?>
<?php Phpfox::getBlock('feed.comment', array()); ?>
<?php else: ?>
<?php /* Cached: May 9, 2013, 6:42 am */  if (isset ( $this->_aVars['bIsViewingComments'] ) && $this->_aVars['bIsViewingComments']): ?>
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
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
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
<?php /* Cached: May 9, 2013, 6:42 am */  if (Phpfox ::getParam('like.show_user_photos')): ?>
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

				<?php /* Cached: May 9, 2013, 6:42 am */  
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
<?php endif; ?>
<?php if ($this->_aVars['aFeed']['type_id'] != 'friend'): ?>
<?php if (isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if ($this->_aVars['iTotalExtraFeedsToShow'] = count ( $this->_aVars['aFeed']['more_feed_rows'] )):  endif; ?>
		<a href="#" class="activity_feed_content_view_more" onclick="$(this).parents('.js_feed_view_more_entry_holder:first').find('.js_feed_view_more_entry').show(); $(this).remove(); return false;"><?php echo Phpfox::getPhrase('feed.see_total_more_posts_from_full_name', array('total' => $this->_aVars['iTotalExtraFeedsToShow'],'full_name' => Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getFirstname($this->_aVars['aFeed']['full_name']), 40, '...'))); ?></a>			
<?php endif; ?>
<?php endif; ?>
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
	</div><!-- // .activity_feed_content -->
<?php endif; ?>
		
	</div>		
</div>
<?php if (! PHPFOX_IS_AJAX && is_int ( $this->_aPhpfoxVars['iteration']['iFeed'] / 2 )): ?>
<div class="clear"></div>
<?php endif; ?>
			</div>
<?php endforeach; endif; ?>
		</div>		
		<div class="clear"></div>
	</div>	
	
<?php if (! PHPFOX_IS_AJAX): ?>
<?php if (count((array)$this->_aVars['aTimelineDates'])):  foreach ((array) $this->_aVars['aTimelineDates'] as $this->_aVars['aTimelineDate']): ?>
			<div id="js_timeline_year_holder_<?php echo $this->_aVars['aTimelineDate']['year']; ?>"></div>
<?php if (count((array)$this->_aVars['aTimelineDate']['months'])):  foreach ((array) $this->_aVars['aTimelineDate']['months'] as $this->_aVars['aMonth']): ?>
			<div id="js_timeline_month_holder_<?php echo $this->_aVars['aTimelineDate']['year']; ?>_<?php echo $this->_aVars['aMonth']['id']; ?>"></div>
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
<?php endif; ?>
<?php else: ?>
<?php if (count((array)$this->_aVars['aFeeds'])):  $this->_aPhpfoxVars['iteration']['iFeed'] = 0;  foreach ((array) $this->_aVars['aFeeds'] as $this->_aVars['aFeed']):  $this->_aPhpfoxVars['iteration']['iFeed']++; ?>

<?php if (isset ( $this->_aVars['aFeed']['feed_mini'] ) && ! isset ( $this->_aVars['bHasRecentShow'] )): ?>
<?php if ($this->_aVars['bHasRecentShow'] = true):  endif; ?>
	<div class="activity_recent_holder">
	<div class="activity_recent_title">
<?php echo Phpfox::getPhrase('feed.recent_activity'); ?>
	</div>
<?php endif; ?>
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] ) && isset ( $this->_aVars['bHasRecentShow'] )): ?>
	</div>
<?php unset($this->_aVars['bHasRecentShow']); ?>
<?php endif; ?>
	
	<div class="js_feed_view_more_entry_holder">
		<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: entry.html.php 4171 2012-05-16 07:10:36Z Raymond_Benc $
 */
 
 

?>
<div class="row_feed_loop js_parent_feed_entry <?php if (isset ( $this->_aVars['aFeed']['feed_mini'] )): ?> row_mini <?php else:  if (isset ( $this->_aVars['bChildFeed'] )): ?> row1<?php else:  if (isset ( $this->_aPhpfoxVars['iteration']['iFeed'] )):  if (is_int ( $this->_aPhpfoxVars['iteration']['iFeed'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['iFeed'] == 1 && ! PHPFOX_IS_AJAX): ?> row_first<?php endif;  else: ?>row1<?php endif;  endif;  endif; ?> js_user_feed" id="js_item_feed_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
<?php if (! Phpfox ::isMobile() && ( ( defined ( 'PHPFOX_FEED_CAN_DELETE' ) ) || ( Phpfox ::getUserParam('feed.can_delete_own_feed') && $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('feed.can_delete_other_feeds'))): ?>
	<div class="feed_delete_link"><a href="#" class="action_delete js_hover_title" onclick="$.ajaxCall('feed.delete', 'id=<?php echo $this->_aVars['aFeed']['feed_id'];  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&amp;module=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&amp;item=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>', 'GET'); return false;"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.delete_this_feed'); ?></span></a></div>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('feed.template_block_entry_1')) ? eval($sPlugin) : false); ?>
	<div class="activity_feed_image">	
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['is_custom_app'] ) && $this->_aVars['aFeed']['is_custom_app'] && ( ( isset ( $this->_aVars['aFeed']['view_id'] ) && $this->_aVars['aFeed']['view_id'] == 7 ) || ( isset ( $this->_aVars['aFeed']['gender'] ) && $this->_aVars['aFeed']['gender'] < 1 ) )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => 0,'path' => 'app.url_image','file' => $this->_aVars['aFeed']['app_image_path'],'suffix' => '_square','max_width' => 50,'max_height' => 50)); ?>
<?php else: ?>
<?php if (isset ( $this->_aVars['aFeed']['user_name'] ) && ! empty ( $this->_aVars['aFeed']['user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50)); ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['parent_user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50,'href' => $this->_aVars['aFeed']['parent_user_name'])); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50,'href' => '')); ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
	</div><!-- // .activity_feed_image -->
	
	<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: content.html.php 4909 2012-10-22 05:56:49Z Raymond_Benc $
 */
 
 

?>	
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
	<div class="activity_feed_content">							
<?php endif; ?>
		<div class="activity_feed_content_text">
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] ) && ! Phpfox ::getService('profile')->timeline()): ?>
			<div class="activity_feed_content_info">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['user_name'], ((empty($this->_aVars['aFeed']['user_name']) && isset($this->_aVars['aFeed']['profile_page_id'])) ? $this->_aVars['aFeed']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['full_name'], 50, '...') . '</a></span>';  if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?> <?php echo Phpfox::getPhrase('feed.shared');  else:  if (isset ( $this->_aVars['aFeed']['parent_user'] )): ?> <?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/arrow.png','class' => 'v_middle')); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['parent_user']['parent_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['parent_user']['parent_user_name'], ((empty($this->_aVars['aFeed']['parent_user']['parent_user_name']) && isset($this->_aVars['aFeed']['parent_user']['parent_profile_page_id'])) ? $this->_aVars['aFeed']['parent_user']['parent_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['parent_user']['parent_full_name'], 50, '...') . '</a></span>'; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_info'] )): ?> <?php echo $this->_aVars['aFeed']['feed_info'];  endif;  endif; ?>
			</div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_mini_content'] )): ?>
			<div class="activity_feed_content_status">
				<div class="activity_feed_content_status_left">
					<img src="<?php echo $this->_aVars['aFeed']['feed_icon']; ?>" alt="" class="v_middle" /> <?php echo $this->_aVars['aFeed']['feed_mini_content']; ?> 
				</div>
				<div class="activity_feed_content_status_right">
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
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
				<div class="clear"></div>
			</div>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aFeed']['feed_status'] ) && ( ! empty ( $this->_aVars['aFeed']['feed_status'] ) || $this->_aVars['aFeed']['feed_status'] == '0' )): ?>
			<div class="activity_feed_content_status">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_status']), 200, 'feed.view_more', true), 55); ?>
			</div>
<?php endif; ?>
			
			<div class="activity_feed_content_link">
				
<?php if ($this->_aVars['aFeed']['type_id'] == 'friend' && isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if (count((array)$this->_aVars['aFeed']['more_feed_rows'])):  foreach ((array) $this->_aVars['aFeed']['more_feed_rows'] as $this->_aVars['aFriends']): ?>
<?php echo $this->_aVars['aFriends']['feed_image']; ?>
<?php endforeach; endif; ?>
<?php echo $this->_aVars['aFeed']['feed_image']; ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
				<div class="activity_feed_content_image"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="width:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (is_array ( $this->_aVars['aFeed']['feed_image'] )): ?>
						<ul class="activity_feed_multiple_image">
<?php if (count((array)$this->_aVars['aFeed']['feed_image'])):  foreach ((array) $this->_aVars['aFeed']['feed_image'] as $this->_aVars['sFeedImage']): ?>
								<li><?php echo $this->_aVars['sFeedImage']; ?></li>
<?php endforeach; endif; ?>
						</ul>
						<div class="clear"></div>
<?php else: ?>
						<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>"<?php if (! isset ( $this->_aVars['aFeed']['no_target_blank'] )): ?> target="_blank"<?php endif; ?> class="<?php if (isset ( $this->_aVars['aFeed']['custom_css'] )): ?> <?php echo $this->_aVars['aFeed']['custom_css']; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?>play_link <?php endif; ?> no_ajax_link<?php endif; ?>"<?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )): ?> onclick="<?php echo $this->_aVars['aFeed']['feed_image_onclick']; ?>"<?php endif;  if (! empty ( $this->_aVars['aFeed']['custom_rel'] )): ?> rel="<?php echo $this->_aVars['aFeed']['custom_rel']; ?>"<?php endif;  if (isset ( $this->_aVars['aFeed']['custom_js'] )): ?> <?php echo $this->_aVars['aFeed']['custom_js']; ?> <?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?><span class="play_link_img"><?php echo Phpfox::getPhrase('feed.play'); ?></span><?php endif;  endif;  echo $this->_aVars['aFeed']['feed_image']; ?></a>						
<?php endif; ?>
				</div>
<?php endif; ?>
				<div class="<?php if (( ! empty ( $this->_aVars['aFeed']['feed_content'] ) || ! empty ( $this->_aVars['aFeed']['feed_custom_html'] ) ) && empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_no_image<?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_float<?php endif; ?>"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="margin-left:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
					<span class="user_profile_link_span" id="js_user_name_link_<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_sub']); ?>">
<?php endif; ?>
					<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>" class="activity_feed_content_link_title"<?php if (isset ( $this->_aVars['aFeed']['feed_title_extra_link'] )): ?> target="_blank"<?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title']), 30); ?></a>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
					</span>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title_extra'] )): ?>
					<div class="activity_feed_content_link_title_link">
						<a href="<?php echo $this->_aVars['aFeed']['feed_title_extra_link']; ?>" target="_blank"<?php if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_extra']); ?></a>
					</div>
<?php endif; ?>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_content'] )): ?>
					<div class="activity_feed_content_display">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_content']), 200, '...'), 55); ?>
					</div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_custom_html'] )): ?>
					<div class="activity_feed_content_display_custom">
<?php echo $this->_aVars['aFeed']['feed_custom_html']; ?>
					</div>
<?php endif; ?>
					
<?php if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?>
<?php Phpfox::getBlock('feed.mini', array('parent_feed_id' => $this->_aVars['aFeed']['parent_feed_id'],'parent_module_id' => $this->_aVars['aFeed']['parent_module_id'])); ?>
<?php endif; ?>
					
				</div>	
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
				<div class="clear"></div>
<?php endif; ?>
<?php endif; ?>
			</div>
		</div><!-- // .activity_feed_content_text -->	

<?php if (isset ( $this->_aVars['aFeed']['feed_view_comment'] )): ?>
<?php Phpfox::getBlock('feed.comment', array()); ?>
<?php else: ?>
<?php /* Cached: May 9, 2013, 6:42 am */  if (isset ( $this->_aVars['bIsViewingComments'] ) && $this->_aVars['bIsViewingComments']): ?>
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
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
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
<?php /* Cached: May 9, 2013, 6:42 am */  if (Phpfox ::getParam('like.show_user_photos')): ?>
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

				<?php /* Cached: May 9, 2013, 6:42 am */  
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
<?php endif; ?>
<?php if ($this->_aVars['aFeed']['type_id'] != 'friend'): ?>
<?php if (isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if ($this->_aVars['iTotalExtraFeedsToShow'] = count ( $this->_aVars['aFeed']['more_feed_rows'] )):  endif; ?>
		<a href="#" class="activity_feed_content_view_more" onclick="$(this).parents('.js_feed_view_more_entry_holder:first').find('.js_feed_view_more_entry').show(); $(this).remove(); return false;"><?php echo Phpfox::getPhrase('feed.see_total_more_posts_from_full_name', array('total' => $this->_aVars['iTotalExtraFeedsToShow'],'full_name' => Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getFirstname($this->_aVars['aFeed']['full_name']), 40, '...'))); ?></a>			
<?php endif; ?>
<?php endif; ?>
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
	</div><!-- // .activity_feed_content -->
<?php endif; ?>
	
<?php (($sPlugin = Phpfox_Plugin::get('feed.template_block_entry_3')) ? eval($sPlugin) : false); ?>
</div><!-- // #js_item_feed_<?php echo $this->_aVars['aFeed']['feed_id']; ?> -->
<?php if (isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if (count((array)$this->_aVars['aFeed']['more_feed_rows'])):  foreach ((array) $this->_aVars['aFeed']['more_feed_rows'] as $this->_aVars['aFeed']): ?>
<?php if ($this->_aVars['bChildFeed'] = true):  endif; ?>
		<div class="js_feed_view_more_entry" style="display:none;">
			<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: entry.html.php 4171 2012-05-16 07:10:36Z Raymond_Benc $
 */
 
 

?>
<div class="row_feed_loop js_parent_feed_entry <?php if (isset ( $this->_aVars['aFeed']['feed_mini'] )): ?> row_mini <?php else:  if (isset ( $this->_aVars['bChildFeed'] )): ?> row1<?php else:  if (isset ( $this->_aPhpfoxVars['iteration']['iFeed'] )):  if (is_int ( $this->_aPhpfoxVars['iteration']['iFeed'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['iFeed'] == 1 && ! PHPFOX_IS_AJAX): ?> row_first<?php endif;  else: ?>row1<?php endif;  endif;  endif; ?> js_user_feed" id="js_item_feed_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
<?php if (! Phpfox ::isMobile() && ( ( defined ( 'PHPFOX_FEED_CAN_DELETE' ) ) || ( Phpfox ::getUserParam('feed.can_delete_own_feed') && $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('feed.can_delete_other_feeds'))): ?>
	<div class="feed_delete_link"><a href="#" class="action_delete js_hover_title" onclick="$.ajaxCall('feed.delete', 'id=<?php echo $this->_aVars['aFeed']['feed_id'];  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&amp;module=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&amp;item=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>', 'GET'); return false;"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.delete_this_feed'); ?></span></a></div>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('feed.template_block_entry_1')) ? eval($sPlugin) : false); ?>
	<div class="activity_feed_image">	
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['is_custom_app'] ) && $this->_aVars['aFeed']['is_custom_app'] && ( ( isset ( $this->_aVars['aFeed']['view_id'] ) && $this->_aVars['aFeed']['view_id'] == 7 ) || ( isset ( $this->_aVars['aFeed']['gender'] ) && $this->_aVars['aFeed']['gender'] < 1 ) )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => 0,'path' => 'app.url_image','file' => $this->_aVars['aFeed']['app_image_path'],'suffix' => '_square','max_width' => 50,'max_height' => 50)); ?>
<?php else: ?>
<?php if (isset ( $this->_aVars['aFeed']['user_name'] ) && ! empty ( $this->_aVars['aFeed']['user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50)); ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['parent_user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50,'href' => $this->_aVars['aFeed']['parent_user_name'])); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50,'href' => '')); ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
	</div><!-- // .activity_feed_image -->
	
	<?php /* Cached: May 9, 2013, 6:42 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: content.html.php 4909 2012-10-22 05:56:49Z Raymond_Benc $
 */
 
 

?>	
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
	<div class="activity_feed_content">							
<?php endif; ?>
		<div class="activity_feed_content_text">
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] ) && ! Phpfox ::getService('profile')->timeline()): ?>
			<div class="activity_feed_content_info">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['user_name'], ((empty($this->_aVars['aFeed']['user_name']) && isset($this->_aVars['aFeed']['profile_page_id'])) ? $this->_aVars['aFeed']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['full_name'], 50, '...') . '</a></span>';  if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?> <?php echo Phpfox::getPhrase('feed.shared');  else:  if (isset ( $this->_aVars['aFeed']['parent_user'] )): ?> <?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/arrow.png','class' => 'v_middle')); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['parent_user']['parent_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['parent_user']['parent_user_name'], ((empty($this->_aVars['aFeed']['parent_user']['parent_user_name']) && isset($this->_aVars['aFeed']['parent_user']['parent_profile_page_id'])) ? $this->_aVars['aFeed']['parent_user']['parent_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['parent_user']['parent_full_name'], 50, '...') . '</a></span>'; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_info'] )): ?> <?php echo $this->_aVars['aFeed']['feed_info'];  endif;  endif; ?>
			</div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_mini_content'] )): ?>
			<div class="activity_feed_content_status">
				<div class="activity_feed_content_status_left">
					<img src="<?php echo $this->_aVars['aFeed']['feed_icon']; ?>" alt="" class="v_middle" /> <?php echo $this->_aVars['aFeed']['feed_mini_content']; ?> 
				</div>
				<div class="activity_feed_content_status_right">
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
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
				<div class="clear"></div>
			</div>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aFeed']['feed_status'] ) && ( ! empty ( $this->_aVars['aFeed']['feed_status'] ) || $this->_aVars['aFeed']['feed_status'] == '0' )): ?>
			<div class="activity_feed_content_status">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_status']), 200, 'feed.view_more', true), 55); ?>
			</div>
<?php endif; ?>
			
			<div class="activity_feed_content_link">
				
<?php if ($this->_aVars['aFeed']['type_id'] == 'friend' && isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if (count((array)$this->_aVars['aFeed']['more_feed_rows'])):  foreach ((array) $this->_aVars['aFeed']['more_feed_rows'] as $this->_aVars['aFriends']): ?>
<?php echo $this->_aVars['aFriends']['feed_image']; ?>
<?php endforeach; endif; ?>
<?php echo $this->_aVars['aFeed']['feed_image']; ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
				<div class="activity_feed_content_image"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="width:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (is_array ( $this->_aVars['aFeed']['feed_image'] )): ?>
						<ul class="activity_feed_multiple_image">
<?php if (count((array)$this->_aVars['aFeed']['feed_image'])):  foreach ((array) $this->_aVars['aFeed']['feed_image'] as $this->_aVars['sFeedImage']): ?>
								<li><?php echo $this->_aVars['sFeedImage']; ?></li>
<?php endforeach; endif; ?>
						</ul>
						<div class="clear"></div>
<?php else: ?>
						<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>"<?php if (! isset ( $this->_aVars['aFeed']['no_target_blank'] )): ?> target="_blank"<?php endif; ?> class="<?php if (isset ( $this->_aVars['aFeed']['custom_css'] )): ?> <?php echo $this->_aVars['aFeed']['custom_css']; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?>play_link <?php endif; ?> no_ajax_link<?php endif; ?>"<?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )): ?> onclick="<?php echo $this->_aVars['aFeed']['feed_image_onclick']; ?>"<?php endif;  if (! empty ( $this->_aVars['aFeed']['custom_rel'] )): ?> rel="<?php echo $this->_aVars['aFeed']['custom_rel']; ?>"<?php endif;  if (isset ( $this->_aVars['aFeed']['custom_js'] )): ?> <?php echo $this->_aVars['aFeed']['custom_js']; ?> <?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?><span class="play_link_img"><?php echo Phpfox::getPhrase('feed.play'); ?></span><?php endif;  endif;  echo $this->_aVars['aFeed']['feed_image']; ?></a>						
<?php endif; ?>
				</div>
<?php endif; ?>
				<div class="<?php if (( ! empty ( $this->_aVars['aFeed']['feed_content'] ) || ! empty ( $this->_aVars['aFeed']['feed_custom_html'] ) ) && empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_no_image<?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_float<?php endif; ?>"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="margin-left:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
					<span class="user_profile_link_span" id="js_user_name_link_<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_sub']); ?>">
<?php endif; ?>
					<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>" class="activity_feed_content_link_title"<?php if (isset ( $this->_aVars['aFeed']['feed_title_extra_link'] )): ?> target="_blank"<?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title']), 30); ?></a>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
					</span>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title_extra'] )): ?>
					<div class="activity_feed_content_link_title_link">
						<a href="<?php echo $this->_aVars['aFeed']['feed_title_extra_link']; ?>" target="_blank"<?php if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_extra']); ?></a>
					</div>
<?php endif; ?>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_content'] )): ?>
					<div class="activity_feed_content_display">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_content']), 200, '...'), 55); ?>
					</div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_custom_html'] )): ?>
					<div class="activity_feed_content_display_custom">
<?php echo $this->_aVars['aFeed']['feed_custom_html']; ?>
					</div>
<?php endif; ?>
					
<?php if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?>
<?php Phpfox::getBlock('feed.mini', array('parent_feed_id' => $this->_aVars['aFeed']['parent_feed_id'],'parent_module_id' => $this->_aVars['aFeed']['parent_module_id'])); ?>
<?php endif; ?>
					
				</div>	
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
				<div class="clear"></div>
<?php endif; ?>
<?php endif; ?>
			</div>
		</div><!-- // .activity_feed_content_text -->	

<?php if (isset ( $this->_aVars['aFeed']['feed_view_comment'] )): ?>
<?php Phpfox::getBlock('feed.comment', array()); ?>
<?php else: ?>
<?php /* Cached: May 9, 2013, 6:42 am */  if (isset ( $this->_aVars['bIsViewingComments'] ) && $this->_aVars['bIsViewingComments']): ?>
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
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
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
<?php /* Cached: May 9, 2013, 6:42 am */  if (Phpfox ::getParam('like.show_user_photos')): ?>
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

				<?php /* Cached: May 9, 2013, 6:42 am */  
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
<?php endif; ?>
<?php if ($this->_aVars['aFeed']['type_id'] != 'friend'): ?>
<?php if (isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if ($this->_aVars['iTotalExtraFeedsToShow'] = count ( $this->_aVars['aFeed']['more_feed_rows'] )):  endif; ?>
		<a href="#" class="activity_feed_content_view_more" onclick="$(this).parents('.js_feed_view_more_entry_holder:first').find('.js_feed_view_more_entry').show(); $(this).remove(); return false;"><?php echo Phpfox::getPhrase('feed.see_total_more_posts_from_full_name', array('total' => $this->_aVars['iTotalExtraFeedsToShow'],'full_name' => Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getFirstname($this->_aVars['aFeed']['full_name']), 40, '...'))); ?></a>			
<?php endif; ?>
<?php endif; ?>
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
	</div><!-- // .activity_feed_content -->
<?php endif; ?>
	
<?php (($sPlugin = Phpfox_Plugin::get('feed.template_block_entry_3')) ? eval($sPlugin) : false); ?>
</div><!-- // #js_item_feed_<?php echo $this->_aVars['aFeed']['feed_id']; ?> -->
		</div>
<?php endforeach; endif; ?>
<?php unset($this->_aVars['bChildFeed']); ?>
<?php endif; ?>
	</div>	
<?php endforeach; endif; ?>
<?php endif; ?>
	
<?php if (isset ( $this->_aVars['bHasRecentShow'] )): ?>
	</div>
<?php endif; ?>
<?php if ($this->_aVars['sCustomViewType'] === null): ?>
<?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' )): ?>
	
<?php else: ?>
<?php if (count ( $this->_aVars['aFeeds'] )): ?>
	<div id="feed_view_more">
		<div id="js_feed_pass_info" style="display:none;">page=<?php echo $this->_aVars['iFeedNextPage'];  if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] )): ?>&profile_user_id=<?php echo $this->_aVars['aUser']['user_id'];  endif;  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&callback_module_id=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&callback_item_id=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>&year=<?php echo $this->_aVars['sTimelineYear']; ?>&month=<?php echo $this->_aVars['sTimelineMonth']; ?></div>
		<div id="feed_view_more_loader"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></div>
		<a href="<?php if (Phpfox ::getLib('module')->getFullControllerName() == 'core.index-visitor'):  echo Phpfox::getLib('phpfox.url')->makeUrl('core.index-visitor', array('page' => $this->_aVars['iFeedNextPage']));  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('current', array('page' => $this->_aVars['iFeedNextPage']));  endif; ?>" onclick="$(this).hide(); $('#feed_view_more_loader').show(); $.ajaxCall('feed.viewMore', 'page=<?php echo $this->_aVars['iFeedNextPage'];  if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] )): ?>&profile_user_id=<?php echo $this->_aVars['aUser']['user_id'];  endif;  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&callback_module_id=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&callback_item_id=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>&year=<?php echo $this->_aVars['sTimelineYear']; ?>&month=<?php echo $this->_aVars['sTimelineMonth']; ?>', 'GET'); return false;" class="global_view_more no_ajax_link"><?php echo Phpfox::getPhrase('feed.view_more'); ?></a>
	</div>
<?php else: ?>
<?php if (Phpfox ::getService('profile')->timeline()): ?>
<?php Phpfox::getBlock('user.birth', array()); ?>
<?php else: ?>
	<br />
	<div class="message js_no_feed_to_show"><?php echo Phpfox::getPhrase('feed.there_are_no_new_feeds_to_view_at_this_time'); ?></div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php if (! PHPFOX_IS_AJAX || ( PHPFOX_IS_AJAX && count ( $this->_aVars['aFeedVals'] ) )): ?>
</div>
<?php endif; ?>
<?php if (Phpfox ::getParam('feed.refresh_activity_feed') > 0 && Phpfox ::getLib('module')->getFullControllerName() == 'core.index-member'): ?>
<script type="text/javascript">
	$Core.reloadActivityFeed();
</script>
<?php endif; ?>

<?php if (Phpfox ::getService('profile')->timeline()): ?>
</div>
<?php endif; ?>

		
		
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
	</div>
<?php if (isset ( $this->_aVars['aFooter'] ) && count ( $this->_aVars['aFooter'] )): ?>
	<div class="bottom">
		<ul>
<?php if (count((array)$this->_aVars['aFooter'])):  $this->_aPhpfoxVars['iteration']['block'] = 0;  foreach ((array) $this->_aVars['aFooter'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['block']++; ?>

				<li id="js_block_bottom_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"<?php if ($this->_aPhpfoxVars['iteration']['block'] == 1): ?> class="first"<?php endif; ?>>
<?php if ($this->_aVars['sLink'] == '#'): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'ajax_image')); ?>
<?php endif; ?>
					<a href="<?php echo $this->_aVars['sLink']; ?>" id="js_block_bottom_link_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a>
				</li>
<?php endforeach; endif; ?>
		</ul>
	</div>
<?php endif; ?>
</div>
<?php unset($this->_aVars['sHeader'], $this->_aVars['sModule'], $this->_aVars['sComponent'], $this->_aVars['aFooter'], $this->_aVars['sBlockBorderJsId'], $this->_aVars['bBlockDisableSort'], $this->_aVars['bBlockCanMove'], $this->_aVars['aEditBar'], $this->_aVars['sDeleteBlock'], $this->_aVars['sBlockTitleBar'], $this->_aVars['sBlockJsId'], $this->_aVars['sCustomClassName']); ?>
<?php endif; ?>

<?php Phpfox::getBlock('ad.inner', array('sClass' => $this->_aVars['sClass'])); ?>

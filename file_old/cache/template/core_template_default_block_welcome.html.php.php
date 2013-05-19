<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 9, 2013, 6:42 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Core
 * @version 		$Id: welcome.html.php 3991 2012-03-12 12:16:05Z Raymond_Benc $
 */
 
 

?>
<div id="welcome">
	<div class="welcome_profile_right">
		<div id="theme"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('core.index-member.customize'); ?>" class="no_ajax_link"><?php echo Phpfox::getPhrase('core.customize_dashboard'); ?></a></div>
		<div id="time_stamp">
			<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.setting'); ?>" title="<?php echo Phpfox::getPhrase('core.change_your_time_zone_preference'); ?>"><?php echo $this->_aVars['sCurrentTimeStamp']; ?></a>
		</div>
	</div>
	<div class="welcome_profile_image">
<?php echo $this->_aVars['sUserProfileImage']; ?>
	</div>
	<div class="welcome_profile_name">
		<div class="user_display_name"><a href="<?php echo $this->_aVars['sUserProfileUrl']; ?>"><?php echo $this->_aVars['sCurrentUserName']; ?></a></div>
		<div class="welcome_quick_link">
			<ul>				
				<li><a href="#core.info"><?php echo Phpfox::getPhrase('core.account_info'); ?></a><span>&middot;</span></li>
<?php if (Phpfox ::getParam('user.no_show_activity_points')): ?>
				<li><a href="#core.activity"><?php echo Phpfox::getPhrase('core.activity_points'); ?><span id="js_global_total_activity_points">(<?php echo number_format($this->_aVars['iTotalActivityPoints']); ?>)</span></a><span>&middot;</span></li>
<?php endif; ?>
<?php if (Phpfox ::isModule('subscribe') && Phpfox ::getParam('subscribe.enable_subscription_packages')): ?>
				<li><a href="#subscribe.listUpgrades" rel="welcome_info_holder_custom"><?php echo Phpfox::getPhrase('subscribe.membership_membership_name', array('membership_name' => $this->_aVars['sUserGroupFullName'])); ?></a><span>&middot;</span></li>				
<?php endif; ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.profile'); ?>"><?php echo Phpfox::getPhrase('core.edit_profile'); ?></a><span>&middot;</span></li>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('profile'); ?>"><?php echo Phpfox::getPhrase('core.profile_views'); ?><span>(<?php echo number_format($this->_aVars['iTotalProfileViews']); ?>)</span></a></li>
			</ul>
			<div class="clear"></div>
		</div>		
	</div>
</div>

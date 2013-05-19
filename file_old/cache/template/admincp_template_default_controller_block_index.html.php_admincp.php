<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 8, 2013, 8:12 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: index.html.php 4481 2012-07-06 08:05:15Z Raymond_Benc $
 */
 
 

?>
<a href="#" onclick="$.ajaxCall('core.designdnd', 'enable=1'); return false;" id="admincp_enabled_dnd"><?php echo Phpfox::getPhrase('admincp.enable_dnd_mode'); ?></a>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.add'); ?>" onsubmit="$('#js_setting_saved').html($.ajaxProcess('Saving')).show(); $(this).ajaxCall('user.updateSettings'); return false;">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<div class="table_header">
<?php echo Phpfox::getPhrase('admincp.controllers'); ?><span id="js_editing_block" style="display:none;"> - <span id="js_editing_block_text"></span></span>
	</div>	
	<div id="content_editor_holder">
		<div id="content_editor_menu">
			<ul>
<?php if (count((array)$this->_aVars['aBlocks'])):  foreach ((array) $this->_aVars['aBlocks'] as $this->_aVars['sUrl'] => $this->_aVars['aModules']): ?>
				<li><a href="#" onclick="$.ajaxCall('admincp.getBlocks', 'm_connection=<?php echo $this->_aVars['sUrl']; ?>', 'GET'); $(this).blur(); $('#content_editor_menu a').removeClass('cem_active'); $(this).addClass('cem_active'); return false;"><?php if (empty ( $this->_aVars['sUrl'] )):  echo Phpfox::getPhrase('admincp.site_wide');  else:  echo $this->_aVars['sUrl'];  endif; ?></a></li>
<?php endforeach; endif; ?>
			</ul>
		</div>
		<div id="content_editor_text">
			<div id="js_setting_block">
				<div class="extra_info">
<?php echo Phpfox::getPhrase('admincp.to_your_left_you_will_find_all_the_available'); ?>
				</div>
			</div>			
		</div>
		<div class="clear"></div>
	</div>

</form>


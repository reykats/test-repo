<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 9, 2013, 7:04 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Theme
 * @version 		$Id: index.html.php 1298 2009-12-05 16:19:23Z Raymond_Benc $
 */
 
 

?>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.theme'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<div class="table_header">
<?php echo Phpfox::getPhrase('theme.themes'); ?>
	</div>
	<table>
	<tr>
		<th style="width:20px;"></th>
		<th><?php echo Phpfox::getPhrase('admincp.name'); ?></th>
		<th class="t_center"><?php echo Phpfox::getPhrase('theme.styles'); ?></th>
		<th class="t_center" style="width:60px;"><?php echo Phpfox::getPhrase('theme.active'); ?></th>
	</tr>
<?php if (count((array)$this->_aVars['aThemes'])):  foreach ((array) $this->_aVars['aThemes'] as $this->_aVars['iKey'] => $this->_aVars['aTheme']): ?>
	<tr class="checkRow<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> tr<?php else:  endif; ?>">
		<td class="t_center">
			<a href="#" class="js_drop_down_link" title="<?php echo Phpfox::getPhrase('theme.manage'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_arrow_down.png','alt' => '')); ?></a>
			<div class="link_menu">
				<ul>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.theme.add', array('id' => $this->_aVars['aTheme']['theme_id'])); ?>"><?php echo Phpfox::getPhrase('theme.edit_theme'); ?></a></li>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.theme.template', array('id' => $this->_aVars['aTheme']['theme_id'])); ?>"><?php echo Phpfox::getPhrase('theme.edit_templates'); ?></a></li>		
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.theme.style', array('id' => $this->_aVars['aTheme']['theme_id'])); ?>"><?php echo Phpfox::getPhrase('theme.manage_styles'); ?></a></li>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.theme.style.add', array('theme' => $this->_aVars['aTheme']['theme_id'])); ?>"><?php echo Phpfox::getPhrase('theme.create_style'); ?></a></li>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.theme.export', array('theme' => $this->_aVars['aTheme']['theme_id'])); ?>"><?php echo Phpfox::getPhrase('theme.export_theme'); ?></a></li>
<?php if ($this->_aVars['aTheme']['folder'] != 'default'): ?>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.theme', array('delete' => $this->_aVars['aTheme']['theme_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('theme.are_you_sure', array('phpfox_squote' => true)); ?>');"><?php echo Phpfox::getPhrase('theme.delete'); ?></a></li>
<?php endif; ?>
				</ul>
			</div>		
		</td>	
		<td><?php echo $this->_aVars['aTheme']['name']; ?></td>
		<td class="t_center"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.theme.style', array('id' => $this->_aVars['aTheme']['theme_id'])); ?>"><?php echo $this->_aVars['aTheme']['total_style']; ?></a></td>
		<td class="t_center">
			<div class="js_item_is_active"<?php if (! $this->_aVars['aTheme']['is_active']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=theme.updateThemeActivity&amp;id=<?php echo $this->_aVars['aTheme']['theme_id']; ?>&amp;active=0" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('theme.deactivate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => '')); ?></a>
			</div>
			<div class="js_item_is_not_active"<?php if ($this->_aVars['aTheme']['is_active']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=theme.updateThemeActivity&amp;id=<?php echo $this->_aVars['aTheme']['theme_id']; ?>&amp;active=1" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('theme.activate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => '')); ?></a>
			</div>		
		</td>
	</tr>
<?php endforeach; endif; ?>
	</table>
	<div class="table_bottom">
		<input type="submit" value="<?php echo Phpfox::getPhrase('admincp.update'); ?>" class="button" />
	</div>

</form>


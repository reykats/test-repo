<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 8, 2013, 8:13 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: setting.html.php 3826 2011-12-16 12:30:19Z Raymond_Benc $
 */
 
 

?>	<?php if (count((array)$this->_aVars['aModules'])):  foreach ((array) $this->_aVars['aModules'] as $this->_aVars['iBlock'] => $this->_aVars['aSubBlocks']): ?>
	<div class="table_header2">
<?php echo Phpfox::getPhrase('admincp.block_block_number', array('block_number' => $this->_aVars['iBlock'])); ?>
	</div>
	<table class="js_drag_drop" cellpadding="0" cellspacing="0">
<?php if (count((array)$this->_aVars['aSubBlocks'])):  foreach ((array) $this->_aVars['aSubBlocks'] as $this->_aVars['iKey'] => $this->_aVars['aBlock']): ?>
	<tr class="checkRow<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> tr<?php else:  endif; ?>">
		<td class="drag_handle"><input type="hidden" name="val[ordering][<?php echo $this->_aVars['aBlock']['block_id']; ?>]" value="<?php echo $this->_aVars['aBlock']['ordering']; ?>" /></td>
		<td class="t_center" style="width:20px;">
			<a href="#" class="js_drop_down_link" title="<?php echo Phpfox::getPhrase('admincp.manage'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_arrow_down.png','alt' => '')); ?></a>
			<div class="link_menu">
				<ul>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.block.add.', array('id' => $this->_aVars['aBlock']['block_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.edit'); ?></a></li>		
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.block.', array('delete' => $this->_aVars['aBlock']['block_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('admincp.are_you_sure', array('phpfox_squote' => true)); ?>');"><?php echo Phpfox::getPhrase('admincp.delete'); ?></a></li>					
				</ul>
			</div>		
		</td>	
		<td>
<?php if (! empty ( $this->_aVars['aBlock']['title'] )): ?>
<?php echo $this->_aVars['aBlock']['title']; ?>
<?php else: ?>
<?php if ($this->_aVars['aBlock']['type_id'] > 0): ?>
<?php if ($this->_aVars['aBlock']['type_id'] == 1): ?>
<?php echo Phpfox::getPhrase('admincp.php_code'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('admincp.html_code'); ?>
<?php endif; ?>
<?php else: ?>
<?php echo $this->_aVars['aBlock']['module_name']; ?>::<?php echo $this->_aVars['aBlock']['component']; ?>
<?php endif; ?>
<?php endif; ?>
		</td>
		<td class="t_center" style="width:60px;">
			<div class="js_item_is_active"<?php if (! $this->_aVars['aBlock']['is_active']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=admincp.updateBlockActivity&amp;id=<?php echo $this->_aVars['aBlock']['block_id']; ?>&amp;active=0" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('admincp.deactivate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => '')); ?></a>
			</div>
			<div class="js_item_is_not_active"<?php if ($this->_aVars['aBlock']['is_active']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=admincp.updateBlockActivity&amp;id=<?php echo $this->_aVars['aBlock']['block_id']; ?>&amp;active=1" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('admincp.activate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => '')); ?></a>
			</div>		
		</td>		
	</tr>	
<?php endforeach; endif; ?>
	</table>
<?php endforeach; endif; ?>

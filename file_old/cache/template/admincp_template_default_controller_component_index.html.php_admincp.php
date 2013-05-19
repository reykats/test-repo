<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 8, 2013, 8:12 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: index.html.php 1344 2009-12-21 19:50:14Z Raymond_Benc $
 */
 
 

?>
<div class="table_header">
<?php echo Phpfox::getPhrase('admincp.components'); ?>
</div>
<table cellpadding="0" cellspacing="0">
<?php if (count((array)$this->_aVars['aComponents'])):  foreach ((array) $this->_aVars['aComponents'] as $this->_aVars['sModule'] => $this->_aVars['aRows']): ?>
	<tr>
		<td colspan="5" class="table_header2">
<?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['sModule'], 'module'); ?>
		</td>
	</tr>
	<tr>
		<th style="width:20px;"></th>
		<th><?php echo Phpfox::getPhrase('admincp.component'); ?></th>
		<th><?php echo Phpfox::getPhrase('admincp.connection'); ?></th>
		<th class="t_center"><?php echo Phpfox::getPhrase('admincp.controller'); ?></th>
		<th style="width: 60px;"><?php echo Phpfox::getPhrase('admincp.active'); ?></th>		
	</tr>	
<?php if (count((array)$this->_aVars['aRows'])):  foreach ((array) $this->_aVars['aRows'] as $this->_aVars['iKey'] => $this->_aVars['aRow']): ?>
	<tr<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> class="tr"<?php endif; ?>>
		<td class="t_center">
			<a href="#" class="js_drop_down_link" title="<?php echo Phpfox::getPhrase('admincp.manage'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_arrow_down.png','alt' => '')); ?></a>
			<div class="link_menu">
				<ul>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.component.add', array('id' => $this->_aVars['aRow']['component_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.edit'); ?></a></li>		
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.component', array('delete' => $this->_aVars['aRow']['component_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('admincp.are_you_sure', array('phpfox_squote' => true)); ?>');"><?php echo Phpfox::getPhrase('admincp.delete'); ?></a></li>					
				</ul>
			</div>		
		</td>	
		<td><?php echo $this->_aVars['aRow']['component']; ?></td>
		<td><?php if (empty ( $this->_aVars['aRow']['m_connection'] )): ?>N/A<?php else:  echo $this->_aVars['aRow']['m_connection'];  endif; ?></td>
		<td class="t_center">
<?php if ($this->_aVars['aRow']['is_controller']): ?>
<?php echo Phpfox::getPhrase('admincp.yes'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('admincp.no'); ?>
<?php endif; ?>
		</td>
		<td class="t_center">
			<div class="js_item_is_active"<?php if (! $this->_aVars['aRow']['is_active']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=admincp.componentFeedActivity&amp;id=<?php echo $this->_aVars['aRow']['component_id']; ?>&amp;active=0" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('admincp.deactivate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => '')); ?></a>
			</div>
			<div class="js_item_is_not_active"<?php if ($this->_aVars['aRow']['is_active']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=admincp.componentFeedActivity&amp;id=<?php echo $this->_aVars['aRow']['component_id']; ?>&amp;active=1" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('admincp.activate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => '')); ?></a>
			</div>			
		</td>
	</tr>
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
</table>

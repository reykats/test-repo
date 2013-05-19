<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 9, 2013, 7:04 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Theme
 * @version 		$Id: index.html.php 2197 2010-11-22 15:26:08Z Raymond_Benc $
 */
 
 

?>
<div class="table_header">
<?php echo Phpfox::getPhrase('theme.html_templates'); ?>
</div>
<div id="content_editor_holder">
	<div id="content_editor_menu">
		<ul>
<?php if (count((array)$this->_aVars['aTemplates'])):  $this->_aPhpfoxVars['iteration']['type'] = 0;  foreach ((array) $this->_aVars['aTemplates'] as $this->_aVars['sType'] => $this->_aVars['aTemplate']):  $this->_aPhpfoxVars['iteration']['type']++; ?>

<?php if ($this->_aVars['sType'] == 'layout'): ?>
			<li class="active"><a href="#" class="menu_parent js_open_template_list first<?php if (isset ( $this->_aVars['aTemplate']['modified'] )): ?> modified<?php endif; ?>"><?php echo Phpfox::getPhrase('theme.global_templates'); ?></a>
				<ul class="js_list_templates">
<?php if (count((array)$this->_aVars['aTemplate']['files'])):  foreach ((array) $this->_aVars['aTemplate']['files'] as $this->_aVars['sFile']): ?>
					<li><a href="#?type=layout&amp;name=<?php if (is_array ( $this->_aVars['sFile'] )):  echo $this->_aVars['sFile']['0'];  else:  echo $this->_aVars['sFile'];  endif; ?>&amp;theme=<?php echo $this->_aVars['aTheme']['folder']; ?>" class="js_get_template_file<?php if (is_array ( $this->_aVars['sFile'] )): ?> modified<?php endif; ?>"><div style="position:absolute; right:0; display:none;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/small.gif')); ?></div><?php if (is_array ( $this->_aVars['sFile'] )):  echo $this->_aVars['sFile']['0'];  else:  echo $this->_aVars['sFile'];  endif; ?></a></li>
<?php endforeach; endif; ?>
				</ul>
			</li>
<?php else: ?>
			<li><a href="#" class="menu_parent js_open_template_list<?php if (isset ( $this->_aVars['aTemplate']['modified'] )): ?> modified<?php endif; ?>"><?php echo $this->_aVars['sType']; ?></a>
				<ul class="js_list_templates" style="display:none;">
<?php if (count((array)$this->_aVars['aTemplate'])):  foreach ((array) $this->_aVars['aTemplate'] as $this->_aVars['aModules']): ?>
<?php if (isset ( $this->_aVars['aTemplate']['controller'] ) && count ( $this->_aVars['aTemplate']['controller'] )): ?>
					<li><span><?php echo Phpfox::getPhrase('theme.controllers'); ?></span>
						<ul>
<?php if (count((array)$this->_aVars['aTemplate']['controller'])):  foreach ((array) $this->_aVars['aTemplate']['controller'] as $this->_aVars['sController']): ?>
							<li>
								<a href="#?type=controller&amp;name=<?php if (is_array ( $this->_aVars['sController'] )):  echo $this->_aVars['sController']['0'];  else:  echo $this->_aVars['sController'];  endif; ?>&amp;theme=<?php echo $this->_aVars['aTheme']['folder']; ?>&amp;module=<?php echo $this->_aVars['sType']; ?>" class="js_get_template_file<?php if (is_array ( $this->_aVars['sController'] )): ?> modified<?php endif; ?>"><div style="position:absolute; right:0; display:none;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/small.gif')); ?></div><?php if (is_array ( $this->_aVars['sController'] )):  echo $this->_aVars['sController']['0'];  else:  echo $this->_aVars['sController'];  endif; ?>
								</a>
							</li>
<?php endforeach; endif; ?>
<?php unset($this->_aVars['aTemplate']['controller']); ?>
						</ul>
					</li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aTemplate']['block'] ) && count ( $this->_aVars['aTemplate']['block'] )): ?>
					<li><span><?php echo Phpfox::getPhrase('theme.blocks'); ?></span>
						<ul>
<?php if (count((array)$this->_aVars['aTemplate']['block'])):  foreach ((array) $this->_aVars['aTemplate']['block'] as $this->_aVars['sBlock']): ?>
							<li><a href="#?type=block&amp;name=<?php if (is_array ( $this->_aVars['sBlock'] )):  echo $this->_aVars['sBlock']['0'];  else:  echo $this->_aVars['sBlock'];  endif; ?>&amp;theme=<?php echo $this->_aVars['aTheme']['folder']; ?>&amp;module=<?php echo $this->_aVars['sType']; ?>" class="js_get_template_file<?php if (is_array ( $this->_aVars['sBlock'] )): ?> modified<?php endif; ?>"><div style="position:absolute; right:0; display:none;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/small.gif')); ?></div><?php if (is_array ( $this->_aVars['sBlock'] )):  echo $this->_aVars['sBlock']['0'];  else:  echo $this->_aVars['sBlock'];  endif; ?></a></li>
<?php endforeach; endif; ?>
<?php unset($this->_aVars['aTemplate']['block']); ?>
						</ul>
					</li>
<?php endif; ?>
<?php endforeach; endif; ?>
				</ul>
			</li>
<?php endif; ?>
<?php endforeach; endif; ?>
		</ul>
	</div>
	<div id="content_editor_text">
		<div class="content_editor_overlay" id="js_template_content_loader"></div>
		<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('current'); ?>" id="js_template_form">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div id="js_hidden_cache">
				<div><input type="hidden" name="val[type]" value="" id="js_template_type" /></div>
				<div><input type="hidden" name="val[theme]" value="" id="js_template_theme" /></div>
				<div><input type="hidden" name="val[name]" value="" id="js_template_name" /></div>
				<div><input type="hidden" name="val[module]" value="" id="js_template_module" /></div>
			</div>
			<div style="display:none;"><textarea cols="50" rows="15" name="val[text]" id="js_template_content_text" style="width:100%;"></textarea></div>
			<textarea cols="50" rows="15" name="val[editor_text]" id="js_template_content"></textarea>		
			<div>
				<div class="go_left">
					<input type="button" value="Save" class="button" id="js_update_template" />		
					<span id="js_last_modified"><input type="button" value="<?php echo Phpfox::getPhrase('theme.revert'); ?>" class="button" id="js_revert" /></span>		
					<span id="js_delete_custom"><input type="button" value="<?php echo Phpfox::getPhrase('theme.delete'); ?>" class="button" onclick="return $Core.templateEditor.deleteItem();" /></span>
				</div>
				<div class="t_right" style="margin-right:20px;">
					Product:
					<select name="val[product_id]" id="js_template_product_id">
<?php if (count((array)$this->_aVars['aProducts'])):  foreach ((array) $this->_aVars['aProducts'] as $this->_aVars['aProduct']): ?>
						<option value="<?php echo $this->_aVars['aProduct']['product_id']; ?>"><?php echo $this->_aVars['aProduct']['title']; ?></option>
<?php endforeach; endif; ?>
					</select>
					<div>
						<div id="js_last_modified_info"></div>
					</div>
				</div>
				<div class="clear"></div>	
				<div id="js_theme_cache_info" style="display:none;"></div>
			</div>
		
</form>

	</div>
	<div class="clear"></div>
</div>

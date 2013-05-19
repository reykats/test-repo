<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 8, 2013, 8:13 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: form.html.php 2526 2011-04-13 18:15:51Z Raymond_Benc $
 */
 
 

?>
<div class="table">
	<div class="table_left">
<?php if ($this->_aVars['bModuleFormRequired']):  if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  endif;  echo $this->_aVars['sModuleFormTitle']; ?>:
	</div>
	<div class="table_right">			
		<select name="val[<?php echo $this->_aVars['sModuleFormId']; ?>]" <?php if ($this->_aVars['bUseClass']): ?>class<?php else: ?>id<?php endif; ?>="<?php echo $this->_aVars['sModuleFormId']; ?>">
		<option value=""><?php echo $this->_aVars['sModuleFormValue']; ?></option>
<?php if (count((array)$this->_aVars['aModules'])):  foreach ((array) $this->_aVars['aModules'] as $this->_aVars['sModule'] => $this->_aVars['iModuleId']): ?>
			<option value="<?php echo $this->_aVars['sModule']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric(''.$this->_aVars['sModuleFormId'].'') && in_array(''.$this->_aVars['sModuleFormId'].'', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams[''.$this->_aVars['sModuleFormId'].''])
								&& $aParams[''.$this->_aVars['sModuleFormId'].''] == $this->_aVars['sModule'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms'][''.$this->_aVars['sModuleFormId'].''])
									&& !isset($aParams[''.$this->_aVars['sModuleFormId'].''])
									&& $this->_aVars['aForms'][''.$this->_aVars['sModuleFormId'].''] == $this->_aVars['sModule'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['sModule'], 'module'); ?></option>
<?php endforeach; endif; ?>
		</select>	
	</div>
</div>

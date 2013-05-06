<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: add.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Controller_Admincp_Add extends Phpfox_Component
{
	public function process()
	{
		$bIsEdit = false;
		if ($iEditId = $this->request()->getInt('id'))
		{
			if ($aCategory = Phpfox::getService('recipe.category')->getForEdit($iEditId))
			{
				$bIsEdit = true;
				
				$this->template()->setHeader('<script type="text/javascript">$(function(){$(\'#js_mp_category_item_' . $aCategory['parent_id'] . '\').attr(\'selected\', true);});</script>')->assign('aForms', $aCategory);
			}
		}		
		
		if ($aVals = $this->request()->getArray('val'))
		{
			if ($bIsEdit)
			{
				if (Phpfox::getService('recipe.category.process')->update($aCategory['category_id'], $aVals))
				{
					$this->url()->send('admincp.recipe.add', array('id' => $aCategory['category_id']), Phpfox::getPhrase('recipe.category_successfully_updated'));
				}
			}
			else 
			{
				if (Phpfox::getService('recipe.category.process')->add($aVals))
				{
					$this->url()->send('admincp.recipe.add', null, Phpfox::getPhrase('recipe.category_successfully_added'));
				}
			}
		}
		
		$this->template()->setTitle(($bIsEdit ? Phpfox::getPhrase('recipe.edit_a_category') : Phpfox::getPhrase('recipe.create_a_new_category')))
			->setBreadcrumb(($bIsEdit ? Phpfox::getPhrase('recipe.edit_a_category') : Phpfox::getPhrase('recipe.create_a_new_category')))
			->assign(array(
					'sOptions' => Phpfox::getService('recipe.category')->display('option')->get(),
					'bIsEdit' => $bIsEdit
				)
			);	
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_controller_admincp_add_clean')) ? eval($sPlugin) : false);
	}
}

?>
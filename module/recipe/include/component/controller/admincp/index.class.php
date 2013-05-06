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
 * @version 		$Id: index.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Controller_Admincp_Index extends Phpfox_Component
{
	public function process()
	{	
		if ($aOrder = $this->request()->getArray('order'))
		{
			if (Phpfox::getService('recipe.category.process')->updateOrder($aOrder))
			{
				$this->url()->send('admincp.recipe', null, Phpfox::getPhrase('recipe.category_order_successfully_updated'));
			}
		}		
		
		if ($iDelete = $this->request()->getInt('delete'))
		{
			if (Phpfox::getService('recipe.category.process')->delete($iDelete))
			{
				$this->url()->send('admincp.recipe', null, Phpfox::getPhrase('recipe.category_successfully_deleted'));
			}
		}
	
		$this->template()->setTitle(Phpfox::getPhrase('recipe.manage_categories'))
			->setBreadcrumb(Phpfox::getPhrase('recipe.manage_categories'))
			->setPhrase(array('recipe.are_you_sure_this_will_delete_all_items_that_belong_to_this_category'))
			->setHeader(array(
					'jquery/ui.js' => 'static_script',
					'admin.js' => 'module_recipe',
					'<script type="text/javascript">$Core.recipe.url(\'' . $this->url()->makeUrl('admincp.recipe') . '\');</script>'
				)
			)
			->assign(array(
					'sCategories' => Phpfox::getService('recipe.category')->display('admincp')->get()
				)
			);		
			
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_controller_admincp_index_clean')) ? eval($sPlugin) : false);
	}
}

?>
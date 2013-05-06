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
 * @version 		$Id: ajax.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Ajax_Ajax extends Phpfox_Ajax
{
	public function deleteRecipeImage()
	{
		$iRecipe = $this->get('iRecipe');
		if (Phpfox::getService('recipe.process')->deleteImage($iRecipe, Phpfox::getUserId()))
		{
			$this->call('$("#js_submit_upload_image").show();');
			$this->call('$("#js_need_upload_image").val("1");');
			$this->call('$("#js_recipe_current_image").remove();');
		}
		else
		{
			$this->call('$("#js_recipe_current_image").after("' . Phpfox::getPhrase('recipe.an_error_occured_and_your_image_could_not_be_deleted') . '");');
		}
	}
	public function delete()
	{
		$iRecipeId = (int)$this->get('id');
		$bDeleted = Phpfox::getService('recipe.process')->delete($iRecipeId);

		if ($bDeleted == true)
		{
			Phpfox::addMessage(Phpfox::getPhrase('recipe.recipe_successfully_deleted'));
				
			$this->call('window.location.href = \'' . Phpfox::getLib('url')->makeUrl('recipe') . '\';');
			
			return true;			
		}
		else
		{
			$this->alert(Phpfox::getPhrase('recipe.your_membership_does_not_allow_you_to_delete_this_item'));
		}
		return false;
	}
	
	public function feature()
	{
		if (Phpfox::getService('recipe.process')->feature($this->get('id'), $this->get('type')))
		{
			
		}
	}
	
	public function getNew()
	{
		Phpfox::getBlock('recipe.new');
		$this->html('#' . $this->get('id'), $this->getContent(false));
		$this->call('$(\'#' . $this->get('id') . '\').parents(\'.block:first\').find(\'.bottom li a\').attr(\'href\', \'' . Phpfox::getLib('url')->makeUrl('recipe') . '\');');
	}
	
	public function approve()
	{
		Phpfox::getUserParam('recipe.can_approve_recipes', true);
		Phpfox::getService('recipe.process')->approve($this->get('id'));			
	}
}

?>
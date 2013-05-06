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
 * @version 		$Id: rate.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Block_Rate extends Phpfox_Component
{
	public function process()
	{	
		if (!$aRatingCallback = $this->getParam('aRatingCallback'))
		{
			return Phpfox_Error::display(Phpfox::getPhrase('rate.unable_to_load_rating_callback'));
		}
		
		$aStars = array();
		foreach ($aRatingCallback['stars'] as $iKey => $mStar)
		{
			if (is_numeric($mStar))
			{
				$aStars[$mStar] = $mStar;
			}
			else 
			{
				$aStars[$iKey] = $mStar;
			}
		}		
		
		$aRatingCallback['stars'] = $aStars;
		
		$this->template()->assign(array(
				'aRatingCallback' => $aRatingCallback
			)
		);	
		return 'block';
	}
	
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_block_rate_clean')) ? eval($sPlugin) : false);
	}
}

?>
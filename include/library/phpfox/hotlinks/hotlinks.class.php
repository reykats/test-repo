<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * Hotlinks
 * Class is used to perform link replace
 * 
 * @copyright		Everydayoils
 * @author			Rey Ann Ebesa
 * @package 		Phpfox
 */
class Phpfox_Hotlinks
{
	/**
	 * Class constructor.
	 *
	 */
	public function __construct()
	{		
	}
	
	public function replaceKeywordsToLinks($text = NULL) {
		$hotLinks = Phpfox::getLib('database')->select('h.*')
						 ->from(Phpfox::getT('hotlinks'), 'h')
						 ->where('status = ' . 1)
						 ->execute('getRows');
		
		$patterns = array();
		$replacements = array();
		
		foreach($hotLinks as $key => $value) {
			$patterns[] = '/'.$value['keyword'].'/';
			$replacements[] = "<a href='" . $value['url'] . "' target='_blank'> " .  $value['keyword']  . "</a>";
		}
		
		return preg_replace($patterns, $replacements, $text);
	}
}

?>
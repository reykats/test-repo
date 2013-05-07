<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Recipeblocks_Component_Block_Tagclouds extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
	
	    $aTags = $this->getKeywords();
		if(!$aTags) {
			$tag_clouds = '';
		} else {
			$prepareTags = $this->prepareKeywords($aTags);
			$tag_clouds = $this->prepareHTMLTagClouds($prepareTags);
		}
		
		$this->template()->assign(array(
				'tag_clouds' => $tag_clouds
			)
		);
		return 'block';
	}
	
	public function prepareHTMLTagClouds($tags) {
		$max_count = array_sum($tags);
		// Incresing this number will make the words bigger; 
		// Decreasing will do reverse
		$factor = 0.3;
		$starting_font_size = 11;
		$html = '';
		foreach($tags as $tag => $rating) {
			$x = round(($rating * 100) / $max_count) * $factor;
			$font_size = $starting_font_size + $x.'px';
			$url = $this->url()->makeUrl('recipe/tag');
			$html .= "<span style='font-size: ".$font_size."; color: #676F9D;'>
							<a href='". $url . Phpfox::getLib('parse.input')->cleanTitle($tag) ."'>".$tag."</a>
						</span>".$tag_separator;
		}
		return $html;
	}

    public function getKeywords() {
        return Phpfox::getLib('database') ->select('u.keywords')
              ->from('phpfox_recipe_text u')
			  ->where('keywords <> ""')
			  ->execute('getSlaveRows');
    }
	
	public function prepareKeywords($aTags) {
		$arrTags = array();
		foreach($aTags as $tag):
			$tags = explode(",", $tag['keywords']);
			foreach($tags as $xtag):
				$ntag = trim($xtag);
				$arrTags[$ntag]  = $arrTags[$ntag] + 1;
			endforeach;
		endforeach;
		$tag_clouds = $this->randomizeTagClouds($arrTags);
		return $tag_clouds;
	}
	
	public function randomizeTagClouds($arrTags) {
		$tag_clouds = $this->randomizeArray($arrTags);
		return $tag_clouds;
	}
	
	public function randomizeArray($array) {
		$rand_items = array_rand($array, count($array));
		$new_array = array();
		foreach($rand_items as $value) {
			$new_array[$value] = $array[$value];
		}
		return $new_array;
	}
}

?>
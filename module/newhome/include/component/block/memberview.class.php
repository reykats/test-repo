<?php

defined('PHPFOX') or exit('NO DICE!');

class Newhome_Component_Block_Memberview extends Phpfox_Component
{
	
	public function process()
	{

        $aRacipes = $this->getRandomRecipes();
		$aRandomPages = $this->getRandomPages();
		

		$this->template()->assign(array(
				'aRacipes' => $aRacipes,
				'aPages' => $aRandomPages,
			)
		);
		return 'block';
	}

    public function getRandomRecipes(){

        return Phpfox::getLib('database') ->select('u.*')
              ->from('phpfox_recipe u')
		->order('rand()')
			  ->limit(12)
			  ->execute('getSlaveRows');
    }
	
	public function getRandomPages()
	{
	
	$pagesUrl = Phpfox::getLib('url')->makeUrl('pages');
	$aLikedPages = Phpfox::getLib('database')->select("p.*, '".$pagesUrl."' as pagesUrl")
		                ->from(Phpfox::getT('pages'), 'p')
						#->join(Phpfox::getT('like'), 'l', 'p.page_id = l.item_id')
						#->where('l.type_id = \'pages\' AND l.user_id ='.Phpfox::getUserId())
						->limit(12)
						->order('RAND()')
						->execute('getSlaveRows'); 
						
	return $aLikedPages;
	}

	

}

?>
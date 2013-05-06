<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Gettingstarted_component_block_categories extends Phpfox_Component{
	public function process()
	{
		$articlecategories_block = Phpfox::getService("gettingstarted.articlecategory")->getArticleCategory();
		foreach ($articlecategories_block as $iKey => $aCategory)
		{
			$articlecategories_block[$iKey]['url'] =  $this->url()->permalink(array('gettingstarted.categories', 'view' => $this->request()->get('view')), $aCategory['article_category_id'], $aCategory['article_category_name']);//($bIsProfile ? $this->url()->permalink(array($aUser['user_name'] . '.blog.category', 'view' => $this->request()->get('view')), $aCategory['category_id'], $aCategory['name']) : $this->url()->permalink(array('blog.category', 'view' => $this->request()->get('view')), $aCategory['category_id'], $aCategory['name']));
		}
		$iCategoryView = -2;
		if($this->request()->get('req3'))
		{
			$iCategoryView = $this->request()->get('req3');
		}
		else
		{
			$iCategoryView = -2;
		}
		$this->template()->assign(array(
                   'sHeader' => Phpfox::getPhrase('gettingstarted.categories'),
                   'articlecategories_block' => $articlecategories_block,
                   'iCategoryView' => $iCategoryView,
                   // 'article_category_id' => $article_category_id,
		));
		return 'block';
	}
}
?>


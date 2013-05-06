<?php
/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_Gettingstarted
 * @version          2.01
 */

defined('PHPFOX') or exit('NO DICE!');

class Gettingstarted_service_articlecategory extends Phpfox_Service{

	public function addArticleCategory($aVals)
	{
		if($this->isExistName($aVals)>0)
		return 0;
		$oFilter = phpfox::getLib('parse.input');
		$aInsert = array();
		$aInsert['article_category_name'] = $oFilter->clean($aVals['title']);
		$aInsert['time_stamp'] = PHPFOX_TIME;
		$this->database()->insert(phpfox::getT('gettingstarted_article_category'),$aInsert);
		return 1;
	}

	public function isExistName($aVals)
	{
		$iCount=$this->database()->select('count(*)')
		->from(phpfox::getT('gettingstarted_article_category'))
		->where('article_category_name="'.$aVals['title'].'"')
		->execute('getSlaveField');
		return $iCount;
	}

	public function get($iPage,$iLimit,$iCnt)
	{
		$aRows = $this->database()->select('category.*')
		->from(phpfox::getT('gettingstarted_article_category'),'category')
		->limit($iPage,$iLimit,$iCnt)
		->execute('getSlaveRows');

		$iLastPage = (int)(($iCnt)/$iLimit);
		$mod = $iCnt%$iLimit;
		if($mod != 0)
		{
			$iLastPage = (int)(($iCnt)/$iLimit) + 1;
		}

		if($iPage == $iLastPage)
		{
			$aRow = array();
			$aRow[count($aRows)]['article_category_id'] = -1;
			$aRow[count($aRows)]['article_category_name'] = Phpfox::getPhrase('gettingstarted.uncategorized');
			$aRows = array_merge($aRows, $aRow);
		}
		return $aRows;
	}

	public function getCategoriesForEdit($iPage,$iLimit,$iCnt)
	{
		$aRows = $this->database()->select('category.*')
		->from(phpfox::getT('gettingstarted_article_category'),'category')
		->limit($iPage,$iLimit,$iCnt)
		->execute('getSlaveRows');
		return $aRows;

	}
	public function getCount()
	{
		$iCount=(int)$this->database()->select('count(*)')
		->from(phpfox::getT('gettingstarted_article_category'),'category')
		->execute('getSlaveField');
		return $iCount;
	}

	public function getArticleCategoryById($Id)
	{
		$aRow = $this->database()->select('*')
		->from(phpfox::getT('gettingstarted_article_category'),'category')
		->where('category.article_category_id='.$Id)
		->execute('getSlaveRow');
		if($Id == -1)
		{
			$aRow['article_category_name'] = Phpfox::getPhrase('gettingstarted.uncategorized');

		}
		return $aRow;
	}

	public function getArticleCategory()
	{
		$aRows = $this->database()->select('category.*')
		->from(phpfox::getT('gettingstarted_article_category'),'category')
		->execute('getSlaveRows');
		$aRow = array();
		$aRow[count($aRows)]['article_category_id'] = -1;
		$aRow[count($aRows)]['article_category_name'] = Phpfox::getPhrase('gettingstarted.uncategorized');
		$aRows = array_merge($aRows, $aRow);
		return $aRows;
	}

	public function UpdateArticleCategoryById($aVals)
	{
		$oFilter = phpfox::getLib('parse.input');
		$aUpdates = array();
		$aUpdates['article_category_name'] = $oFilter->clean($aVals['title']);
		$this->database()->update(phpfox::getT('gettingstarted_article_category'),$aUpdates,'article_category_id='.$aVals['article_category_id']);
	}

	public function deleteArticleCategoryById($Id)
	{
		$this->database()->delete(phpfox::getT('gettingstarted_article_category'),'article_category_id='.$Id);
	}

	public function deleteArticleById($Id)
	{
		$this->database()->delete(phpfox::getT('gettingstarted_article'), 'article_id='.$Id);
	}


	public function deleteMultiple($aIds)
	{
		foreach ($aIds as $iId)
		{
			$this->updateCategoryArticle($iId);
			$this->deleteArticleCategoryById($iId);
		}
		return true;
	}

	public function updateCategoryArticle($iCategoryId)
	{
		$aUpdate['article_category_id'] = -1;
		Phpfox::getLib('database')->update(phpfox::getT('gettingstarted_article'), $aUpdate, 'article_category_id = '.(int)$iCategoryId);
	}

	public function deleteMultipleArticle($aIds)
	{
		foreach ($aIds as $iId)
		{
			$this->deleteArticleById($iId);
		}
		return true;
	}

	public function deleteMultipleTodoList($aIds)
	{
		foreach ($aIds as $iId)
		{
			Phpfox::getService('gettingstarted.todolist')->updateTodoListofUser($iId);
			$this->database()->delete(phpfox::getT('gettingstarted_todolist'),'todolist_id='.$iId);
		}
		return true;
	}
	public function addarticle($aVals)
	{

		$aInsert = array();
		$oFilter = phpfox::getLib('parse.input');
		$aInsert['title']=$oFilter->clean($aVals['title']);
		$aInsert['description_parsed']=$oFilter->prepare($aVals['description']);
		$aInsert['description']=$oFilter->clean($aVals['description']);
		$aInsert['user_id'] = Phpfox::getUserId();
		$aInsert['time_stamp'] = PHPFOX_TIME;
		$aInsert['article_category_id']=$aVals['article_category_id'];
		$this->database()->insert(phpfox::getT('gettingstarted_article'),$aInsert);

	}

	public function addtodolist($aVals)
	{

		$aInsert=array();
		$oFilter=phpfox::getLib('parse.input');
		$aInsert['title']=$oFilter->clean($aVals['title']);
		$aInsert['description_parsed']=$oFilter->prepare($aVals['description']);
		$aInsert['description']=$oFilter->clean($aVals['description']);
		$aInsert['time_stamp']=PHPFOX_TIME;
		$this->database()->insert(phpfox::getT('gettingstarted_todolist'),$aInsert);

	}

	public function getArticle($title_search, $category_search, $sSortBy, $iPage, $iLimit, $iCnt)
	{

		$aRows = $this->database()->select('article.*, category.article_category_name')
				->from(phpfox::getT('gettingstarted_article'),'article')
				->leftjoin(phpfox::getT('gettingstarted_article_category'),'category','category.article_category_id=article.article_category_id')
				->where("article.title like '%".$title_search."%' and (article.article_category_id=".$category_search." or '".$category_search."'='0')")
				->order('article.article_category_id')
				->limit($iPage,$iLimit,$iCnt)
				->execute('getSlaveRows');
		return $aRows;

	}

	public function getExtra(&$aArticles)
	{
		if(isset($aArticles))
		{
			if(count($aArticles) > 0)
			{
				foreach($aArticles as $iKey => $value)
				{
					if($aArticles[$iKey]['article_category_id'] == -1)
					{
						$aArticles[$iKey]['article_category_name'] = Phpfox::getPhrase('gettingstarted.uncategorized');
					}
					$post_time = Phpfox::getTime(Phpfox::getParam('gettingstarted.display_time_stamp'), $value['time_stamp']);
					$aArticles[$iKey]['info'] = Phpfox::getPhrase('gettingstarted.posted_on_post_time', array('post_time'=>$post_time));
				}
			}
		}
	}

	public function getCountArticle($title_search,$category_search)
	{
		$iCount=(int)$this->database()->select('count(*)')
		->from(phpfox::getT('gettingstarted_article'),'article')
		->leftjoin(phpfox::getT('gettingstarted_article_category'),'category','category.article_category_id=article.article_category_id')
		->where("article.title like '%".$title_search."%' and (article.article_category_id=".$category_search." or '".$category_search."'='0')")
		->execute('getSlaveField');
		return $iCount;
	}

	public function getArticleLastest($iLimit)
	{
		$aRows=$this->database()->select('*')
		->from(phpfox::getT('gettingstarted_article'),'article')
		->order('article.time_stamp desc')
		->limit($iLimit)
		->execute('getSlaveRows');
		return $aRows;
	}

	public function getArticlePaginationId($iId,$iPage,$iLimit,$iCnt)
	{
		$aRows=$this->database()->select('*')
		->from(phpfox::getT('gettingstarted_article'),'article')
		->where('article.article_category_id='.$iId)
		->order('article.time_stamp desc')
		->limit($iPage,$iLimit,$iCnt)
		->execute('getSlaveRows');
		return $aRows;
	}

	public function getCountArticlePaginationId($iId)
	{
		$iCount=(int)$this->database()->select('count(*)')
		->from(phpfox::getT('gettingstarted_article'),'article')
		->where('article.article_category_id='.$iId)
		->execute('getSlaveField');
		return $iCount;
	}

	public function getArticleById($iId)
	{
		if (Phpfox::isModule('friend'))
		{
			$this->database()->select('f.friend_id AS is_friend, ')->leftJoin(Phpfox::getT('friend'), 'f', "f.user_id = article.user_id AND f.friend_user_id = " . Phpfox::getUserId());
		}
		if (Phpfox::isModule('like'))
		{
			$this->database()->select('l.like_id AS is_liked, ')->leftJoin(Phpfox::getT('like'), 'l', 'l.type_id = \'gettingstarted\' AND l.item_id = article.article_id AND l.user_id = ' . Phpfox::getUserId());
		}

		$aRow = $this->database()->select('article.*, category.article_category_name')
		->from(phpfox::getT('gettingstarted_article'),'article')
		->leftjoin(phpfox::getT('gettingstarted_article_category'),'category','category.article_category_id=article.article_category_id')
		->where('article.article_id='.$iId)
		->execute('getSlaveRow');
		return $aRow;
	}

	public function getArticleByCategoryId($iId,$iLimit)
	{
		$aRows=$this->database()->select('*')
		->from(phpfox::getT('gettingstarted_article'),'article')
		->where('article.article_category_id='.$iId)
		->order('article.time_stamp desc')
		->limit($iLimit)
		->execute('getSlaveRows');
		return $aRows;
	}

	public function getdsArticleByCategoryId($iId)
	{
		$aRows=$this->database()->select('*')
		->from(phpfox::getT('gettingstarted_article'),'article')
		->where('article.article_category_id='.$iId)
		->order('article.time_stamp desc')
		->execute('getSlaveRows');
		return $aRows;
	}

	public function updateArticle($aVals)
	{
		$aUpdates=array();
		$aUpdates['title']=$aVals['title'];
		$aUpdates['description']=$aVals['description'];
		$aUpdates['description_parsed']=$aVals['description_parsed'];
		$aUpdates['article_category_id']=$aVals['article_category_id'];
		$this->database()->update(phpfox::getT('gettingstarted_article'),$aUpdates,'article_id='.$aVals['article_id']);
	}

	public function isExistRating($user_id,$item_id)
	{
		$iCount=(int)$this->database()->select('count(*)')
		->from(phpfox::getT('gettingstarted_rating'))
		->where('user_id='.$user_id.' and item_id='.$item_id)
		->execute('getSlaveField');
		return $iCount;
	}
}
?>

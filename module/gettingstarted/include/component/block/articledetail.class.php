<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gettingstarted_component_block_articledetail extends Phpfox_Component{
	public function process()
	{
		$article_id=$this->request()->get('article');
		$dsarticle = Phpfox::getService('gettingstarted.articlecategory')->getArticleById($article_id);
		$time_stamp = Phpfox::getTime(Phpfox::getParam('gettingstarted.display_time_stamp'), $dsarticle ['time_stamp'] );
		if($dsarticle['article_category_id'] == -1)
		{
			$dsarticle['article_category_name'] = Phpfox::getPhrase('gettingstarted.uncategorized');
		}
                
                $dsarticle['url'] = $this->url()->permalink(array('gettingstarted.categories', 'view' => $this->request()->get('view')), $dsarticle['article_category_id'], $dsarticle['article_category_name']);
                //$date = date($dsarticle);
		$username = Phpfox::getLib('database')->select('u.user_name')
											->from(phpfox::getT('user'), 'u')
											->where('u.user_id = '.$dsarticle['user_id'])
											->execute('getSlaveField');
		$path_user = phpfox::getLib('url')->makeUrl($username);
		$total_comments = $dsarticle['total_comment'];
		$this->template()->assign(array(
      //     'sHeader' => 'Article Details',
           'dsarticle' => $dsarticle,
			'time_stamp'=>$time_stamp,
			'path_user'=>$path_user,
			'username'=>$username,
			'total_comments'=>$total_comments
		));
		return 'block';
	}
}
?>
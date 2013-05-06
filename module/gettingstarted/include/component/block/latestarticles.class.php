<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gettingstarted_component_block_latestarticles extends Phpfox_Component{
    public function process()
    {
        $iLimit = 10;
        $article_block=Phpfox::getService("gettingstarted.articlecategory")->getArticleLastest($iLimit);
        if(count($article_block) < 1)
        {
        	return false;
        }
        $this->template()->assign(array(
           'sHeader' => Phpfox::getPhrase('gettingstarted.latest_articles'),
           'article_block' => $article_block,
        ));

        return 'block';
        
    }
}
?>

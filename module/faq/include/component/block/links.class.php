<?php

defined('PHPFOX') or exit('');

class Faq_Component_Block_Links extends Phpfox_Component{

	public function process(){

        if(!Phpfox::getParam('faq.show_links_on_pages')){
          return false;
        }

        $currentUrl = $this->url()->getUrl();
        $currentUrl = explode('/', $currentUrl);
        $currentUrl = $currentUrl[0];
        $sFinalFaqHtml = '';
        $oFaq = Phpfox::getService('faq');
        $aQuestionsAnswers = $oFaq->getQuestionsByAddonName($currentUrl);
        if(count($aQuestionsAnswers)>0){

          $sFinalFaqHtml .= '<h3>'.Phpfox::getPhrase($aQuestionsAnswers[0]['cat_name']).'</h3>';
          $sFinalFaqHtml .= '<ul class="action">';
          foreach($aQuestionsAnswers as $k1=>$v1){
              $sFinalFaqHtml .= '<li>';
              $sFinalFaqHtml .= '<a href="#?call=faq.getOne&height=400&width=400&category='.$currentUrl.'&faq='.$v1['friendly_url'].'" class="inlinePopup" title="FAQ">';
              $sFinalFaqHtml .= substr($v1['question_phrase'], 0, 4)=='faq.'? Phpfox::getPhrase($v1['question_phrase']):$v1['question'];
              $sFinalFaqHtml .= '</a>';
              $sFinalFaqHtml .= '</li>';
          }
          $sFinalFaqHtml .= '<li><a href="'.Phpfox::getLib('url')->makeUrl('faq').'">'.Phpfox::getPhrase('faq.see_full_faq').'</a></li>';
          $sFinalFaqHtml .= '</ul>';

        } else return false;

        $sFinalFaqHtml = str_replace('{sSitename}', Phpfox::getParam('core.site_title'), $sFinalFaqHtml);
		$this->template()->assign('sFinalFaqHtml', $sFinalFaqHtml);

		return 'block';
	}
}
?>
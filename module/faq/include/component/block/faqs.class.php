<?php

defined('PHPFOX') or exit('');

class Faq_Component_Block_Faqs extends Phpfox_Component{

	public function process(){

        $oFaq = Phpfox::getService('faq');
        $aCategories = $oFaq->getCategories();
        $sQuestionsAnswers = array();
        $sStartFaq = '<dl class="faq">';
        $sEndFaq = '</dl>';
        $sFinalFaqHtml = '';
        foreach($aCategories as $k=>$v){
            $aQuestionsAnswers = $oFaq->getQuestionsAnswers($v['faq_cat_id']);
            $sFinalFaqHtml .= '<h3 id="faq_'.$v['cat_addon_name'].'">'.Phpfox::getPhrase($v['cat_name']).' <span class="go-to-top"><a href="#js_controller_faq_index">&uarr;</a></span></h3>';
            $sFinalFaqHtml .= '<ul class="faq_submenu faq_'.$v['cat_addon_name'].'">';
            foreach($aQuestionsAnswers as $k1=>$v1){
                $sFinalFaqHtml .= '<li>';
                $sFinalFaqHtml .= '<a href="#faq_'.$v['cat_addon_name'].'_'.$v1['friendly_url'].'" rel="faq_'.$v['cat_addon_name'].'_subaction">';
                $sFinalFaqHtml .= substr($v1['question_phrase'], 0, 4)=='faq.'? Phpfox::getPhrase($v1['question_phrase']):$v1['question'];
                $sFinalFaqHtml .= '</a>';
                $sFinalFaqHtml .= '</li>';
            }
            $sFinalFaqHtml .= '</ul>';

            $sFinalFaqHtml .= $sStartFaq;
            foreach($aQuestionsAnswers as $k2=>$v2){

                $sFinalFaqHtml .= '<dt id="faq_'.$v['cat_addon_name'].'_'.$v2['friendly_url'].'">';
                $sFinalFaqHtml .= substr($v2['question_phrase'], 0, 4)=='faq.'? Phpfox::getPhrase($v2['question_phrase']):$v2['question'];
                $sFinalFaqHtml .= ' <span class="go-to-top"><a href="#js_controller_faq_index">&uarr;</a></span>';
                $sFinalFaqHtml .= '</dt>';

                $sFinalFaqHtml .= '<dd class="faq_'.$v['cat_addon_name'].'_'.$v2['friendly_url'].'">';
                $sFinalFaqHtml .= substr($v2['answer_phrase'], 0, 4)=='faq.'? Phpfox::getPhrase($v2['answer_phrase']):$v2['answer'];
                $sFinalFaqHtml .= '<div class="permalink"><a href="'.Phpfox::getLib('url')->makeUrl('faq').''.$v['cat_addon_name'].'/faq_'.$v2['friendly_url'].'">Permalink</a></div>';
                $sFinalFaqHtml .= '</dd>';

            }
            $sFinalFaqHtml .= $sEndFaq;
        }
        $sFinalFaqHtml = str_replace('{sSitename}', Phpfox::getParam('core.site_title'), $sFinalFaqHtml);
    	$this->template()->assign(array('sFinalFaqHtml' => $sFinalFaqHtml));

		return 'block';
	}
}
?>
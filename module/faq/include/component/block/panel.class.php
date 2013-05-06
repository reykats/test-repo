<?php

class Faq_Component_Block_Panel extends Phpfox_Component
{
    public function process()
    {
        $this->template()->assign(array('sHeader' => Phpfox::getPhrase('faq.categories_title')));

        $oFaq = Phpfox::getService('faq');
        $aCategories = $oFaq->getCategories();
        $sQuestionsAnswers = array();
        $sStartFaq = '<ul class="action">';
        $sEndFaq = '</ul>';
        $sFinalFaqHtml = $sStartFaq;

        foreach($aCategories as $k=>$v){

            $aQuestionsAnswers = $oFaq->getQuestionsAnswers($v['faq_cat_id']);
            $sFinalFaqHtml .= '<li>';
            $sFinalFaqHtml .= '<a href="#faq_'.$v['cat_addon_name'].'" rel="faq_'.$v['cat_addon_name'].'_subaction">';
            $sFinalFaqHtml .= '<img src="'.Phpfox::getLib('url')->makeUrl('').'/module/faq/static/image/'.$v['cat_addon_name'].'.png"/>&nbsp;';
            $sFinalFaqHtml .= Phpfox::getPhrase($v['cat_name']);
            $sFinalFaqHtml .= '</a>';

            $sFinalFaqHtml .= '<ul class="faq_subaction faq_'.$v['cat_addon_name'].'_subaction">';
            foreach($aQuestionsAnswers as $k1=>$v1){
                $sFinalFaqHtml .= '<li>';
                $sFinalFaqHtml .= '<a href="#faq_'.$v['cat_addon_name'].'_'.$v1['friendly_url'].'" rel="faq_'.$v['cat_addon_name'].'_subaction">';
                $sFinalFaqHtml .= substr($v1['question_phrase'], 0, 4)=='faq.'? Phpfox::getPhrase($v1['question_phrase']):$v1['question'];
                $sFinalFaqHtml .= '</a>';
                $sFinalFaqHtml .= '</li>';
            }
            $sFinalFaqHtml .= '</ul>';

        }

        $sFinalFaqHtml .= $sEndFaq;

        $sFinalFaqHtml = str_replace('{sSitename}', Phpfox::getParam('core.site_title'), $sFinalFaqHtml);

    	$this->template()->assign('sFinalFaqHtml', $sFinalFaqHtml);

        return 'block';
    }
}

?>
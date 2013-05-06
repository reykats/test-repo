<?php

defined('PHPFOX') or exit('');

class Faq_Component_Controller_View extends Phpfox_Component{

	public function process(){

        if(!Phpfox::getUserParam('faq.allow_access')){

            return $this->url()->send('subscribe');

        }

	   $this->template()->setHeader(array(
    	   'faq.css' => 'module_faq'
        ));

        $this->template()->setTitle(Phpfox::getPhrase('faq.frequently_asked_questions'))
        ->setBreadcrumb(Phpfox::getPhrase('faq.frequently_asked_questions'));

        $requested = $this->request()->get('req2');
        $requested2 = $this->request()->get('faq');

        $aQuestionAnswer = Phpfox::getService('faq')->getOneQAByUrl($requested,$requested2);

        $sFinalFaqHtml = '';
        if(count($aQuestionAnswer)>0){
        foreach($aQuestionAnswer as $k=>$v){

            $sFinalFaqHtml .= '<dt>';
            $sFinalFaqHtml .= substr($v['question_phrase'], 0, 3)=='faq.'? Phpfox::getPhrase($v['question_phrase']):$v['question'];
            $sFinalFaqHtml .= '</dt>';

            $sFinalFaqHtml .= '<dd>';
            $sFinalFaqHtml .= substr($v['answer_phrase'], 0, 3)=='faq.'? Phpfox::getPhrase($v['answer_phrase']):$v['answer'];
            $sFinalFaqHtml .= '</dd>';

       }
       $sFinalFaqHtml = str_replace('{sSitename}', Phpfox::getParam('core.site_title'), $sFinalFaqHtml);
        }

	   $this->template()->assign('sQuestionAnswer', $sFinalFaqHtml);

	}
}
?>
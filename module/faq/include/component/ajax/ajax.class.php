<?php

defined('PHPFOX') or exit('NO DICE!');

/**
Damir Grgic Favorites Menu Ajax Class
 */
class Faq_Component_Ajax_Ajax extends Phpfox_Ajax{

    public function getOne(){

  	  Phpfox::isUser(true);

        $requested = $this->get('category');
        $requested2 = $this->get('faq');

        $aQuestionAnswer = Phpfox::getService('faq')->getOneQAByUrl($requested,$requested2);

        $sFinalFaqHtml = '';
        foreach($aQuestionAnswer as $k=>$v){

            $sFinalFaqHtml .= '<dt style="font-size:13px; font-weight:bold; margin-bottom:5px">';
            $sFinalFaqHtml .= substr($v['question_phrase'], 0, 3)=='faq.'? Phpfox::getPhrase($v['question_phrase']):$v['question'];
            $sFinalFaqHtml .= '</dt>';

            $sFinalFaqHtml .= '<dd>';
            $sFinalFaqHtml .= substr($v['answer_phrase'], 0, 3)=='faq.'? Phpfox::getPhrase($v['answer_phrase']):$v['answer'];
            $sFinalFaqHtml .= '</dd>';

       }
       $sFinalFaqHtml = str_replace('{sSitename}', Phpfox::getParam('core.site_title'), $sFinalFaqHtml);

       echo $sFinalFaqHtml;

    }

}

?>
<?php

defined('PHPFOX') or exit('');

class Faq_Component_Controller_Index extends Phpfox_Component{

	public function process(){

        if(!Phpfox::getUserParam('faq.allow_access')){

            return $this->url()->send('subscribe');

        }

        $requested = $this->request()->get('faq');

		// view item route
		if (!empty($requested))
		{
			return Phpfox::getLib('module')->setController('faq.view');
		}

	   $this->template()->setHeader(array(
    	   'faq.css' => 'module_faq',
    	   'jquery.scrollTo-1.4.2-min.js' => 'module_faq',
    	   'jquery.localscroll-1.2.7-min.js' => 'module_faq',
    	   'jquery.highlightFade.js' => 'module_faq',
           'faq.js' => 'module_faq'
        ));

        $this->template()->setTitle(Phpfox::getPhrase('faq.frequently_asked_questions'))
        ->setBreadcrumb(Phpfox::getPhrase('faq.frequently_asked_questions'));
	}
}
?>
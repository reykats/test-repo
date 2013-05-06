<?php

defined('PHPFOX') or exit('NO DICE!');

class Faq_Service_Faq extends Phpfox_Service
{

	public function __construct(){}

    public function getCategories($faq_cat_id=0, $is_active = 1){

        $where = '';
        $returnFull = true;

        if($is_active){
          $where .= 'fc.is_active='.$is_active;
        }
        if($faq_cat_id){
          if($is_active) $where .= ' and ';
          $where .= 'fc.faq_cat_id = ' . $faq_cat_id;
          $returnFull = false;
        }

       $aQuestions = Phpfox::getLib('database')->select("fc.*")
			->from(Phpfox::getT('mg_faq_cat'), 'fc')
            ->where($where)
			->order('fc.ordering')
			->execute('getRows');

       return $returnFull? $aQuestions : $aQuestions[0];

    }

    public function getQuestionsAnswers($faq_cat_id=0, $is_active = 1, $faq_id = 0){

        $where = '';

        if($is_active){
          $where .= 'faq.is_active='.$is_active;
        }
        if($faq_cat_id){
          if($is_active) $where .= ' and ';
          $where .= 'faq.faq_cat_id = ' . $faq_cat_id;
        }
        if($faq_id){
          if($is_active || $faq_cat_id) $where .= ' and ';
          $where .= 'faq.faq_id = ' . $faq_id;
        }

       $aAnswers = Phpfox::getLib('database')->select("faq.*")
			->from(Phpfox::getT('mg_faq_question_answers'), 'faq')
            ->where($where)
			->order('faq.ordering')
			->execute('getRows');

       return $aAnswers;

    }

   public function getOneQAByUrl($friendly_url='', $friendly_url2 = ''){
        if(empty($friendly_url) or empty($friendly_url2)){
          return false;
        }
       $aAnswers = Phpfox::getLib('database')->select("f.*")
			->from(Phpfox::getT('mg_faq_question_answers'), 'f')
            ->join(Phpfox::getT('mg_faq_cat'), 'c', 'c.faq_cat_id = f.faq_cat_id')
            ->where("f.friendly_url = '".$friendly_url2."' and c.cat_addon_name = '".$friendly_url."'")
			->order('f.ordering')
			->execute('getRows');
       return $aAnswers;
    }

   public function getQuestionsByAddonName($addon=''){
        if(empty($addon)){
          return false;
        }
       $aAnswers = Phpfox::getLib('database')->select("f.*, c.*")
			->from(Phpfox::getT('mg_faq_question_answers'), 'f')
            ->join(Phpfox::getT('mg_faq_cat'), 'c', 'c.faq_cat_id = f.faq_cat_id')
            ->where("c.cat_addon_name = '".$addon."'")
			->order('f.ordering')
			->execute('getRows');
       return $aAnswers;
    }

    public function disableFaq($faqid){
        $ret = Phpfox::getLib('database')->update(Phpfox::getT('mg_faq_question_answers'), array('is_active'=>0), 'faq_id='.$faqid);
        return $ret;
    }

    public function enableFaq($faqid){
        $ret = Phpfox::getLib('database')->update(Phpfox::getT('mg_faq_question_answers'), array('is_active'=>1), 'faq_id='.$faqid);
        return $ret;
    }

    public function getFaqForAdmin(){

       $aFaq = Phpfox::getLib('database')->select("f.*, c.cat_name")
			->from(Phpfox::getT('mg_faq_question_answers'), 'f')
            ->join(Phpfox::getT('mg_faq_cat'), 'c', 'c.faq_cat_id = f.faq_cat_id')
			->order('f.ordering')
			->execute('getRows');

       return $aFaq;

    }

    public function getOneForEdit($faq){

       $aFaq = Phpfox::getLib('database')->select("f.*")
			->from(Phpfox::getT('mg_faq_question_answers'), 'f')
			->where('f.faq_id = '.$faq)
            ->order('f.ordering')
			->execute('getRows');

        return $aFaq;
    }

    public function addThis($aVal){
        $ret = Phpfox::getLib('database')->insert(
          Phpfox::getT('mg_faq_question_answers'),
          array(
            'is_active'=>$aVal['is_active'],
            'faq_cat_id'=>$aVal['faq_cat_id'],
            'question'=>$aVal['question'],
            'answer'=>$aVal['answer'],
            'question_phrase'=>$aVal['question_phrase'],
            'answer_phrase'=>$aVal['answer_phrase'],
            'ordering'=>$aVal['ordering'],
            'friendly_url'=>$aVal['friendly_url']
          )
        );
        return $ret;
    }

    public function editThis($aVal){
        $ret = Phpfox::getLib('database')->update(
          Phpfox::getT('mg_faq_question_answers'),
          array(
            'is_active'=>$aVal['is_active'],
            'faq_cat_id'=>$aVal['faq_cat_id'],
            'question'=>$aVal['question'],
            'answer'=>$aVal['answer'],
            'question_phrase'=>$aVal['question_phrase'],
            'answer_phrase'=>$aVal['answer_phrase'],
            'ordering'=>$aVal['ordering'],
            'friendly_url'=>$aVal['friendly_url']
          ),
        'faq_id='.$aVal['faq_id']);
        return $ret;
    }




   public function getOneCatForEdit($faq){

       $aFaq = Phpfox::getLib('database')->select("f.*")
			->from(Phpfox::getT('mg_faq_cat'), 'f')
			->where('f.faq_cat_id = '.$faq)
            ->order('f.ordering')
			->execute('getRows');

        return $aFaq;
    }

    public function addThisCat($aVal){
        $ret = Phpfox::getLib('database')->insert(
          Phpfox::getT('mg_faq_cat'),
          array(
            'is_active'=>$aVal['is_active'],
            'faq_cat_id'=>$aVal['faq_cat_id'],
            'cat_name'=>$aVal['cat_name'],
            'cat_addon_name'=>$aVal['cat_addon_name'],
            'ordering'=>$aVal['ordering']
          )
        );
        return $ret;
    }

    public function editThisCat($aVal){
        $ret = Phpfox::getLib('database')->update(
          Phpfox::getT('mg_faq_cat'),
          array(
            'is_active'=>$aVal['is_active'],
            'faq_cat_id'=>$aVal['faq_cat_id'],
            'cat_name'=>$aVal['cat_name'],
            'cat_addon_name'=>$aVal['cat_addon_name'],
            'ordering'=>$aVal['ordering']
          ),
        'faq_cat_id='.$aVal['faq_cat_id']);
        return $ret;
    }




    public function disableCat($faqid){
        $ret = Phpfox::getLib('database')->update(Phpfox::getT('mg_faq_cat'), array('is_active'=>0), 'faq_cat_id='.$faqid);
        return $ret;
    }

    public function enableCat($faqid){
        $ret = Phpfox::getLib('database')->update(Phpfox::getT('mg_faq_cat'), array('is_active'=>1), 'faq_cat_id='.$faqid);
        return $ret;
    }

    public function getFaqCatForAdmin(){

       $aFaq = Phpfox::getLib('database')->select("f.*")
			->from(Phpfox::getT('mg_faq_cat'), 'f')
			->order('f.ordering')
			->execute('getRows');

       return $aFaq;

    }



}

?>


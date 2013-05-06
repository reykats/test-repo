var $bNoCloseSearchFilter = false;  
var $bNoCloseSearchResult = false; 
var $bInitStatus = false; 
$Core.cfsearch ={
    options:{},
    requests:[],
    keyword:"",
    sCallUrl:'cfsearch.search',
    sFormUrl:'',
    filter:"user",
    bNoSearch: false,
    init:function($aOptions)
    {
        if($aOptions.length <=0)
        {
            return false;
        }
        if($bInitStatus == true)
        {
            this.bindAction(); 
            return;
        }
        else
        {
            $bInitStatus = true;
        }
        $sDefault = "user";
        if($aOptions.length > 0)
        {
            $sDefault = $aOptions[0].module;
        }
        $aFilter = $('<div id="header_cfsearch_filter" rel="'+$sDefault+'"></div>');
        $('#header_sub_menu_search').prepend($aFilter);
        $('#header_cfsearch_filter').css('background','url("'+oParams['sJsHome']+'module/cfsearch/static/image/'+$sDefault+'.png'+'") no-repeat center center transparent ');
        this.filterBar($aOptions);
        this.resultHTML($aOptions);
        this.bindAction();
        this.options = $aOptions;
        $('#cfsearch_input_filter').val($sDefault);
        this.filter = $sDefault;
        
    },
    bindAction:function()
    {
        $('#header_cfsearch_filter').bind('click',function(){
           $('#cfsearch_filter_section').show();
           $Core.cfsearch.hideResults();
           $bNoCloseSearchFilter = true;
        });
        $('#cfsearch_results').bind('click',function(){
                $bNoCloseSearchResult = true;
        });
        $('.cfsearch_filter_item').bind('click',function(){
            
            $sFilter = $(this).attr('rel');
            if($sFilter)
            {
                $('#header_cfsearch_filter').css('background','url("'+oParams['sJsHome']+'module/cfsearch/static/image/'+$sFilter+'.png'+'") no-repeat center center transparent ');    
                $('#cfsearch_filter_section').hide(); 
                $('#header_cfsearch_filter').attr('rel',$sFilter);
                $('#cfsearch_input_filter').val($sFilter);
                $Core.cfsearch.filter = $sFilter;
            }
            
        });
        /*unbind default phpfox search & replace with cfsearch*/
        $('#header_sub_menu_search_input').unbind('keyup');
        $('#header_sub_menu_search_input').keyup(function(e){
            switch(e.keyCode)
            {
                case 9:
                case 40:
                case 38:
                    var $iNextCnt = 0;
                    $ele = "#cfsearch_filter_item_content_list_"+$Core.cfsearch.filter;
                    $($ele+' .cfsearch_result_item_display').each(function()
                    {
                        $iNextCnt++;
                        if ($(this).hasClass('focus_hover'))
                        {
                            $(this).removeClass('focus_hover');                            
                            
                            return false;
                        }
                    });        
                    
                    if (!$iNextCnt)
                    {
                        return false;
                    }
                    $Core.cfsearch.bNoSearch = true;
                    var $iNewCnt = 0;
                    var $iActualFocus = 0;
                    $($ele+' .cfsearch_result_item_display').each(function()
                    {
                        $iNewCnt++;    
                        if ((e.keyCode == 38 ? ($iNextCnt - 1) == $iNewCnt : ($iNextCnt + 1) == $iNewCnt))
                        {
                            $iActualFocus++;
                            $(this).addClass('focus_hover');
                            return false;
                        }
                    });
                    
                    if (!$iActualFocus)
                    {
                        $($ele+' .cfsearch_result_item_display').each(function()
                        {
                            $(this).addClass('focus_hover');
                            
                            return false;                            
                        });                            
                    }
                    break;
                case 13:
                    $Core.cfsearch.bNoSearch = true;
                    $ele = "#cfsearch_filter_item_content_list_"+$Core.cfsearch.filter;
                    $($ele+' .cfsearch_result_item_display').each(function()
                    {
                        if ($(this).hasClass('focus_hover'))
                        {
                            if($(this).attr('url'))
                            {
                                window.location.href = $(this).attr('url');   
                            }
                            
                        }
                    });
                    break;
                default:
                    if($Core.cfsearch.keyword ==""  || $Core.cfsearch.keyword != $(this).val())
                    {
                        $Core.cfsearch.keyword = $(this).val();
                        $Core.cfsearch.getSearch($(this).val());    
                        $('.cfsearch_filter_item_result').removeClass('cfsearch_loaded');
                    }     
            }
            
            
        });
        $('#header_search_button').unbind('click');
        $('#header_search_button').attr("onclick","return false;");
        $('#header_search_form').attr("action",this.sFormUrl);
        $('#header_search_button').click(function(e){
            $Core.cfsearch.submit();
        });
        $('#header_search_form').submit(function(){
           $Core.cfsearch.submit(); 
           return false;
        });
        $('#header_sub_menu_search_input').click(function(){
           if($('#cfsearch_results').hasClass('has_tmp_view_search'))
           {
             $bNoCloseSearchResult = true;   
           }
           else
           {
               $bNoCloseSearchResult = false;
           }
           
        });
        /****/
        $('.cfsearch_filter_item_result').bind('click',function(){
            $sFilter = $(this).attr('rel');
            $('#header_sub_menu_search_input').focus();
            $('.cfsearch_filter_item_result').removeClass('active_search_result');
            if($(this).hasClass('cfsearch_loaded'))
            {
               $(this).addClass('active_search_result');
               $('.cfsearch_filter_item_content').hide(); 
               $('#cfsearch_filter_item_content_'+$sFilter).show();  
               $('#cfsearch_input_filter').val($sFilter);
               $('#header_cfsearch_filter').css('background','url("'+oParams['sJsHome']+'module/cfsearch/static/image/'+$sFilter+'.png'+'") no-repeat center center transparent ');    
               $('#header_cfsearch_filter').attr('rel',$sFilter); 
            }
            else
            {
                if($sFilter)
                {
                    $(this).addClass('active_search_result');
                    $(this).addClass('cfsearch_loaded');
                    $('.cfsearch_filter_item_content').hide();
                    $('#cfsearch_input_filter').val($sFilter);
                    $('#header_cfsearch_filter').css('background','url("'+oParams['sJsHome']+'module/cfsearch/static/image/'+$sFilter+'.png'+'") no-repeat center center transparent ');    
                    $('#header_cfsearch_filter').attr('rel',$sFilter); 
                    $Core.cfsearch.filter = $sFilter;
                    $Core.cfsearch.getSearch($('#header_sub_menu_search_input').val());
                    $('#cfsearch_filter_item_content_'+$sFilter).addClass("cfsearch_bg");
                    $('#cfsearch_filter_item_content_'+$sFilter).show();
                }
            }
        });
        $((getParam('bJsIsMobile') ? '#content' : 'body')).click(function(){
            if (!$bNoCloseSearchFilter)
            {
               $('#cfsearch_filter_section').hide(); 
            }
            if(!$bNoCloseSearchResult)
            {
                $('#cfsearch_results').hide();
            }
            $bNoCloseSearchFilter = false;
            $bNoCloseSearchResult = false;
        });
    },
    unbindAction:function()
    {
        
    },
    filterBar:function($aParams)
    {
       $('#header_sub_menu_search').append($('#cfsearch_filter_section_init').html());
       $('#cfsearch_filter_section_init').remove();
    },
    resultHTML:function($aParams)
    {
       $('#header_sub_menu_search').append($('#cfsearch_results_init').html());
       $('#cfsearch_results_init').remove();
    },
    showFilter:function()
    {
       $('#cfsearch_filter_section').show();
    },
    hideFilter:function()
    {
       $('#cfsearch_filter_section').hide();  
    },
    showResults:function()
    {
       if(!$('#cfsearch_results').hasClass('has_tmp_view_search') ) 
       {
            $('#cfsearch_results').fadeIn(); 
            $('#cfsearch_results').addClass('has_tmp_view_search');     
       }
       
    },
    hideResults:function()
    {
       $('#cfsearch_results').hide();
       $('#cfsearch_results').removeClass('has_tmp_view_search'); 
    },
    killRequest:function(key)
    {
        var l = this.requests.length;
        if(l>0)
        {
            for(var i = 0; i < l; i++)
            {
                this.requests[i].abort();
            }
        }
    },
    addRequest:function(key)
    {
        
       var sParams = '&' + getParam('sGlobalTokenName') + '[ajax]=true&' + getParam('sGlobalTokenName') + '[call]=' + this.sCallUrl;
       if (!sParams.match(/\[security_token\]/i))
       {
           sParams += '&' + getParam('sGlobalTokenName') + '[security_token]=' + oCore['log.security_token'];
       }
       sParams+='&key='+encodeURIComponent(key)+'&type='+ encodeURIComponent(this.filter);
       var xhr = $.ajax({
            type: "POST",
            url: getParam('sJsStatic') + "ajax.php",
            data: sParams,
            success: function(data){
                $Core.cfsearch.parseData(data);
            }
        });
        this.requests.push(xhr);
    },
    parseData:function(data)
    {
       if(data) 
       {
            $aResutls = $.parseJSON(data);
            $sHTML = "";
            if($aResutls.status && $aResutls.status == 1)
            {
                $('#cfsearch_filter_item_content_list_'+$aResutls.type).html("");                 
                for(i = 0;i <$aResutls.data.length;i++)
                {
                    dt = $aResutls.data[i];
                    $sDivParent = $('<div class="cfsearch_result_item_display"></div>');
                    $sDivParent.addClass('cfsearch_'+$aResutls.type); 
                    if(dt.item_url)
                    {
                        $sDivParent.attr('url',dt.item_url);
                    }
                    else
                    {
                        $sDivParent.attr('url',dt.item_link);
                    }
                    
                    if(!dt.user_image)
                    {
                        sImageUrl = oParams['sJsHome']+'module/cfsearch/static/image/noimg.png';   
                    }
                    else
                    {
                        if(dt.user_image.indexOf('http')<0)
                        {
                           sImageUrl = oParams['sJsHome']+'file/pic/user/'+ dt.user_image.replace("%s","_50_square");  
                        }
                        else
                        {
                            sImageUrl = dt.user_image;
                        }
                        
                    }
                    $sImg = '<img style="width:25px; height:25px;" alt="" src="'+sImageUrl+'">';
                    $sChildImg = $('<div class="cfsearch_result_item_display_img">'+$sImg+'</div>');
                    $sDivParent.append($sChildImg);
                    if(dt.item_title.length >80)
                    {
                        $sConte = "<p class='cfsearch_title'>"+dt.item_title.substr(0,80)+"...</p>";    
                    }
                    else
                    {
                        $sConte = "<p class='cfsearch_title'>"+dt.item_title+"</p>";
                    }
                    
                    $sContent = $('<div class="cfsearch_result_item_display_content">'+$sConte+'</div>');
                    $sDivParent.append($sContent);  
                    $sDivParent.append('<div class="clear"></div>');                                                       
                    $('#cfsearch_filter_item_content_list_'+$aResutls.type).append($sDivParent);
                }
                //$sHTML = $sDivParent;
            }
            else
            {
                $sHTML = '<div class="error_message" style="margin-top:20px;">'+$aResutls.message+'</div>';
                $('#cfsearch_filter_item_content_list_'+$aResutls.type).html($sHTML); 
                
            }
            $('#cfsearch_filter_item_content_list_'+$aResutls.type).parent().removeClass('cfsearch_bg');
            $('.cfsearch_result_item_display').bind('click',function(){
                $sRedirectUrl = $(this).attr('url');
                if($sRedirectUrl)
                {
                    window.location.href = $sRedirectUrl;
                }
            });
            
       }
       
    },
    getSearch:function(key)
    {
        if (empty(key))
        {
            this.hideResults(key);
            this.killRequest(this.keyword);      
            return;
        }
        
        $sFilter =  $('#cfsearch_input_filter').val();
        $('.cfsearch_filter_item_result').each(function(){
           $(this).removeClass('active_search_result');
           if($(this).attr('rel') == $sFilter)
           {
               $(this).addClass('active_search_result');
               $('.cfsearch_filter_item_content').hide();   
               $('#cfsearch_filter_item_content_'+$sFilter).show();
               //$('#cfsearch_filter_item_content_'+$sFilter).removeClass("cfsearch_bg");
           }
        });
        this.keyword  = key;
        //if(this.keyword != "" && $oObj.value != this.keyword )
        {
            this.killRequest(this.keyword);
            this.addRequest(this.keyword);
        }
        $sHTML = '<a href="#" class="holder_notify_drop_link" onclick="$Core.cfsearch.submit(); return false;">' + oTranslations['friend.show_more_results_for_search_term'].replace('{search_term}',htmlspecialchars(key)) + '</a>';
        $('.cfsearch_view_more_from_search').html($sHTML);
        
        this.showResults(key);    
    },
    submit:function()
    {
        this.sFormUrl = $('#header_search_form').attr("action");
        this.sFormUrl += this.filter+"/k_" + encodeURIComponent(this.keyword);
        window.location.href=this.sFormUrl;
    }
    
};
$Behavior.loadcfsearch = function(){
   $aParams = {};
   $Core.cfsearch.sFormUrl = $sFormUrl;   
   $Core.cfsearch.init($oFilterCFOptions);
   
}
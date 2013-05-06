<?php
/*
 * Teamwurkz Technologies Inc.
 * package tti_components
 */

defined('PHPFOX') or exit('NO DICE!');

?>

{if count($aSlides)}

		<div id="tm-tab-{$iTabGroup}_container">
			<div id="tm-tab-{$iTabGroup}">	
				<div class="tm_tab_panel_container">
				
					<ul class="tm_tab_panel">
					{foreach from=$aSlides name=iSlide item=aSlide}
						<li >
							<div class="tm_img_holder" style="background-image:url({$sTabimagedir}{$aSlide.image_location});">
								
							</div>
							<a href="{$aSlide.title_link}"></a>
						</li>			
					{/foreach}
					</ul>	
				
				</div>	
			
				<div class="clear"></div>
					<ul class="tm_tab_menu">
						{foreach from=$aSlides item=aSlideMenu}
							<li><a href="#{$iTabGroup}_br">&nbsp;</a></li>
						{/foreach}				
					</ul>					
				<div class="tm_arrownav">
					<ul>
						<li><a href="javascript:void(0)" id="aLeft" >{img theme='layout/arrow-left.png'}</a></li>
						<li><a href="javascript:void(0)" id="aRight">{img theme='layout/arrow-right.png'}</a></li>
					</ul>
				</div>
				<div class="loader">Loading...</div>
			</div>
			</div>

{/if}
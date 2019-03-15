 <?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(is_array($arResult["IMAGES"])):?>
<div class="nx-gallery-line  <?if($arParams['FLOAT']!="none"):?>to<?=$arParams['FLOAT']?><?endif?>" <?if($arParams['DIV_WIDTH']):?>style="width:<?=$arParams['DIV_WIDTH']?>"<?endif;?>>
	<?
	foreach ($arResult['IMAGES'] as $arElement):
		$text = $arParams['ALT'];
		if($arElement['TITLE']) $text = $arElement['TITLE'];
		if($arParams['BIGCLICK_PICTURES'] == 'Y'):?>
		<a class="nx-fancybox nx-gallery-element" 
		   href="<?=$arElement['PATH']?>" 
		   title="Нажмите чтобы увеличить" 
		   data-caption="<?=$arElement['TITLE']?>" 
		   rel="nofollow" 
		   data-fancybox="<?=$arResult['GROUP']?>" 
		   target="_bank"
		>
		<?else:?>
		<span class="nx-gallery-element">
		<?endif;?>
			<img src="<?=$arElement['SM']['PATH']?>" alt="<?=$arElement['ALT']?>" />
			<?if($arElement['CAPTION']):?>
				<ins <?if($arParams['DESCR_PICTURES'] == 'slide'):?>class="slide-desk"<?endif;?>><?=$arElement['TITLE']?>&nbsp;</ins>
			<?endif;?>
		<?if($arParams['BIGCLICK_PICTURES'] == 'Y'):?>
		</a>
		<?else:?>
		</span>
		<?endif;?>
	<?endforeach;?>
</div>
<?endif;?>
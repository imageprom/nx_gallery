<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?if(is_array($arResult['IMAGES'])):?>
<div class="nx-gallery-fotorama"
	 data-keyboard="true"
	 data-hash="true"

	 data-maxheight="780"

	<?if($arParams['TRANSITION']):?>
		data-transition="<?=$arParams['TRANSITION']?>"
	<?endif;?> 

	<?if($arParams['FULLSCREEN'] == 'Y'):?>
	data-allowfullscreen="true"
	<?endif;?> 

	<?if($arParams['LOOP'] == 'Y'):?>
	data-loop="true"
	<?endif;?>

	<?if($arParams['DIV_WIDTH']):?>
	data-width="<?=$arParams['DIV_WIDTH']?>"
	<?endif;?> 

	<?if($arParams['SHOW_THUMBS']):?>
	data-nav="thumbs" 
	data-thumbheight="<?=$arResult['THUMBS_HEIGHT']?>"
	data-thumbwidth = "<?=$arResult['THUMBS_WIDTH']?>"

		<?if($arParams['THUMBS_DOWN'] != 'Y'):?>
		data-navposition="top"
		<?endif;?> 

	<?endif;?> 
>
<?foreach ($arResult['IMAGES'] as $arElement):?> 
  	<?if($arParams['SHOW_THUMBS'] == 'Y'):?>
		<?if($arParams['THUMBS_LAZYLOAD'] == 'Y'):?>
			<a href="<?=$arElement['PATH']?>"  target="_bank" data-thumb="<?=$arElement['SM']['PATH']?>" <?if($arElement['CAPTION']):?>data-caption="<?=$arElement['CAPTION']?>"<?endif;?>></a>
		<?else:?>
			<a href="<?=$arElement['PATH']?>"  target="_bank">
		 		<img src="<?=$arElement['SM']['PATH']?>" alt="<?=$arElement['ALT']?>"  <?if($arElement['CAPTION']):?>data-caption="<?=$arElement['CAPTION']?>"<?endif;?> />
		 	</a>
		<?endif;?>
	<?else:?>
  	    <img src="<?=$arElement['PATH']?>" alt="<?=$arElement['ALT']?>" <?if($arElement['CAPTION']):?>data-caption="<?=$arElement['CAPTION']?>"<?endif;?> />
  	<?endif;?>
<?endforeach;?>
</div>
<?endif;?>
<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

$arResult['THUMBS_HEIGHT'] = intval($arParams ['THUMBS_HEIGHT']);
if(!$arResult['THUMBS_HEIGHT']) { 
	$arResult['THUMBS_HEIGHT'] = $arResult['MASK']['HEIGHT'];
	$arResult['THUMBS_WIDTH']  = $arResult['MASK']['WIDTH'];
}
else {
	$arResult['THUMBS_WIDTH']  = $arResult['MASK']['HEIGHT']/$arResult['MASK']['WIDTH'] * $arParams ['THUMBS_HEIGHT'];
}


foreach ($arResult['IMAGES'] as &$arElement) { 
	$arElement['ALT'] = $arParams['ALT'];
	if($arElement['TITLE']) $arElement['ALT'] = $arElement['TITLE'];
	if($arParams['SHOW_DESCR'] == 'Y' && $arParams['DESCR_PICTURES'] != 'alt' && $arElement['TITLE']) $arElement['CAPTION'] = true;
}


?>
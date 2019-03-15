<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

$arResult['GROUP'] = 'nx-images-'.getmicrotime();

foreach ($arResult['IMAGES'] as &$arElement) { 
	$arElement['ALT'] = $arParams['ALT'];
	if($arElement['TITLE']) $arElement['ALT'] = $arElement['TITLE'];
	if($arParams['SHOW_DESCR'] == 'Y' && $arParams['DESCR_PICTURES'] != 'alt' && $arElement['TITLE']) $arElement['CAPTION'] = true;
}


?>
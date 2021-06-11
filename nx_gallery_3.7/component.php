<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Page\Asset;

if($arParams['WIDTH_CROP'] == 'Y') $width_crop = true;
if($arParams['HEIGHT_CROP'] == 'Y') $height_crop = true;

if (!$arParams['MASK_URL']) {
	$arMessages[] = array( 'TYPE' => 'ERROR', 'MESSAGE' => 'Не задана маска для изображения');
}

else {

	$SM_MASK = $this->getMask($arParams['MASK_URL'], $arParams['ALPHA_MASK']);
	
	if(!$SM_MASK) {
		$arMessages[] = array('TYPE' => 'ERROR', 'MESSAGE' => 'Не найдена маска по адресу '.$arParams['MASK_URL']);
	}
	else {
		$arResult['MASK'] = $SM_MASK;
	}

	
	if ($arParams['ADD_MASK_TO_BIGPICTURE'] == 'Y' && $arParams['BIG_MASK_URL']) {

		$BIG_MASK = $this->getMask($arParams['BIG_MASK_URL'],$arParams['BIG_ALPHA_MASK'], $arParams['BIG_MASK_POSITION']);
		if(!$BIG_MASK) { 
			$arMessages[] = array('TYPE' => 'ERROR', 'MESSAGE' => 'Не найдена маска для большого изображения по адресу '.$arParams['BIG_MASK_URL']);
		}

		else $arResult['BIG_MASK'] = $BIG_MASK;
	}

	if ($arParams['PICTURES_SOURCE'] == 'dir') {

		$arParams['PICTURES_BASE_URL'] = $this->getPictureFromDir($arParams['PICTURES_SECT_URL']);
		$arParams['DESK_TEXT'] = $this->getDecriptionFromDir($arParams['PICTURES_SECT_URL']);
	}

	if(!is_array($arParams['DESK_TEXT'])) $arParams['DESK_TEXT'] = array();

	if(!is_array($arMessages) && is_array($arParams['PICTURES_BASE_URL'])) {
		
		foreach ($arParams['PICTURES_BASE_URL'] as $cnt => $Picture) {

			$CurImgData = $this->getFileArray($Picture);

			if($CurImgData) {
		
				$sm = $this->getFileArray($CurImgData['DIR'].'/'.$this->getPrefix().$CurImgData['NAME']);

				if ($sm) {
					$CurImgData['SM'] = $sm;
				}			
				else {

					$CurImgData['SM'] = $this->createPreview($CurImgData, $arResult['MASK'], $arParams['NO_CROP'], $width_crop, $height_crop);

					if ($arParams['ADD_MASK_TO_BIGPICTURE'] == 'Y'  &&  $arResult['BIG_MASK']) {

						$this->addMaskToOriginal($CurImgData, $arResult['BIG_MASK']);
					}
				}
				
				if ($arParams['SHOW_DESCR'] && count($arParams['DESK_TEXT'])) { 
					if ($arParams['PICTURES_SOURCE'] == 'files')  {
				  		$CurImgData['TITLE'] = html_entity_decode(trim($arParams['DESK_TEXT'][$cnt]));
				 	}
					else  { 
						$tmp = $CurImgData['SM']['NAME'];
						$CurImgData['TITLE'] = html_entity_decode(trim($arParams['DESK_TEXT'][$CurImgData['SM']['NAME']]));
					}
				}
				
				$arResult['IMAGES'][] = $CurImgData;		
			}
		}
	}
}

$arResult['COUNT_IMAGES'] = count($arResult['IMAGES']);

if(is_array($arMessages)) {
	foreach ($arMessages as $mes) echo ShowMessage($mes);
}

//$path = $this->GetPath().'/';

//Asset::getInstance()->addJs($path.'jquery.fancybox.min.js');
//Asset::getInstance()->addCss($path.'jquery.fancybox.css');


if($arParams['LIST_COUNT']) {

	$page = ($_GET['PAGE']) ? $_GET['PAGE'] - 1 : 0;
	$cnt = $arParams['LIST_COUNT'];
	$start = $cnt*$page;

	$arResult['IMAGES'] = array_slice($arResult['IMAGES'], $start, $cnt);

}


$this->IncludeComponentTemplate();?>
<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters['TRANSITION'] = Array(
		'NAME'=>'Анимация перехода',
		'TYPE' => 'LIST',
		'MULTIPLE'=>'Т',
		'DEFAULT' => 'files',
	    'VALUES' => Array(
	    	'slide' => 'Слайд', 
	    	'crossfade' => 'Выцветание',
	    	'dissolve' => 'Растворение',
	    ), 		                 
		'PARENT' => 'AREA_SETTINGS',
);

$arTemplateParameters['FULLSCREEN'] = Array(
		'NAME'=>'Полноэкранный режим',
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
		'PARENT' => 'AREA_SETTINGS',
	);

$arTemplateParameters['LOOP'] = Array(
		'NAME'=>'Зациклить показ',
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
		'PARENT' => 'AREA_SETTINGS',
	);

$arTemplateParameters['SHOW_THUMBS'] = Array(
		'NAME'=>'Показывать ленту превьюшек',
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'PARENT' => 'AREA_SETTINGS',
		'REFRESH' => 'Y'
	);

if($arCurrentValues['SHOW_THUMBS'] == 'Y') {
	
	$arTemplateParameters['THUMBS_DOWN'] = Array(
		'NAME'=>'Лента внизу',
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
		'PARENT' => 'AREA_SETTINGS',
	);

	$arTemplateParameters['THUMBS_HEIGHT'] = Array(
		'NAME' => 'Высота ленты в px',
		'TYPE' => 'STRING',
		'MULTIPLE' => 'N',
		'DEFAULT' => '',
		'VALUES' => '',
		'PARENT' => 'AREA_SETTINGS',
	);

	$arTemplateParameters['THUMBS_LAZYLOAD'] = Array(
		'NAME'=>'Динамическая подгрузка',
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'PARENT' => 'AREA_SETTINGS',
	);
}	
?>

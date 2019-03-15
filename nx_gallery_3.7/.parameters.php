<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = Array(

"GROUPS" => Array(
		
		"DESK_SETTINGS" => Array(
			"SORT" => 110,
			"NAME" => "Подписи к картинке",
		),
				
		"BIG_SETTINGS" => Array(
			"SORT" => 120,
			"NAME" => "Увеличенное изображение",
		),
		
		"AREA_SETTINGS" => Array(
			"SORT" => 130,
			"NAME" => "Параметры области",
		),
		
	),

	"PARAMETERS" => Array(

		"MASK_URL" => Array(
			"NAME" => "Url маски для превью",
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"VALUES" => "",
			"PARENT" => "BASE",
		), 	
		
		"ALPHA_MASK" => Array(
			"NAME" => "Прозрачность маски (%)",
			"TYPE" => "STRING",
			"DEFAULT" => "0",
			"VALUES" => "",
			"PARENT" => "BASE",
		),

		"NO_CROP" => Array(
			"NAME" => "Не обрезать превью",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "BASE",
			"REFRESH" => "Y"
		), 
		
		"PICTURES_SOURCE" => Array(
			"NAME"=>"Источник данных",
			"TYPE" => "LIST",
			"MULTIPLE"=>"Т",
			"DEFAULT" => "files",
		    "VALUES" => Array("files" => "Конкретные файлы", "dir" => "Папка",), 		                 
			"PARENT" => "BASE",
			"REFRESH" => "Y"
		),
		
		"BIGCLICK_PICTURES" => Array(
			"NAME" => "Открывать увеличенное изображение",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "BIG_SETTINGS",
			"REFRESH" => "Y"
		), 
		
		"DIV_WIDTH" => Array(
			"NAME" => "Ширина видимой области",
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"VALUES" => "",
			"PARENT" => "AREA_SETTINGS",
		), 

	    "ALT" => Array(
			"NAME" => "Альтернативный текст по умолчанию",
			"TYPE" => "STRING",
			"DEFAULT" => "Изображение",   
			"VALUES" => "",
			"PARENT" => "DESK_SETTINGS",
		), 		
		
		"SHOW_DESCR" => Array(
			"NAME" => "Выводить описания",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "DESK_SETTINGS",
			"REFRESH" => "Y"
		), 	
	)
);

if($arCurrentValues["SHOW_DESCR"] == "Y") {
	if($arCurrentValues["PICTURES_SOURCE"] == "files") {
		$arComponentParameters["PARAMETERS"]["DESK_TEXT"] = Array(
			"NAME" => "Названия картинок",
			"TYPE" => "STRING",
			"MULTIPLE" => "Y",
			"DEFAULT" => "",
			"VALUES" => "",
			"PARENT" => "DESK_SETTINGS",
		);
	}
		
	$arComponentParameters["PARAMETERS"]["DESCR_PICTURES"] = Array(
		"NAME" => "Описания изображений",
		"TYPE" => "LIST",
		"DEFAULT" => "under",
		"VALUES" => Array("slide" => "Всплывающие", "under" => "Под картинкой", "alt" => "Как альтернативный текст"),
		"PARENT" => "DESK_SETTINGS",
	);
}

if($arCurrentValues["BIGCLICK_PICTURES"] == "Y") {

	$arComponentParameters["PARAMETERS"]["ADD_MASK_TO_BIGPICTURE"] = Array(
			"NAME" => "Накладывать маску на увеличеное изображение",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "BIG_SETTINGS",
			"REFRESH" => "Y"
		);
		
	if($arCurrentValues["ADD_MASK_TO_BIGPICTURE"]=="Y") {	
		
		$arComponentParameters["PARAMETERS"]["BIG_MASK_URL"] = Array(
			"NAME" => "Url маски увеличенное изображения",
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"VALUES" => "",
			"PARENT" => "BIG_SETTINGS",
		);
		
		$arComponentParameters["PARAMETERS"]["BIG_ALPHA_MASK"] = Array(
			"NAME" => "Прозрачности маски большого изображения (%)",
			"TYPE" => "STRING",
			"DEFAULT" => "0",
			"VALUES" => "",
			"PARENT" => "BIG_SETTINGS",
		);
			
		$arComponentParameters["PARAMETERS"]["BIG_MASK_POSITION"] = Array(
			"NAME" => "Положение маски на большом изображении",
			"TYPE" => "LIST",
			"DEFAULT" => "SouthEast",
			"VALUES" => Array("NorthWest" => "Верхний левый угол", "North" => "Сверху по центру", 
							  "NorthEast" => "Верхний правый угол", "East" => "Справа по центру", 
							  "SouthEast" => "Нижний правый угол", "South" => "Снизу по центру", 
							  "SouthWest" => "Нижний левый угол",   "West" => "Слева по центру", "Center" => "В центре изображения"),
			"PARENT" => "BIG_SETTINGS",
		);
    }	
}

if($arCurrentValues["PICTURES_SOURCE"] == "dir") {
    	
	$arComponentParameters["PARAMETERS"]["PICTURES_SECT_URL"] = Array(
		"NAME" => "Адрес папки с картинками",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"VALUES" => "",
		"PARENT" => "BASE",
	);
}

else {

	$arComponentParameters["PARAMETERS"]["PICTURES_BASE_URL"] = Array(
		"NAME" =>"Адреса картинок",
		"TYPE" => "STRING",
		"MULTIPLE" => "Y",
		"DEFAULT" => "",
		"VALUES" => "",
		"PARENT" => "BASE",
	);
}
?>
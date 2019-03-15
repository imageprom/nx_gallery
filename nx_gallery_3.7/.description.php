<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("GALLERY_NAME"),
	"DESCRIPTION" => GetMessage("GALLERY_DESC"),
	"ICON" => "/images/gallery.gif",
	"PATH" => array(
		"ID" => "my_components",
		"NAME" => GetMessage("IP_COMPONENTS_TITLE"),
		"CHILD" => array(
			"ID" => "nx_gallery",
			"NAME" => GetMessage("GALLERY_DESC_SECT")
		)
	),
);

?>
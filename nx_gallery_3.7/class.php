<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

class CNXGallery extends \CBitrixComponent {
	
	const IMAGIC = '/usr/bin/';
	const DESCRIPTION = 'descript.ion';
	const PREFIX = 'GM_';

	private $arMessages;

	private static $arPosition = array('NorthWest', 'North', 'NorthEast', 'East', 'SouthEast', 'South', 'SouthWest', 'West', 'Center'); 

	public static function getFullPath($path) {
		return $_SERVER['DOCUMENT_ROOT'].$path;
	}

	public function getPrefix() {
		return self::PREFIX;
	}

	public function onPrepareComponentParams($arParams) {
		
		$arParams['MASK_URL'] = trim($arParams['MASK_URL']);
		$arParams['ALPHA_MASK'] = intval($arParams['ALPHA_MASK']);

		$arParams['BIG_MASK_URL'] = trim($arParams['BIG_MASK_URL']);
		$arParams['BIG_ALPHA_MASK'] = intval($arParams['BIG_ALPHA_MASK']);

		$arParams['BIG_MASK_POSITION'] = trim($arParams['BIG_MASK_POSITION']);

		if(!in_array($arParams['BIG_MASK_POSITION'], self::$arPosition)) $arParams['BIG_MASK_POSITION'] = false;

		if($arParams['PICTURES_SECT_URL']) 
			$arParams['PICTURES_SECT_URL'] =  '/'.trim($arParams['PICTURES_SECT_URL'],'/').'/';

		if(is_array($arParams['PICTURES_BASE_URL'])) {
			foreach ($arParams['PICTURES_BASE_URL'] as &$picture) {
				$picture = trim($picture);
			}
		}

		return $arParams;
	}


	public function getMask($path, $alpha, $position = false) {
		
		$fullPath = self::getFullPath($path);

		if(!file_exists($fullPath)) return false;
		if(!$mask_size = getimagesize($fullPath)) return false;

		$mask = array('MASK_URL' => $path,
					  'FULL_PATH' => $fullPath, 
					  'WIDTH' => $mask_size[0], 
					  'HEIGHT' => $mask_size[1], 
					  'TYPE' => $mask_size[2], 
					  'ALPHA' => $alpha,
					 );

		if($position) $mask['POSITION'] = $position;

		return $mask;
	}

	public function getPictureFromDir($path) {

		$fullPath = self::getFullPath($path);

		if(!is_dir($fullPath)) return false;

		$allFiles = glob($fullPath.'*.*');
		$gmFiles = glob($fullPath.self::PREFIX.'*.*');
		$dsFiles = array($fullPath.$this->DESCRIPTION);
		
		if(is_array($gmFiles)) 
			$files = array_diff($allFiles, $gmFiles);
		else 
			$files = $allFiles;

		$files = array_diff($files, $dsFiles);

		foreach ($files as &$file) {
			$file = str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
		}

		return $files;
	}

	public function getDecriptionFromDir($path) {
		
		$fullPath = self::getFullPath($path).self::DESCRIPTION;
		
		if(!file_exists($fullPath)) return false;
		
		$desc = file($fullPath);

		foreach ($desc as $descValue) {
			preg_match('/^\'(.+)\' (.+)/u',  $descValue, $mathes);
			if ($mathes[0])  {
				$picture = self::PREFIX.ltrim(trim($mathes[1]), self::PREFIX);
				$result[$picture] = trim($mathes[2]);
			}
		}

		TrimArr($result);
		return $result;
	}

	public function getFileArray($file) {

		$fullPath = self::getFullPath($file);

		if(!file_exists($fullPath))  return false;
		if(!$size = getimagesize($fullPath)) return false;

		$pathInfo = pathinfo($file);
		
		$result['PATH'] = $file;
		$result['FULL_PATH'] = $fullPath;
		$result['WIDTH'] = $size[0];
		$result['HEIGHT'] = $size[1];
		$result['TYPE'] = $size[2];
		$result['DIR'] = $pathInfo['dirname'];
		$result['NAME'] = $pathInfo['basename'];

		return $result;
	}

	public function createPreview($source, $mask, $noCrop = false) {

		if ($mask['ALPHA'] > 100) $smAlpha = 0;
		else $smAlpha = 100 - $mask['ALPHA']; 

		$smMask = $mask['FULL_PATH'];
		$smInput = $source['FULL_PATH'];
		$smSize = $mask['WIDTH'].'x'.$mask['HEIGHT'];
		$smOoutput = self::getFullPath($source['DIR'].'/'.self::PREFIX.$source['NAME']);

		$mod = ($noCrop != 'Y') ? '^' : '';

		exec(self::IMAGIC.'convert '.$smInput.' -strip -interlace Plane -quality 95% -resize '.$smSize.$mod.' -gravity center -extent '.$smSize.' '.$smOoutput);
		exec(self::IMAGIC.'composite -dissolve '.$smAlpha.' '.$smMask.' '.$smOoutput.' '.$smOoutput);

		$result = $this->getFileArray($smOoutput);

		return $result;	
	}

	public function addMaskToOriginal($source, $mask) {

		$smPos = '-gravity '.$mask['POSITION'];
		$smMask = $mask['FULL_PATH'];
		$smInput = $source['FULL_PATH'];
		if ($mask['ALPHA'] > 100) $smAlpha = 0;
		else $smAlpha = 100 - $mask['ALPHA'];

		exec(self::IMAGIC.'composite '.$smPos.' -dissolve '.$smAlpha.' '.$smMask.' '.$smInput.' '.$smInput);
	}
	
	public function getComponentId ()
	{
		return substr(md5(serialize($this->arParams)), 10).$this->randString();
	}
}
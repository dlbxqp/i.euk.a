<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('<pre>' . print_r($arResult, true) . '</pre>');

$a = [];
foreach($arResult['ITEMS'] as $arItem){
 $this -> AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this -> AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), ['CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);

 #< images
 $aImages = [];
 //isset($arItem['DISPLAY_PROPERTIES']['housing_complexes__images']['FILE_VALUE']) && die('> ' . print_r($arItem['DISPLAY_PROPERTIES']['housing_complexes__images']['FILE_VALUE']));
 if( isset($arItem['DISPLAY_PROPERTIES']['housing_complexes__images']['FILE_VALUE']) ){
  isset($arItem['DISPLAY_PROPERTIES']['housing_complexes__images']['FILE_VALUE']['SRC']) && $arItem['DISPLAY_PROPERTIES']['housing_complexes__images']['FILE_VALUE'] = [0 => $arItem['DISPLAY_PROPERTIES']['housing_complexes__images']['FILE_VALUE']];
  foreach($arItem['DISPLAY_PROPERTIES']['housing_complexes__images']['FILE_VALUE'] as $v){
   $aImages[] = "//{$_SERVER['HTTP_HOST']}{$v['SRC']}";
  }
 }
 #> images

 $aa = [];
 in_array('id', (array)$GLOBALS['fields']) && $aa['id'] = $arItem['ID'];
 in_array('code', (array)$GLOBALS['fields']) && $aa['code'] = $arItem['~CODE'];
 in_array('title', (array)$GLOBALS['fields']) && $aa['title'] = $arItem['~NAME'];
 in_array('images', (array)$GLOBALS['fields']) && $aa['images'] = $aImages;
 in_array('text', (array)$GLOBALS['fields']) && $aa['text'] = $arItem['~PREVIEW_TEXT'];
 //'operating company' => $arItem['DISPLAY_PROPERTIES']['housing_complexes__operating_company']['~VALUE'],
 #
 $a[] = $aa;
}

exit( json_encode($a, JSON_UNESCAPED_UNICODE) );
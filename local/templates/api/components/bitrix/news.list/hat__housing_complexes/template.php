<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die(json_encode($arResult['ITEMS'], JSON_UNESCAPED_UNICODE));

foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), ['CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);

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

 $GLOBALS['aResult'][ $arItem['DISPLAY_PROPERTIES']['housing_complexes__operating_company']['~VALUE'] ]['housing complexes'][ $arItem['ID'] ] = [
  'code' => $arItem['~CODE'],
  'title' => $arItem['~NAME'],
  'images' => $aImages
 ];
}

$GLOBALS['aCurrentHousingComplexes'] = array_keys($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes']);

<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die(json_encode($arResult['ITEMS'], JSON_UNESCAPED_UNICODE));

foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 if( in_array($GLOBALS['currentOperatingCompanyId'], (array)$arItem['DISPLAY_PROPERTIES']['simple_pages__operating_companies']['VALUE']) ){
  $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['menu'][] = [
   'title' => $arItem['~NAME'],
   'code' => $arItem['~CODE']
  ];
 }

 foreach($GLOBALS['aCurrentHousingComplexes'] as $v){
  if( in_array($v, (array)$arItem['DISPLAY_PROPERTIES']['simple_pages__housing_complexes']['VALUE']) ){
   $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $v ]['menu'][] = [
    'title' => $arItem['~NAME'],
    'code' => $arItem['~CODE']
   ];
  }
 }
}

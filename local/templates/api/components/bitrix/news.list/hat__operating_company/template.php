<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 $aConsent = [];
 $a_consent = explode("\r\n", trim($arItem['DISPLAY_PROPERTIES']['operating_company__consent']['~VALUE']));
 foreach($a_consent as $v){
  $a_v = explode('|', $v);
  if($a_v[0]*1 > 0){
   $aConsent[$a_v[0]] = $a_v[1];
  }
 }

 $a_code = explode(',', $arItem['CODE']);
 foreach($a_code as $k => $v){
  $v = trim($v);
  if(
   $v == $_GET['code']
   || $v == "www.{$_GET['code']}"
  ){
   (count($a_code) > 1) && ($arItem['CODE'] = $a_code[0]);
   $GLOBALS['aResult'][ $arItem['ID'] ] = [
    'code' => $arItem['CODE'],
    'title' => $arItem['~NAME'],
    'type' => $arItem['DISPLAY_PROPERTIES']['operating_company__type']['~VALUE'],
    'consent' => $aConsent,
    'logotype' => ($arItem['PREVIEW_PICTURE']['UNSAFE_SRC'] != '') ? ('//' . $_SERVER['SERVER_NAME'] . $arItem['PREVIEW_PICTURE']['UNSAFE_SRC']) : null
   ];

   $GLOBALS['currentOperatingCompanyId'] = $arItem['ID'];

   break;
  }
 }
}
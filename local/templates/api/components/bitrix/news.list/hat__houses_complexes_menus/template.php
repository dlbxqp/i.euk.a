<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('> ' . count($arResult['ITEMS']));

if(count($arResult['ITEMS']) > 0){
 $aHousesComplexMenu = [
  10 => 'Тарифы',
  11 => 'РСО'
 ];
 foreach($arResult['ITEMS'] as $arItem){
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

  foreach($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'] as $k => $v){
   $aHousesKeys = array_keys($v['houses']);
   //echo print_r($aHousesKeys, true) . ' => ' . print_r((array)$arItem['DISPLAY_PROPERTIES']["{$arResult['~CODE']}__houses"]['VALUE'], true);
   foreach($aHousesKeys as $vv){
    if( in_array($vv, (array)$arItem['DISPLAY_PROPERTIES']["{$arResult['~CODE']}__houses"]['VALUE']) ){
     $itemMenu = [
      'title' => $aHousesComplexMenu[ $arResult['~ID'] ],
      'code' => $arResult['~CODE']
     ];
     if( !in_array($itemMenu, $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $k ]['menu']) ){
      $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $k ]['menu'][] = $itemMenu;
     }

     break;
    }
   }
  }
 }
}
<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), ['CONFIRM'=>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);

 $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $arItem['DISPLAY_PROPERTIES']['houses__housing_complex']['~VALUE'] ]['houses'][ $arItem['ID'] ] = [
  'code' => $arItem['~CODE'],
  'title' => $arItem['~NAME']
 ];
}

foreach($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'] as $v){
 //die(json_encode($v, JSON_UNESCAPED_UNICODE));
 foreach(array_keys($v['houses']) as $vv){
  $GLOBALS['aCurrentHouses'][ $v['code'] ][] = $vv;
 }
}

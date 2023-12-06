<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('<pre>' . print_r($arResult['ITEMS'], true) . '</pre>');

$a = [];
foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 $a_ACTIVE_FROM = explode('.', $arItem['~ACTIVE_FROM']);
 $year = end($a_ACTIVE_FROM);
 isset($a[$year]) ? $a[$year]++ : ($a[$year] = 1);
}

$aTransfer = json_decode( file_get_contents("../../transfer/information_disclosure/{$GLOBALS['currentOperatingCompanyId']}/data.json"), true);
foreach($aTransfer as $v){
 isset($a[ $v['year'] ]) ? $a[ $v['year'] ]++ : ($a[ $v['year'] ] = 1);
}


foreach($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['menu'] as $k => $v){
 if($v['code'] === 'information_disclosure'){
  $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['menu'][$k]['menu'] = $a;

  break;
 }
}
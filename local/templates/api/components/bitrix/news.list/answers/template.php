<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('<pre>' . print_r($arResult, true) . '</pre>');

//isset($_GET['operatingCompanyId']) && ($operatingCompanyId = $_GET['operatingCompanyId']);
$a = [];
foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 $a[] = [
  'id' => $arItem['ID'],
  'question' => $arItem['~NAME'],
  'answer' => $arItem['~DETAIL_TEXT'],
  //'operating company' => $arItem['DISPLAY_PROPERTIES']['answers__operating_company']['~VALUE']
 ];

 //!isset($operatingCompanyId) && ($operatingCompanyId = (int)$arItem['DISPLAY_PROPERTIES']['answers__operating_company']['~VALUE']);
}

/* 240702 off по просьбе Бартеневой
$i = 999;
if( isset($_GET['count']) ){
 $count = count($a);
 $i = ($count < (int)$_GET['count']) ? ((int)$_GET['count'] - $count) : 0;
}
$aTransfer = json_decode( file_get_contents("../../transfer/answers/{$operatingCompanyId}/data.json"), true);
foreach($aTransfer as $v){
 $i--; if($i < 0) break;

 $a[] = [
  'id' => $v['id'],
  'question' => $v['question'],
  'answer' => str_replace('img src="', 'img src="//' . "{$_SERVER['HTTP_HOST']}/transfer/answers/{$operatingCompanyId}/images/", $v['answer']),
  //'operating company' => $operatingCompanyId
 ];
}
*/


exit( json_encode($a, JSON_UNESCAPED_UNICODE) );
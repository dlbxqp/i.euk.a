<?php
setlocale(LC_ALL, 'ru_RU.utf8');

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('<pre>' . print_r($arResult, true) . '</pre>');

isset($_GET['operatingCompanyId']) && ($operatingCompanyId = $_GET['operatingCompanyId']);
$a = [];
foreach($arResult['ITEMS'] as $arItem){
 $this -> AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this -> AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 $anDocuments = [];
 $aA = $arItem['DISPLAY_PROPERTIES']['important_to_know__documents']['FILE_VALUE'];
 $aDocuments = isset($aA['ID']) ? [0 => $aA] : $aA;
 unset($aA);
 #
 foreach($aDocuments as $v){ //die('<pre>' . print_r($v, true) . '</pre>');
  $anDocuments[] = [
   'file name' => trim( pathinfo($v['ORIGINAL_NAME'], PATHINFO_FILENAME) ),
   'extension' => pathinfo($v['ORIGINAL_NAME'], PATHINFO_EXTENSION),
   'src' => $v['SRC']
  ];
 }

 $a[] = [
  'id' => $arItem['ID'],
  'title' => $arItem['~NAME'],
  'date' => $arItem['~ACTIVE_FROM'],
  'documents' => $anDocuments,
  //'operating company' => $arItem['DISPLAY_PROPERTIES']['important_to_know__operating_company']['~VALUE']
 ];

 !isset($operatingCompanyId) && ($operatingCompanyId = (int)$arItem['DISPLAY_PROPERTIES']['important_to_know__operating_company']['~VALUE']);
}

$i = 999;
if( isset($_GET['count']) ){
 $count = count($a);
 $i = ($count < (int)$_GET['count']) ? ((int)$_GET['count'] - $count) : 0;
}
$aTransfer = json_decode( file_get_contents("../../transfer/important_to_know/{$operatingCompanyId}/data.json"), true);
//die('<pre>' . $operatingCompanyId /*print_r($aTransfer, true)*/ .  '</pre>');
foreach($aTransfer as $v){
 $i--; if($i < 0) break;

 $aDocuments = [];
 foreach($v['documents'] as $vv){
  $aDocuments[] = [
   'file name' => $vv['title'],
   'extension' => $vv['extension'],
   'src' => $vv['url']
  ];
 }

 $a[] = [
  'id' => $v['id'],
  'date' => $v['date'],
  'title' => $v['title'],
  'documents' => $aDocuments
 ];
}


//die('<pre>' . print_r($a, true) . '</pre>');
exit( json_encode($a, JSON_UNESCAPED_UNICODE) );

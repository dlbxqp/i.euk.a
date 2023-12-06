<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('<pre>' . print_r($arResult['ITEMS'], true) . '</pre>');

isset($_POST['operatingCompanyId']) && ($operatingCompanyId = $_POST['operatingCompanyId']);
$a = ['counts' => [], 'items' => []];
foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 $a_ACTIVE_FROM = explode('.', $arItem['~ACTIVE_FROM']);
 $year = end($a_ACTIVE_FROM);
 if( isset($a['counts'][$year]) ) {
  $a['counts'][$year]++;
 } else {
  $a['counts'][$year] = 1;
 }
 #
 if( (int)$year == (int)$_POST['year'] ){
  $anDocuments = [];
  $aA = $arItem['DISPLAY_PROPERTIES']['information_disclosure__documents']['FILE_VALUE'];
  $aDocuments = isset($aA['ID']) ? [0 => $aA] : $aA;
  unset($aA);
  #
  foreach($aDocuments as $v){ //die('<pre>' . print_r($v, true) . '</pre>');
   $a_originalName = explode('/', $v['ORIGINAL_NAME']);
   $fileFullName = end($a_originalName);
   $a_fileFullName = explode('.', $fileFullName);
   $fileExtension = end($a_fileFullName);
   $fileName = str_replace(".{$fileExtension}", '', $fileFullName);
   $anDocuments[] = [
    'file name' => $fileName,
    'extension' => $fileExtension,
    'src' => $v['SRC']
   ];
  }
  $a['items'][] = [
   'id' => $arItem['ID'],
   'title' => $arItem['~NAME'],
   'date' => $year,
   'documents' => $anDocuments,
   //'operating company' => $arItem['DISPLAY_PROPERTIES']['information_disclosure__operating_company']['~VALUE'],
  ];
 }

 !isset($operatingCompanyId) && ($operatingCompanyId = (int)$arItem['DISPLAY_PROPERTIES']['information_disclosure__operating_company']['~VALUE']);
}
//die('> <pre>' . print_r($a) . '</pre>');

$i = 999;
if( isset($_POST['count']) ){
 $count = count($a['items']);
 $i = ($count < (int)$_POST['count']) ? ((int)$_POST['count'] - $count) : 0;
} //die(count($a['items']) . ' > ' . $count . ' > ' . $i);
$aTransfer = json_decode( file_get_contents("../../transfer/information_disclosure/{$operatingCompanyId}/data.json"), true);
//die('<pre>' . $operatingCompanyId . print_r($aTransfer, true) .  '</pre>');
foreach($aTransfer as $v){ //die('> ' . (int)$_POST['year'] . print_r($v));
 if( isset($a['counts'][ $v['year'] ]) ){
  $a['counts'][ $v['year'] ]++;
 } else {
  $a['counts'][ $v['year'] ] = 1;
 }

 if($i > 0){
  if(isset($_POST['year']) and (int)$v['year'] !== (int)$_POST['year']) continue;

  $i--;

  $aDocuments = [];
  foreach($v['documents'] as $vv){
   $aDocuments[] = [
    'file name' => $vv['file name'],
    'extension' => $vv['extension'],
    'src' => $vv['src']
   ];
  }
  $a['items'][] = [
   'date' => $v['year'],
   'title' => $v['title'],
   'documents' => $aDocuments
  ];
 }
}

exit( json_encode($a, JSON_UNESCAPED_UNICODE) );
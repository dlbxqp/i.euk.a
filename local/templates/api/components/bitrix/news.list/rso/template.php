<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('<pre>' . print_r($arResult['ITEMS'], true) . '</pre>');

$a = [];
//* < new
foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 $aa = [];

 $aHouses = [];
 sort($arItem['DISPLAY_PROPERTIES']['rso__houses']['LINK_ELEMENT_VALUE']);
 foreach($arItem['DISPLAY_PROPERTIES']['rso__houses']['LINK_ELEMENT_VALUE'] as $v){
  $aHouses[$v['~ID']] = $v['~NAME'];
 }

 in_array('id', (array)$GLOBALS['fields']) && ($aa['id'] = $arItem['ID']);
 in_array('address', (array)$GLOBALS['fields']) && ($aa['address'] = $arItem['~NAME']);
 in_array('description', (array)$GLOBALS['fields']) && ($aa['description'] = $arItem['~PREVIEW_TEXT']);
 in_array('houses', (array)$GLOBALS['fields']) && ($aa['houses'] = (array)$aHouses);

 $a[] = $aa;
}
// > new */

/* < old
$path = "../../transfer/rso/data/{$_POST['houseId']}/data.json";
//die('> ' . mb_detect_encoding( file_get_contents($path), 'windows-1251, UTF-8'));
if(isset($_POST['houseId']) and is_file($path)){
 $aTransfer = json_decode( file_get_contents($path), true );
 isset($aTransfer['address']) && $aTransfer = [ $aTransfer ];
 //die('> ' . json_encode( $aTransfer) );
 foreach($aTransfer as $v){
  $aa = [];

  in_array('address', (array)$GLOBALS['fields']) && ($aa['address'] = $v['address']);
  in_array('description', (array)$GLOBALS['fields']) && ($aa['description'] = $v[ 'description']);
  in_array('houses', (array)$GLOBALS['fields']) && ($aa['houses'] = $v['houses']);

  //die('> ' . print_r($aTransfer, true));
  $a[] = $aa;
 }
}
// > old */

//die(print_r($a, true));
exit( json_encode($a, JSON_UNESCAPED_UNICODE) );
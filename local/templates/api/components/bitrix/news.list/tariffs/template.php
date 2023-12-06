<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die(json_encode($arResult['ITEMS'], true));

$a = [];
//* < new
foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 $semester = mb_strtoupper($arItem['DISPLAY_PROPERTIES']['tariffs__halfyear']['VALUE']);

 $aHouses = [];
 sort($arItem['DISPLAY_PROPERTIES']['tariffs__houses']['LINK_ELEMENT_VALUE']);
 foreach($arItem['DISPLAY_PROPERTIES']['tariffs__houses']['LINK_ELEMENT_VALUE'] as $v){
  $aHouses[$v['~ID']] = $v['~NAME'];
 }
 #
 in_array('id', (array)$GLOBALS['fields']) && ($aa['id'] = $arItem['ID']);
 in_array('title', (array)$GLOBALS['fields']) && ($aa['title'] = $arItem['~NAME']);
 in_array('description', (array)$GLOBALS['fields']) && ($aa['description'] = $arItem['~PREVIEW_TEXT']);
 in_array('houses', (array)$GLOBALS['fields']) && ($aa['houses'] = $aHouses);
 in_array('halfyear', (array)$GLOBALS['fields']) && ($aa['halfyear'] = $semester);
 #
 $a[] = $aa;
}
// > new */

//* < old
if(isset($_POST['houseId'])){
 $aTransfer = json_decode(file_get_contents("../../transfer/tariffs/data/{$_POST['houseId']}/data.json"), true);
 //die('> ' . json_encode( $aTransfer) );
 foreach($aTransfer as $v){
  if($v['halfyear'] != mb_strtolower($_POST['semester'])) continue;

  $aa = [];
  in_array('id', (array)$GLOBALS['fields']) && ($aa['id'] = $v['id']);
  in_array('title', (array)$GLOBALS['fields']) && ($aa['title'] = $v['title']);
  in_array('description', (array)$GLOBALS['fields']) && ($aa['description'] = $v['description']);
  in_array('houses', (array)$GLOBALS['fields']) && ($aa['houses'] = $v['houses']);
  in_array('halfyear', (array)$GLOBALS['fields']) && ($aa['halfyear'] = $v['halfyear']);
  #
  $a[] = $aa;
 }
}
// > old */

exit( json_encode($a, JSON_UNESCAPED_UNICODE) );
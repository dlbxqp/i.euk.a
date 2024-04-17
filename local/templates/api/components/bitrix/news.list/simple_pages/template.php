<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('<pre>' . print_r($arResult, true) . '</pre>');

$a = [];
foreach($arResult['ITEMS'] as $arItem){
 $this -> AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this -> AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock ::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 #< SEO
 $ipropElementValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arParams['IBLOCK_ID'], $arItem['ID']);
 $pageProperties = $ipropElementValues->getValues();
 #> SEO

 $aOperatingCompanies = [];
 $a1 = $arItem['DISPLAY_PROPERTIES']['simple_pages__operating_companies']['VALUE'];
 $a2 = isset($a1['ID']) ? [0 => $a1] : $a1;
 unset($a1);
 #
 foreach($a2 as $v){ //die('<pre>' . print_r($v, true) . '</pre>');
  $aOperatingCompanies[] = $v;
 }

 $aHousingComplexes = [];
 $a1 = $arItem['DISPLAY_PROPERTIES']['simple_pages__housing_complexes']['VALUE'];
 $a2 = isset($a1['ID']) ? [0 => $a1] : $a1;
 unset($a1);
 #
 foreach($a2 as $v){ //die('<pre>' . print_r($v, true) . '</pre>');
  $aHousingComplexes[] = $v;
 }

 $aHouses = [];
 $a1 = $arItem['DISPLAY_PROPERTIES']['simple_pages__houses']['VALUE'];
 $a2 = isset($a1['ID']) ? [0 => $a1] : $a1;
 unset($a1);
 #
 foreach($a2 as $v){ //die('<pre>' . print_r($v, true) . '</pre>');
  $aHouses[] = $v;
 }

 //die( json_encode($GLOBALS['fields'], JSON_UNESCAPED_UNICODE) );
 $aa = [];
 in_array('id', (array)$GLOBALS['fields']) && $aa['id'] = $arItem['ID'];
 in_array('code', (array)$GLOBALS['fields']) && $aa['code'] = $arItem['~CODE'];
 in_array('header', (array)$GLOBALS['fields']) && $aa['header'] = $arItem['~NAME'];
 in_array('text', (array)$GLOBALS['fields']) && $aa['text'] = ($arItem['~DETAIL_TEXT'] != '') ? $arItem['~DETAIL_TEXT'] : $arItem['~PREVIEW_TEXT'];
 in_array('menu', (array)$GLOBALS['fields']) && $aa['menu'] = $arItem['DISPLAY_PROPERTIES']['simple_pages__menu']['~VALUE'];
 in_array('MD', (array)$GLOBALS['fields']) && $aa['MD'] = $pageProperties['ELEMENT_META_DESCRIPTION'];
 in_array('MK', (array)$GLOBALS['fields']) && $aa['MK'] = $pageProperties['ELEMENT_META_KEYWORDS'];
 //'operating company' => $aOperatingCompanies,
 //'housing complex' => $aHousingComplexes,
 //'house' => $aHouses
 #
 $a[] = $aa;
}

//die('<pre>' . print_r($a, true) . '</pre>');
exit( json_encode($a, JSON_UNESCAPED_UNICODE) );
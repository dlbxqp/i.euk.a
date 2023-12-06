<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('<pre>' . print_r($arResult, true) . '</pre>');

$a = [];
foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), ['CONFIRM'=>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);

 //die( json_encode($GLOBALS['fields'], JSON_UNESCAPED_UNICODE) );
 $aa = [];
 in_array('id', (array)$GLOBALS['fields']) && $aa['id'] = $arItem['ID'];
 in_array('code', (array)$GLOBALS['fields']) && $aa['code'] = $arItem['~CODE'];
 in_array('title', (array)$GLOBALS['fields']) && $aa['title'] = $arItem['~NAME'];
 #
 $a[] = $aa;
}

exit( json_encode($a, JSON_UNESCAPED_UNICODE) );
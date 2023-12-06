<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die( json_encode($arResult['ITEMS'], JSON_UNESCAPED_UNICODE) );

if(count($arResult['ITEMS']) > 0){
 $aOperatingCompanyMenu = [
  5 => [
   'order' => 1,
   'urn' => 'answers',
   'title' => 'Вопросы и ответы'
  ],
  6 => [
   'order' => 2,
   'urn' => 'faq',
   'title' => 'Важно знать'
  ],
  7 => [
   'order' => 3,
   'urn' => 'docs',
   'title' => 'Раскрытие информации'
  ],
  8 => [
   'order' => 4,
   'urn' => 'news',
   'title' => 'Новости'
  ]
 ];

/*
 if($arResult['~ID'] == 6){
  die( json_encode($arResult['ITEMS'], JSON_UNESCAPED_UNICODE) );
 }
*/

 $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['menu'][] = [
  'order' => $aOperatingCompanyMenu[ $arResult['~ID'] ]['order'],
  'title' => $aOperatingCompanyMenu[ $arResult['~ID'] ]['title'],
  'urn' => $aOperatingCompanyMenu[ $arResult['~ID'] ]['urn'],
  'code' => $arResult['~CODE']
 ];
}
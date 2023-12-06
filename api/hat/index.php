<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');


$GLOBALS['currentOperatingCompanyId'] = NULL;
$GLOBALS['aCurrentHousingComplexes'] = [];
$GLOBALS['aCurrentHouses'] = [];
$GLOBALS['aResult'] = [];


#< operating company
$APPLICATION->IncludeComponent(
 'bitrix:news.list',
 'hat__operating_company',
 [
  'ACTIVE_DATE_FORMAT' => 'Y-m-d',
  'ADD_SECTIONS_CHAIN' => 'N',
  'AJAX_MODE' => 'N',
  'AJAX_OPTION_ADDITIONAL' => '',
  'AJAX_OPTION_HISTORY' => 'N',
  'AJAX_OPTION_JUMP' => 'N',
  'AJAX_OPTION_STYLE' => 'N',
  'CACHE_FILTER' => 'N',
  'CACHE_GROUPS' => 'N',
  'CACHE_TIME' => 36000000,
  'CACHE_TYPE' => 'A',
  'CHECK_DATES' => 'Y',
  'DETAIL_URL' => '',
  'DISPLAY_BOTTOM_PAGER' => 'N',
  'DISPLAY_DATE' => 'N',
  'DISPLAY_NAME' => 'Y',
  'DISPLAY_PICTURE' => 'Y',
  'DISPLAY_PREVIEW_TEXT' => 'Y',
  'DISPLAY_TOP_PAGER' => 'N',
  'FIELD_CODE' => [
   0 => ''
  ],
  'FILTER_NAME' => '',
  'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
  'IBLOCK_ID' => 2,
  'IBLOCK_TYPE' => 'rest_entity',
  'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
  'INCLUDE_SUBSECTIONS' => 'N',
  'MESSAGE_404' => '',
  'NEWS_COUNT' => 999999,
  'PAGER_BASE_LINK_ENABLE' => 'N',
  'PAGER_DESC_NUMBERING' => 'N',
  'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
  'PAGER_SHOW_ALL' => 'N',
  'PAGER_SHOW_ALWAYS' => 'N',
  'PAGER_TEMPLATE' => '.default',
  'PAGER_TITLE' => 'Управляющая компания',
  'PARENT_SECTION' => '',
  'PARENT_SECTION_CODE' => '',
  'PREVIEW_TRUNCATE_LEN' => '',
  'PROPERTY_CODE' => [
   'operating_company__type',
   'operating_company__consent'
  ],
  'SET_BROWSER_TITLE' => 'N',
  'SET_LAST_MODIFIED' => 'N',
  'SET_META_DESCRIPTION' => 'N',
  'SET_META_KEYWORDS' => 'N',
  'SET_STATUS_404' => 'N',
  'SET_TITLE' => 'N',
  'SHOW_404' => 'N',
  'SORT_BY1' => 'SORT',
  'SORT_BY2' => 'ACTIVE_FROM',
  'SORT_ORDER1' => 'ASC',
  'SORT_ORDER2' => 'DESC',
  'STRICT_SECTION_CHECK' => 'N',
  'COMPONENT_TEMPLATE' => '.default'
 ],
 false
);
//die(json_encode($GLOBALS['currentOperatingCompanyId'], JSON_UNESCAPED_UNICODE));
if($GLOBALS['currentOperatingCompanyId'] === NULL){
 exit( http_response_code( 418 ) );
}
#> operating company

#< housing complexes
$GLOBALS['arrFilter'] = [ 'PROPERTY_housing_complexes__operating_company' => [ $GLOBALS['currentOperatingCompanyId'] ] ];
$APPLICATION->IncludeComponent(
 'bitrix:news.list',
 'hat__housing_complexes',
 [
  'ACTIVE_DATE_FORMAT' => 'Y-m-d',
  'ADD_SECTIONS_CHAIN' => 'N',
  'AJAX_MODE' => 'N',
  'AJAX_OPTION_ADDITIONAL' => '',
  'AJAX_OPTION_HISTORY' => 'N',
  'AJAX_OPTION_JUMP' => 'N',
  'AJAX_OPTION_STYLE' => 'N',
  'CACHE_FILTER' => 'N',
  'CACHE_GROUPS' => 'N',
  'CACHE_TIME' => 36000000,
  'CACHE_TYPE' => 'A',
  'CHECK_DATES' => 'Y',
  'DETAIL_URL' => '',
  'DISPLAY_BOTTOM_PAGER' => 'N',
  'DISPLAY_DATE' => 'N',
  'DISPLAY_NAME' => 'Y',
  'DISPLAY_PICTURE' => 'Y',
  'DISPLAY_PREVIEW_TEXT' => 'Y',
  'DISPLAY_TOP_PAGER' => 'N',
  'FIELD_CODE' => [
   0 => ''
  ],
  'FILTER_NAME' => 'arrFilter',
  'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
  'IBLOCK_ID' => 3,
  'IBLOCK_TYPE' => 'rest_entity',
  'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
  'INCLUDE_SUBSECTIONS' => 'N',
  'MESSAGE_404' => '',
  'NEWS_COUNT' => 999999,
  'PAGER_BASE_LINK_ENABLE' => 'N',
  'PAGER_DESC_NUMBERING' => 'N',
  'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
  'PAGER_SHOW_ALL' => 'N',
  'PAGER_SHOW_ALWAYS' => 'N',
  'PAGER_TEMPLATE' => '.default',
  'PAGER_TITLE' => 'Жилые комплексы управляющей компании',
  'PARENT_SECTION' => '',
  'PARENT_SECTION_CODE' => '',
  'PREVIEW_TRUNCATE_LEN' => '',
  'PROPERTY_CODE' => [
   'housing_complexes__operating_company',
   'housing_complexes__images'
  ],
  'SET_BROWSER_TITLE' => 'N',
  'SET_LAST_MODIFIED' => 'N',
  'SET_META_DESCRIPTION' => 'N',
  'SET_META_KEYWORDS' => 'N',
  'SET_STATUS_404' => 'N',
  'SET_TITLE' => 'N',
  'SHOW_404' => 'N',
  'SORT_BY1' => 'NAME',
  'SORT_BY2' => 'ORDER',
  'SORT_ORDER1' => 'ASC',
  'SORT_ORDER2' => 'ASC',
  'STRICT_SECTION_CHECK' => 'N',
  'COMPONENT_TEMPLATE' => '.default'
 ],
 false
);
//die(json_encode($GLOBALS['aCurrentHousingComplexes'], JSON_UNESCAPED_UNICODE));
#> housing complexes

#< houses (нужно для данных из transfer)
$GLOBALS['arrFilter'] = ['PROPERTY_houses__housing_complex' => ((count($GLOBALS['aCurrentHousingComplexes']) > 0) ? $GLOBALS['aCurrentHousingComplexes'] : [0]) ];
$APPLICATION->IncludeComponent(
 'bitrix:news.list',
 'hat__houses',
 [
  'ACTIVE_DATE_FORMAT' => 'Y-m-d',
  'ADD_SECTIONS_CHAIN' => 'N',
  'AJAX_MODE' => 'N',
  'AJAX_OPTION_ADDITIONAL' => '',
  'AJAX_OPTION_HISTORY' => 'N',
  'AJAX_OPTION_JUMP' => 'N',
  'AJAX_OPTION_STYLE' => 'N',
  'CACHE_FILTER' => 'N',
  'CACHE_GROUPS' => 'N',
  'CACHE_TIME' => 36000000,
  'CACHE_TYPE' => 'A',
  'CHECK_DATES' => 'Y',
  'DETAIL_URL' => '',
  'DISPLAY_BOTTOM_PAGER' => 'N',
  'DISPLAY_DATE' => 'N',
  'DISPLAY_NAME' => 'Y',
  'DISPLAY_PICTURE' => 'Y',
  'DISPLAY_PREVIEW_TEXT' => 'Y',
  'DISPLAY_TOP_PAGER' => 'N',
  'FIELD_CODE' => [
   0 => ''
  ],
  'FILTER_NAME' => 'arrFilter',
  'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
  'IBLOCK_ID' => 4,
  'IBLOCK_TYPE' => 'rest_entity',
  'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
  'INCLUDE_SUBSECTIONS' => 'N',
  'MESSAGE_404' => '',
  'NEWS_COUNT' => 999999,
  'PAGER_BASE_LINK_ENABLE' => 'N',
  'PAGER_DESC_NUMBERING' => 'N',
  'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
  'PAGER_SHOW_ALL' => 'N',
  'PAGER_SHOW_ALWAYS' => 'N',
  'PAGER_TEMPLATE' => '.default',
  'PAGER_TITLE' => 'Дома жилых комплексов управляющей компании',
  'PARENT_SECTION' => '',
  'PARENT_SECTION_CODE' => '',
  'PREVIEW_TRUNCATE_LEN' => '',
  'PROPERTY_CODE' => [
   0 => 'houses__housing_complex'
  ],
  'SET_BROWSER_TITLE' => 'N',
  'SET_LAST_MODIFIED' => 'N',
  'SET_META_DESCRIPTION' => 'N',
  'SET_META_KEYWORDS' => 'N',
  'SET_STATUS_404' => 'N',
  'SET_TITLE' => 'N',
  'SHOW_404' => 'N',
  'SORT_BY1' => 'NAME',
  'SORT_BY2' => 'SORT',
  'SORT_ORDER1' => 'ASC',
  'SORT_ORDER2' => 'ASC',
  'STRICT_SECTION_CHECK' => 'N',
  'COMPONENT_TEMPLATE' => '.default'
 ],
 false
);
//die(json_encode($GLOBALS['aCurrentHouses'], JSON_UNESCAPED_UNICODE));
#> houses

#< simple pages
$GLOBALS['arrFilter'] = [
 'PROPERTY_simple_pages__menu_VALUE' => 'Да',
 //'PROPERTY_simple_pages__operating_company' => (array)$GLOBALS['currentOperatingCompanyId'],
 //'PROPERTY_simple_pages__housing_complex' => (array)$GLOBALS['aCurrentHousingComplexes']
];
$APPLICATION->IncludeComponent(
 'bitrix:news.list',
 'hat__simple_pages',
 [
  'ACTIVE_DATE_FORMAT' => 'Y-m-d',
  'ADD_SECTIONS_CHAIN' => 'N',
  'AJAX_MODE' => 'N',
  'AJAX_OPTION_ADDITIONAL' => '',
  'AJAX_OPTION_HISTORY' => 'N',
  'AJAX_OPTION_JUMP' => 'N',
  'AJAX_OPTION_STYLE' => 'N',
  'CACHE_FILTER' => 'N',
  'CACHE_GROUPS' => 'N',
  'CACHE_TIME' => 36000000,
  'CACHE_TYPE' => 'A',
  'CHECK_DATES' => 'Y',
  'DETAIL_URL' => '',
  'DISPLAY_BOTTOM_PAGER' => 'N',
  'DISPLAY_DATE' => 'N',
  'DISPLAY_NAME' => 'Y',
  'DISPLAY_PICTURE' => 'Y',
  'DISPLAY_PREVIEW_TEXT' => 'Y',
  'DISPLAY_TOP_PAGER' => 'N',
  'FIELD_CODE' => [
   0 => '',
  ],
  'FILTER_NAME' => 'arrFilter',
  'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
  'IBLOCK_ID' => 1,
  'IBLOCK_TYPE' => 'rest_entity',
  'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
  'INCLUDE_SUBSECTIONS' => 'N',
  'MESSAGE_404' => '',
  'NEWS_COUNT' => 9999,
  'PAGER_BASE_LINK_ENABLE' => 'N',
  'PAGER_DESC_NUMBERING' => 'N',
  'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
  'PAGER_SHOW_ALL' => 'N',
  'PAGER_SHOW_ALWAYS' => 'N',
  'PAGER_TEMPLATE' => '.default',
  'PAGER_TITLE' => 'Простые страницы',
  'PARENT_SECTION' => '',
  'PARENT_SECTION_CODE' => '',
  'PREVIEW_TRUNCATE_LEN' => '',
  'PROPERTY_CODE' => [
   'simple_pages__menu',
   'simple_pages__operating_companies',
   'simple_pages__housing_complexes'
  ],
  'SET_BROWSER_TITLE' => 'N',
  'SET_LAST_MODIFIED' => 'N',
  'SET_META_DESCRIPTION' => 'N',
  'SET_META_KEYWORDS' => 'N',
  'SET_STATUS_404' => 'N',
  'SET_TITLE' => 'N',
  'SHOW_404' => 'N',
  'SORT_BY1' => 'SORT',
  'SORT_BY2' => 'NAME',
  'SORT_ORDER1' => 'ASC',
  'SORT_ORDER2' => 'DESC',
  'STRICT_SECTION_CHECK' => 'N',
  'COMPONENT_TEMPLATE' => '.default'
 ],
 false
);
#> simple pages

#< operating company menu
$aOperatingCompanyMenu = [5, 6, 7, 8]; //IBLOCKS IDS
foreach($aOperatingCompanyMenu as $v){
 $GLOBALS['arrFilter'] = ['ACTIVE' => '']; //чтобы подтянуть transfer
 if($v == 5){
  $GLOBALS['arrFilter']['PROPERTY_answers__operating_company'] = $GLOBALS['currentOperatingCompanyId'];
 } else if($v == 6){
  $GLOBALS['arrFilter']['PROPERTY_important_to_know__operating_company'] = $GLOBALS['currentOperatingCompanyId'];
 } else if($v == 7){
  $GLOBALS['arrFilter']['PROPERTY_information_disclosure__operating_company'] = $GLOBALS['currentOperatingCompanyId'];
 } else{
  $GLOBALS['arrFilter']['PROPERTY_news__operating_companies'] = [ $GLOBALS['currentOperatingCompanyId'] ];
 }
 $APPLICATION->IncludeComponent(
  'bitrix:news.list',
  'hat__operating_company_menu',
  [
   'ACTIVE_DATE_FORMAT' => 'Y-m-d',
   'ADD_SECTIONS_CHAIN' => 'N',
   'AJAX_MODE' => 'N',
   'AJAX_OPTION_ADDITIONAL' => '',
   'AJAX_OPTION_HISTORY' => 'N',
   'AJAX_OPTION_JUMP' => 'N',
   'AJAX_OPTION_STYLE' => 'N',
   'CACHE_FILTER' => 'N',
   'CACHE_GROUPS' => 'N',
   'CACHE_TIME' => 36000000,
   'CACHE_TYPE' => 'A',
   'CHECK_DATES' => 'Y',
   'DETAIL_URL' => '',
   'DISPLAY_BOTTOM_PAGER' => 'N',
   'DISPLAY_DATE' => 'N',
   'DISPLAY_NAME' => 'Y',
   'DISPLAY_PICTURE' => 'Y',
   'DISPLAY_PREVIEW_TEXT' => 'Y',
   'DISPLAY_TOP_PAGER' => 'N',
   'FIELD_CODE' => [
    0 => ''
   ],
   'FILTER_NAME' => 'arrFilter',
   'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
   'IBLOCK_ID' => $v,
   'IBLOCK_TYPE' => 'rest_entity',
   'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
   'INCLUDE_SUBSECTIONS' => 'N',
   'MESSAGE_404' => '',
   'NEWS_COUNT' => 99,
   'PAGER_BASE_LINK_ENABLE' => 'N',
   'PAGER_DESC_NUMBERING' => 'N',
   'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
   'PAGER_SHOW_ALL' => 'N',
   'PAGER_SHOW_ALWAYS' => 'N',
   'PAGER_TEMPLATE' => '.default',
   'PAGER_TITLE' => 'Строки меню ук',
   'PARENT_SECTION' => '',
   'PARENT_SECTION_CODE' => '',
   'PREVIEW_TRUNCATE_LEN' => '',
   'PROPERTY_CODE' => [
    'answers__operating_company',
    'important_to_know__operating_company',
    'information_disclosure__operating_company',
    'news__operating_companies'
   ],
   'SET_BROWSER_TITLE' => 'N',
   'SET_LAST_MODIFIED' => 'N',
   'SET_META_DESCRIPTION' => 'N',
   'SET_META_KEYWORDS' => 'N',
   'SET_STATUS_404' => 'N',
   'SET_TITLE' => 'N',
   'SHOW_404' => 'N',
   'SORT_BY1' => 'SORT',
   'SORT_BY2' => 'ACTIVE_FROM',
   'SORT_ORDER1' => 'ASC',
   'SORT_ORDER2' => 'DESC',
   'STRICT_SECTION_CHECK' => 'N',
   'COMPONENT_TEMPLATE' => '.default'
  ],
  false
 );
}
#> operating company menu

#< houses complexes menus
$aHousesComplexesMenus = [
 10 => 'tariffs',
 11 => 'rso'
];
foreach($aHousesComplexesMenus as $k => $v){
 $GLOBALS['arrFilter'] = [
  'ACTIVE' => 'Y'
 ];
 $APPLICATION->IncludeComponent(
  'bitrix:news.list',
  "hat__{$v}",
  [
   'ACTIVE_DATE_FORMAT' => 'Ymd',
   'ADD_SECTIONS_CHAIN' => 'N',
   'AJAX_MODE' => 'N',
   'AJAX_OPTION_ADDITIONAL' => '',
   'AJAX_OPTION_HISTORY' => 'N',
   'AJAX_OPTION_JUMP' => 'N',
   'AJAX_OPTION_STYLE' => 'N',
   'CACHE_FILTER' => 'N',
   'CACHE_GROUPS' => 'N',
   'CACHE_TIME' => 36000000,
   'CACHE_TYPE' => 'A',
   'CHECK_DATES' => 'Y',
   'DETAIL_URL' => '',
   'DISPLAY_BOTTOM_PAGER' => 'N',
   'DISPLAY_DATE' => 'N',
   'DISPLAY_NAME' => 'Y',
   'DISPLAY_PICTURE' => 'Y',
   'DISPLAY_PREVIEW_TEXT' => 'Y',
   'DISPLAY_TOP_PAGER' => 'N',
   'FIELD_CODE' => [
    0 => ''
   ],
   'FILTER_NAME' => 'arrFilter',
   'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
   'IBLOCK_ID' => $k,
   'IBLOCK_TYPE' => 'rest_entity',
   'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
   'INCLUDE_SUBSECTIONS' => 'N',
   'MESSAGE_404' => '',
   'NEWS_COUNT' => 999999,
   'PAGER_BASE_LINK_ENABLE' => 'N',
   'PAGER_DESC_NUMBERING' => 'N',
   'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
   'PAGER_SHOW_ALL' => 'N',
   'PAGER_SHOW_ALWAYS' => 'N',
   'PAGER_TEMPLATE' => '.default',
   'PAGER_TITLE' => 'Строки меню жк',
   'PARENT_SECTION' => '',
   'PARENT_SECTION_CODE' => '',
   'PREVIEW_TRUNCATE_LEN' => '',
   'PROPERTY_CODE' => [
    "{$v}__houses",
    "tariffs__halfyear"
   ],
   'SET_BROWSER_TITLE' => 'N',
   'SET_LAST_MODIFIED' => 'N',
   'SET_META_DESCRIPTION' => 'N',
   'SET_META_KEYWORDS' => 'N',
   'SET_STATUS_404' => 'N',
   'SET_TITLE' => 'N',
   'SHOW_404' => 'N',
   'SORT_BY1' => 'SORT',
   'SORT_BY2' => 'NAME',
   'SORT_ORDER1' => 'ASC',
   'SORT_ORDER2' => 'ASC',
   'STRICT_SECTION_CHECK' => 'N',
   'COMPONENT_TEMPLATE' => '.default'
  ],
  false
 );
}
#> houses complexes menus

#< submenu
if( $_GET['section'] == 'information_disclosure' ){

  $GLOBALS['arrFilter'] = ['PROPERTY_information_disclosure__operating_company' => $_GET['operatingCompanyId']*1];
  $APPLICATION->IncludeComponent(
   'bitrix:news.list',
   'hat__information_disclosure',
   [
    'ACTIVE_DATE_FORMAT' => 'Y', #Y-m-d H:i:s
    'ADD_SECTIONS_CHAIN' => 'N',
    'AJAX_MODE' => 'N',
    'AJAX_OPTION_ADDITIONAL' => '',
    'AJAX_OPTION_HISTORY' => 'N',
    'AJAX_OPTION_JUMP' => 'N',
    'AJAX_OPTION_STYLE' => 'N',
    'CACHE_FILTER' => 'N',
    'CACHE_GROUPS' => 'N',
    'CACHE_TIME' => 36000000,
    'CACHE_TYPE' => 'A',
    'CHECK_DATES' => 'Y',
    'DETAIL_URL' => '',
    'DISPLAY_BOTTOM_PAGER' => 'N',
    'DISPLAY_DATE' => 'N',
    'DISPLAY_NAME' => 'Y',
    'DISPLAY_PICTURE' => 'Y',
    'DISPLAY_PREVIEW_TEXT' => 'Y',
    'DISPLAY_TOP_PAGER' => 'N',
    'FIELD_CODE' => [
     0 => '',
     1 => '',
    ],
    'FILTER_NAME' => 'arrFilter',
    'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
    'IBLOCK_ID' => 7,
    'IBLOCK_TYPE' => 'rest_entity',
    'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
    'INCLUDE_SUBSECTIONS' => 'N',
    'MESSAGE_404' => '',
    'NEWS_COUNT' => '',
    'PAGER_BASE_LINK_ENABLE' => 'N',
    'PAGER_DESC_NUMBERING' => 'N',
    'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
    'PAGER_SHOW_ALL' => 'N',
    'PAGER_SHOW_ALWAYS' => 'N',
    'PAGER_TEMPLATE' => '.default',
    'PAGER_TITLE' => 'Раскрытие информации',
    'PARENT_SECTION' => '',
    'PARENT_SECTION_CODE' => '',
    'PREVIEW_TRUNCATE_LEN' => '',
    'PROPERTY_CODE' => [
     'information_disclosure__operating_company',
     'information_disclosure__documents'
    ],
    'SET_BROWSER_TITLE' => 'N',
    'SET_LAST_MODIFIED' => 'N',
    'SET_META_DESCRIPTION' => 'N',
    'SET_META_KEYWORDS' => 'N',
    'SET_STATUS_404' => 'N',
    'SET_TITLE' => 'N',
    'SHOW_404' => 'N',
    'SORT_BY1' => 'NAME',
    'SORT_BY2' => 'ACTIVE_FROM',
    'SORT_ORDER1' => 'ASC',
    'SORT_ORDER2' => 'DESC',
    'STRICT_SECTION_CHECK' => 'N',
    'COMPONENT_TEMPLATE' => '.default'
   ],
   false
  );

}
#> submenu


exit( json_encode($GLOBALS['aResult'], JSON_UNESCAPED_UNICODE) );

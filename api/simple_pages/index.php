<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

//die( json_encode(['housingComplexId' => $_POST['housingComplexId']], JSON_UNESCAPED_UNICODE) );
if(isset($_POST['operatingCompanyId'])) {
 $GLOBALS['arrFilter'] = [
  'PROPERTY_simple_pages__operating_companies' => [ (int)$_POST['operatingCompanyId'] ]
 ];
} elseif(isset($_POST['housingComplexId'])){
 $GLOBALS['arrFilter'] = [
  'PROPERTY_simple_pages__housing_complexes' => [ (int)$_POST['housingComplexId'] ]
 ];
} elseif(isset($_POST['houseId'])){
 $GLOBALS['arrFilter'] = [
  'PROPERTY_simple_pages__houses' => [ (int)$_POST['houseId'] ]
 ];
} else{
 $GLOBALS['arrFilter'] = [];
}
#
if( isset($_POST['code']) ){
 $GLOBALS['arrFilter'] = array_merge($GLOBALS['arrFilter'], ['CODE' => $_POST['code']]);
}

(isset($_POST['fields']) and is_array($_POST['fields'])) && ($GLOBALS['fields'] = (array)$_POST['fields']);

$APPLICATION->IncludeComponent(
 'bitrix:news.list',
 'simple_pages',
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
   1 => '',
  ],
  'FILTER_NAME' => 'arrFilter',
  'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
  'IBLOCK_ID' => 1,
  'IBLOCK_TYPE' => 'rest_entity',
  'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
  'INCLUDE_SUBSECTIONS' => 'N',
  'MESSAGE_404' => '',
  'NEWS_COUNT' => 999,
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
   0 => '',
   1 => 'simple_pages__operating_companies',
   2 => 'simple_pages__housing_complexes',
   3 => 'simple_pages__houses',
   4 => 'simple_pages__menu'
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
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

//die( json_encode(['houseId' => $_POST['houseId']], JSON_UNESCAPED_UNICODE) );

$GLOBALS['arrFilter'] = [];
if( isset($_POST['houseId']) ){
 $GLOBALS['arrFilter'] = [
  'PROPERTY_tariffs__houses' => [ (int)$_POST['houseId'] ]
 ];
 if( isset($_POST['semester']) ){
  $GLOBALS['arrFilter']['PROPERTY_tariffs__halfyear'] = mb_strtolower($_POST['semester']);
 }
}

(isset($_POST['fields']) and is_array($_POST['fields'])) && ($GLOBALS['fields'] = (array)$_POST['fields']);
$APPLICATION->IncludeComponent(
 'bitrix:news.list',
 'tariffs',
 [
  'ACTIVE_DATE_FORMAT' => 'Y.m', #Y-m-d H:i:s
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
  'IBLOCK_ID' => 10,
  'IBLOCK_TYPE' => 'rest_entity',
  'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
  'INCLUDE_SUBSECTIONS' => 'N',
  'MESSAGE_404' => '',
  'NEWS_COUNT' => (isset($_POST['count']) && (int)$_POST['count'] > 0) ? $_POST['count'] : 999999,
  'PAGER_BASE_LINK_ENABLE' => 'N',
  'PAGER_DESC_NUMBERING' => 'N',
  'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
  'PAGER_SHOW_ALL' => 'N',
  'PAGER_SHOW_ALWAYS' => 'N',
  'PAGER_TEMPLATE' => '.default',
  'PAGER_TITLE' => 'Тарифы',
  'PARENT_SECTION' => '',
  'PARENT_SECTION_CODE' => '',
  'PREVIEW_TRUNCATE_LEN' => '',
  'PROPERTY_CODE' => [
   'tariffs__houses',
   'tariffs__halfyear'
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
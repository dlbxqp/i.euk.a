<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//die('<pre>' . print_r($arResult, true) . '</pre>');

isset($_GET['operatingCompanyId']) && ($operatingCompanyId = (int)$_GET['operatingCompanyId']);
$itemsCount = isset($_GET['count']) ? (int)$_GET['count'] : 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

#< new
foreach($arResult['ITEMS'] as $arItem){
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));


    #< images
    $aImages = [];
    $aA = $arItem['DISPLAY_PROPERTIES']['news__images']['FILE_VALUE'];
    $aImages_ = isset($aA['ID']) ? [0 => $aA] : $aA;
    unset($aA);
    #
    foreach($aImages_ as $v){ //die('<pre>' . print_r($v, true) . '</pre>');
        $aImages[] = $v['SRC'];
    }
    #> images

    #< documents
    $aDocuments = [];
    $aA = $arItem['DISPLAY_PROPERTIES']['news__documents']['FILE_VALUE'];
    $aDocuments_ = isset($aA['ID']) ? [0 => $aA] : $aA;
    unset($aA);
    #
    foreach($aDocuments_ as $v){ //die('<pre>' . print_r($v, true) . '</pre>');
        $aDocuments[] = [
            'file name' => pathinfo($v['ORIGINAL_NAME'], PATHINFO_FILENAME),
            'extension' => $ext = pathinfo($v['ORIGINAL_NAME'], PATHINFO_EXTENSION),
            'src' => $v['SRC']
        ];
    }
    #> documents


    $a[] = [
        'id' => $arItem['ID'],
        'date' => $arItem['ACTIVE_FROM'],
        'header' => $arItem['~NAME'],
        'text' => $arItem['~DETAIL_TEXT'],
        'images' => $aImages,
        'documents' => $aDocuments
    ];

    !isset($operatingCompanyId) && ($operatingCompanyId = (int)$arItem['DISPLAY_PROPERTIES']['news__operating_companies']['~VALUE']);
}

$all = count($arResult['ITEMS']);
#> new

#< old
$aTransfer = json_decode(file_get_contents("../../transfer/news/{$operatingCompanyId}/data.json"), true);
foreach($aTransfer as $v){
    $a[] = [
        'id' => $v['id'],
        'date' => $v['date'],
        'header' => $v['title'],
        'text' => str_replace('src="', 'src="//' . "{$_SERVER['HTTP_HOST']}/transfer/news/{$operatingCompanyId}/images/", $v['description']['full'])
    ];
}

$all += count($aTransfer);
#> old

$a = [
    'pages' => ceil($all / $itemsCount),
    'page' => $page,
    'items' => array_slice($a, ($itemsCount * ($page - 1)), $itemsCount)
];

//die('<pre>' . print_r($a, true) . '</pre>');
exit(json_encode($a, JSON_UNESCAPED_UNICODE));

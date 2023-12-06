<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);


//die(json_encode($arResult['ITEMS'], JSON_UNESCAPED_UNICODE));


//* < new
foreach($arResult['ITEMS'] as $arItem){
 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
 $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

 foreach($arItem['DISPLAY_PROPERTIES']['rso__houses']['LINK_ELEMENT_VALUE'] as $v){
  foreach($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'] as $kk => $vv){
   if(in_array($v['~ID'], $GLOBALS['aCurrentHouses'][ $vv['code'] ])){
    $menuItemKey = null;
    foreach($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][$kk]['menu'] as $kkk => $vvv){
     if($vvv['code'] == 'rso'){
      $menuItemKey = $kkk;

      break;
     }
    }
    if($menuItemKey === null){
     $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $kk ]['menu'][] = [
      'code' => 'rso',
      'title' => 'Прямые договоры с РСО'
     ];
     $menuItemKey = array_key_last($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $kk ]['menu']);
    }

    $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $kk ]['menu'][ $menuItemKey ]['menu'][ $v['~ID']] = [
     'title' => $v['NAME']
    ];
   }
  }
 }
}
// > new */

//* < old
//die(json_encode($GLOBALS['aCurrentHouses']));
foreach($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'] as $k => $v){
 foreach($v['houses'] as $kk => $vv){
  $path = "../../transfer/rso/data/{$kk}/data.json";
  if(!is_file($path)) continue;
  $aTransfer = json_decode(file_get_contents($path), true);
  isset($aTransfer['address']) && ($aTransfer = [$aTransfer]);

  $menuItemKey = null;
  foreach($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $k ]['menu'] as $kkk => $vvv){
   if($vvv['code'] == 'rso'){
    $menuItemKey = $kkk;

    break;
   }
  }
  if($menuItemKey === null){
   $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $k ]['menu'][] = [
    'code' => 'rso',
    'title' => 'Прямые договоры с РСО'
   ];
   $menuItemKey = array_key_last($GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $k ]['menu']);
  }

  foreach($aTransfer as $vvv){
   $GLOBALS['aResult'][ $GLOBALS['currentOperatingCompanyId'] ]['housing complexes'][ $k ]['menu'][ $menuItemKey ]['menu'][ $kk ] = [
    'title' => $vvv['address']
   ];
  }
 }
}
// > old */

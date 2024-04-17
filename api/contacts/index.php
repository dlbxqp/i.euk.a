<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

//die( json_encode(['GET' => $_GET], JSON_UNESCAPED_UNICODE) );

//(int)$_GET['operatingCompanyId']

$code = (string)$_GET['housingComplexCode'];

exit( file_get_contents("https://club.ingrad.ru/api/get_gk_contacts?code={$code}") );
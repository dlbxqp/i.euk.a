<?php
header_remove('Cache-Control');
header_remove('Content-Encoding');
header_remove('Expires');
header_remove('Pragma');
header_remove('P3p');
header_remove('Set-Cookie');
header_remove('X-Devsrv-Cms');
header_remove('X-Powered-Cms');
header_remove('X-Powered-By');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');
header('Content-Type: application/json; charset=utf-8');

($_SERVER['REQUEST_METHOD'] === 'POST') && ($_POST = json_decode( file_get_contents('php://input'), true ));
//die('<pre>' . print_r($_POST, true) . '</pre>');
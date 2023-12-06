<?php
header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');
#
header('Content-Type: application/json; charset=utf-8');

($_SERVER['REQUEST_METHOD'] === 'POST') && ($_POST = json_decode( file_get_contents('php://input'), true ));
//die('<pre>' . print_r($_POST, true) . '</pre>');
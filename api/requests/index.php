<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');


#< Security
function f($a){ //die('<pre>' . print_r($a, TRUE) . '</pre>');
 foreach($a AS $k => $v){
  $a[$k] = //htmlspecialchars(
   stripslashes(
    trim(
     rawurldecode($v)
    )
  );
 }

 return $a;
}
$_GET = f($_GET);
$_POST = f($_POST);
#> Security

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule('iblock');

$name = date('ymdHis');
$aResult = [
 'status' => false,
 'message' => 'Переменная result не переназначена'
];

//move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/upload/requests/' . $name)

$element = new CIBlockElement;
$aElement = [
 'ACTIVE' => 'Y',
 'NAME' => date('ymdHis'),
 'IBLOCK_SECTION_ID' => false,
 'IBLOCK_ID' => 9,
 'PROPERTY_VALUES' => [
  'appeals_name' => $_POST['n'],
  'appeals_tel' => $_POST['t'],
  'appeals_email' => $_POST['e'],
  'appeals_message' => $_POST['m'],
  'appeals_source' => $_SERVER['HTTP_REFERER']
 ]
];

if($PRODUCT_ID = $element->Add($aElement)){
 $aResult = [
  'status' => true,
  'message' => 'Заявка отправлена. Мы Вам перезвоним :)'//$PRODUCT_ID
 ];
}

/* < to e-mail * /
require $_SERVER['DOCUMENT_ROOT'] . '/local/includes/PHPMailerMaster/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/local/includes/PHPMailerMaster/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/local/includes/PHPMailerMaster/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
 //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
 $mail->isSMTP();
 $mail->CharSet = 'utf-8';
 $mail->Host = 'ssl://smtp.yandex.ru';
 $mail->SMTPAuth = true;
 $mail->SMTPOptions = [
  'ssl' => [
   'verify_peer' => false,
   'verify_peer_name' => false,
   'allow_self_signed' => true
  ]
 ];
 $mail->Username = 'wd.ingrad@yandex.ru';
 $mail->Password = 'cdsxZAQ1';
 $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
 $mail->Port = 465;

 //Recipients
 $mail->setFrom('wd.ingrad@yandex.ru', 'job.ingrad.ru');
 $mail->addReplyTo('guztv@ingrad.com', 'разработчик');
 //$mail->addAddress('guztv@ingrad.com');
 $mail->addAddress('rabota@ingrad.com');
 //$mail->addCC('cc@example.com');
 //$mail->addBCC('bcc@example.com');

 //Attachments
 if(isset($_FILES['resume'])){
  $mail -> addAttachment($_FILES['resume']['tmp_name'], $_FILES['resume']['name']);
 }

 //Content
 $mail->isHTML(true);
 $mail->Subject = 'Заявка с сайта ' . $_SERVER['HTTP_HOST'];
 $mail->Body = <<<HD
<p>Имя: <strong>{$_POST['fn']}</strong></p>
<p>Фамилия: <strong>{$_POST['ln']}</strong></p>
<p>Телефон: <strong>{$_POST['tel']}</strong></p>
<p>E-mail: <strong>{$_POST['eMail']}</strong></p>
<p>Послание: <strong>{$_POST['m']}</strong></p>
<p>Страница отправления: <a href="{$_POST['url']}" target="_blank">{$_POST['url']}</a></p>

HD;
 $mail->AltBody = <<<HD
Имя: {$_POST['fn']}
Фамилия: {$_POST['ln']}
Телефон: {$_POST['tel']}
E-mail: {$_POST['eMail']}
Послание: {$_POST['m']}
Страница отправления: {$_POST['url']}

HD;
 $mail->send();

 $aResult = [
  'status' => true,
  'message' => 'Заявка отправлена. Мы Вам перезвоним :)'
 ];
} catch(Exception $e){
 $aResult = [
  'status' => true,
  'message' => "Error: {$mail->ErrorInfo}"
 ];
}
/* > to e-mail */

exit( json_encode( $aResult ) );
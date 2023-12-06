<!DOCTYPE html>
<html lang='ru'>
 <head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
  <meta name='author' content='dlbxqp@gmail.com'>
  <meta name='theme-color' content='#FFC42C'>
  <meta name='publisher-URL' content='//job.ingrad.ru/'>

  <title><?$APPLICATION->ShowTitle()?></title>

  <link rel="shortcut icon" href="//ingrad.ru/favicon.ico">

<?php
$APPLICATION->SetAdditionalCSS('/local/styles/normalize.css');
$APPLICATION->SetAdditionalCSS('/local/styles/main.css');
$APPLICATION->SetAdditionalCSS('/local/templates/main/style.css');
?>

 <!--[if IE]>
  <script>
 document.createElement('figcaption')
 document.createElement('article')
 document.createElement('section')
 document.createElement('header')
 document.createElement('figure')
 document.createElement('footer')
 document.createElement('aside')
 document.createElement('main')
 document.createElement('menu')
 document.createElement('nav')
  </script>
 <![endif]-->

  <script src="//cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<?$APPLICATION->ShowHead()?>
 </head>

 <body>
<?$APPLICATION->ShowPanel()?>
  <main>
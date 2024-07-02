<?php
$aOC = [
  1 => 'Наш Дом',
  2 => 'Новое Медведково',
  3 => 'Новое Пушкино',
  4 => 'Уютный Город',
  5 => 'Атмосфера Уюта',
  7 => 'Жилые Кварталы',
  8 => 'Азбука Комфорта',
  133 => 'Кварта Хоум'
];
$dir = '../../../transfer/answers/';
$dirContents = scandir($dir);
$output = '';
foreach($dirContents as $v){
    if(!is_dir($dir . $v)) continue;

    $aTransfer = json_decode( file_get_contents("{$dir}{$v}/data.json"), true);
    foreach($aTransfer as $vv){
        $answer = str_replace('img src="', 'img src="//' . "{$_SERVER['HTTP_HOST']}/transfer/answers/{$v}/images/", $vv['answer']);
        $output .= <<<HD
<tr>
 <td>{$aOC[ $v ]}</td>
 <td>{$vv['question']}</td>
 <td>{$answer}</td>
</tr>

HD;
    }
}

echo <<<HD
<style>
*{
    box-sizing: border-box;
    margin: 0;
    padding: 0
}
html{
    width: 100vw
}
body{
    overflow-x: hidden;
    width: 100%
}
table{
    border-spacing: 0;
    width: 100%
}
td{
    border-top: 1px solid rgb(250, 200, 0);
    padding: 10px;
    vertical-align: top
}
td:nth-of-type(2){
    max-width: 240px
}
td:nth-of-type(3){
    max-width: 720px
}
</style>

<table>{$output}</table>

HD;
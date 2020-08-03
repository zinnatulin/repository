<!DOCTYPE html>
<html>
<head>
    <title>test</title>
    <meta charset="utf-8">
</head>
<body>
<?php
error_reporting(E_ALL);

function check_char($char){
    //$char = iconv(mb_detect_encoding($char), 'UTF-8', $char);
    if(($char >= 'А' && $char <= 'я') || $char == 'ё' || $char == 'Ё'){
        return true;
    }
}

$url = 'http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?wsdl';
$client = new SoapClient($url, array( "trace"=> 1, "exceptions" => 0));

$res = $client->EnumValutes();

$res = (array)$res;
$new_arr = [];
foreach ($res as $key=>$value){
    if(is_object($value)){
        $new_arr[$key] = (array)$value;
    }
    else{
        $new_arr[$key] = $value;
    }
}
$res_str = implode($new_arr['EnumValutesResult']);//получаем результирующую строку

//print_r($res_str);
//echo "<br/> regexp: ";
//$pattern = '/[А-Я][а-я]+\s[а-я]+/ui';////[а-я]+/ui'
//$matches = [];
//$rus_match_names = [];
//preg_match($pattern, $res_str, $matches);
//print_r($matches);

//$rus_match_names[] = $matches[0];

//цикл
$pattern = '/[А-Я][а-я]+\s[а-я]+/ui';////[а-я]+/ui'
$matches = [];
$rus_match_names = [];
while($match = preg_match($pattern, $res_str, $matches))
{
    $rus_match_names[] = $matches[0];
    $res_str = preg_replace("/$matches[0]/u", '', $res_str);
}
echo "<br/>массив названий: ";
print_r($rus_match_names);
/*$arrNames = [];
$tempChar = '';
for($i = 0; $i < strlen($res_str); $i++)
{
    if(check_char($res_str[$i])){
        $tempChar .= $res_str[$i];//iconv(mb_detect_encoding($res_str[$i]), 'UTF-8', $res_str[$i]);
    }
    else{
        if($tempChar != ''){
            $arrNames[] = $tempChar;
            $tempChar = '';
        }
    }
}*/
//print_r($arrNames);
/*foreach ($new_arr as $key=>$value){
    echo "пара значений $key - $value <br/>";
}*/?>
</body>
</html>







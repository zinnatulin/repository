<?php
$input = "{Пожалуйста,|Просто|Если сможете,} сделайте так, чтобы это {удивительное|крутое|простое|важное|бесполезное}
 тестовое предложение {изменялось {быстро|мгновенно|оперативно|правильно} случайным образом|менялось каждый раз}.";

function array_output($arr){
    foreach ($arr as $elem){
        if(is_array($elem)){
            array_output($elem);
        }
        else{
            echo($elem);
        }
    }
}

$arrWords = array();
$arrWord = '';
//$testArr = explode('{', $input);
//print_r($testArr);
$str = $input;
for($i = 0; $i < strlen($str); $i++){
    if($str[$i] == '{') {
        while ($str[$i + 1] != '}' && $str[$i + 1] != '{') {
            ++$i;
            if ($str[$i] != '|') {
                $arrWord .= $str[$i];
                //echo $str[$i];
            } elseif($str[$i] == '|') {
                $arrWords[] = $arrWord;
                //echo 'слово было добавлено в массив';
                echo $arrWord . ' ';
                $arrWord = '';
            }
        }
    }
}

/*
foreach($char in $input){
   if($char == '{'){
       while($charInWord !='|'){
           charInWordSum .+ $charInWord;
       }
   }
}
*/

?>

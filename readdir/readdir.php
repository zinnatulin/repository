<html>
<head>
    <title>Чтение директории</title>
</head>
<body>
<?php
    function arrCompare($a, $b){
        if($a == $b){
            return 0;
        }
        return ($a < $b) ? 1 : -1;
    }

    echo "чтение директории:<br/>";
    $dir = ".";
    $arrDate = [];
    $arrSize = [];
    $arrAll = [];
    if($handle = opendir($dir)){
        while($entry = readdir($handle)){
            $time = filemtime($entry);
            $size = filesize($entry) . "kB";
            $fileDate = date("d.m.y", $time);
            $fileSize = round($size / 1024, 2);
            $arrDate[$entry] = $fileDate;
            $arrSize[$entry] = $fileSize;
            $arrAll[] = array($entry, $fileDate, $fileSize);
            uasort($arrDate, "arrCompare");
            uasort($arrSize, "arrCompare");
        }
    }
    print_r($arrAll);
    /*foreach ($arrSize as $key => $value){
        echo "$key $value $arrDate[$key]<br/>";
    }*/
    //2 массива: 1 массив: [название => размер], 2 массив: [размер => дата]
    //сортирую 1 массив по размеру, затем сортирую второй массив по дате.
    //сформировать массив из 3 элементов, отсортировать массив по размеру, указать в функции
    //if $a == $b то сортировать по дате.
?>
</body>
</html>
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
    $arrDate = array();
    $arrSize = [];
    if($handle = opendir($dir)){
        while($entry = readdir($handle)){
            $time = filemtime($entry);
            $size = filesize($entry);
            $fileDate = date("d.m.y", $time);
            $fileSize = round($size / 1024, 2);
            $arrDate[$entry] = $fileDate;
            $arrSize[$entry] = "$fileSize kB";
            usort($arrDate, "arrCompare");
            usort($arrSize, "arrCompare");
        }
    }
    foreach ($arrDate as $key => $value){
        echo "$key $value $arrSize[$key]<br/>";
    }

?>
</body>
</html>
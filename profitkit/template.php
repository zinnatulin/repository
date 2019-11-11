<?php
require("./tree.php");
?>
<html>
    <head>
        <title>Тест</title>
    </head>
    <body>
    <?php print 'hello!';
    echo 'вывожу массив';
    sort($data, $data[0]['PARENT_ID']);
    ?><ul><?php
    foreach ($data as $arrItem){
        ?><li><?php echo $arrItem['NAME'];?></li><?php
    }
    ?>
    </ul>
    </body>
</html>

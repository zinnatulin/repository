<html>
<head>
    <title>Вывести интервалы бронирования</title>
</head>
<body>
<?php
    $dates = ['18.02.2020-23.02.2020', '29.02.2020-05.03.2020', '23.03.2020-17.04.2020', '19.04.2020-20.07.2020'];
    $arrData = [];
    $month = $arrData['month'];
    $days = $arrData['days'];
?>
<div class="intervals"></div>
Месяц <input type="text" name="month"><br/><br/>
Дни <input type="number" name="days"><br/><br/>
<input type="submit" name="send" value="Проверить">
</body>
</html>
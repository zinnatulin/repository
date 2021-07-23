<?php

 ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="label_form">Имя пользователя:</div>
<div class="input-group input-group-sm mb-3" style="width: 200px; left: 3px;">
    <input type="text" id="name" class="form-control"/>
</div>
<div class="label_form" style="left: 5px;">Логин</div>
<div class="input-group input-group-sm mb-3" style="width: 200px; left: 3px;">
    <input type="text" id="login" class="form-control"/>
</div>
<div class="input-group input-group-sm mb-3" style="width: 200px">
    <input type="submit" value="Отправить" onclick="getName()"/>
</div>
 <br/>
<?php
    $db = new SQLite3("db.db");
    $s = "select name, login from users;";
    $res = $db->query($s);
    $row = $res->fetchArray(SQLITE3_NUM);
    while($row){
        echo $row[0] . ' ' . $row[1]; ?><button style="height: 30px; width: 80px;" onclick="var name = '<?php echo $row[0];?>'; var login = '<?php echo $row[1]; ?>';delName(name, login);">Удалить</button><br><?php
        $row = $res->fetchArray(SQLITE3_NUM);
    }
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
    function getName(){
        name = $('#name').val();
        login = $('#login').val();
        $.ajax({
            method: 'POST',
            url: 'ajaxhandler.php',
            data: {name: name, login: login},
            success: function(e){
                location.reload();
            },
        });
    }
    
    function delName(name, login){
        name = name;
         $.ajax({
             method: 'POST',
             url: 'ajaxdelname.php',
             data: {name: name, login: login},
             success: function(){
                 location.reload();
             },
             error: function(e){
                 alert('error:' + e);
             },
         });
    }
</script>
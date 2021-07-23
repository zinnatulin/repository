<?php
    $name = $_POST['name'];
    $s = "delete from users where name = :name ";
    $db = new SQLite3("db.db");
    $res = $db->prepare($s);
    $res->bindValue(':name', $name);
    $res->execute();
?>
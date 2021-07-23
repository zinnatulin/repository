<?php

    $db = new SQLite3("db.db");
    $name = $_POST["name"];
    $login = $_POST["login"];
    $s = "insert into users(name, login) values (:name, :login)";
    $str = $db->prepare($s);
    $str->bindValue(':name', $name);
    $str->bindValue(':login', $login);
    $res = $str->execute();
?>
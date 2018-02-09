<?php
function getDB() {
    $db = mysqli_connect("localhost", "root", "", "web");
    if (mysqli_connect_errno()) {
        printf("Соединение не установлено: %s\n", mysqli_connect_error());
    }
    return $db;
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 09.02.2018
 * Time: 1:41
 */

require_once( "../_system/db.php" );

if (!empty($_POST))
{
    $str1 = str_split($_POST["str1"], 1);
    $str2 = str_split($_POST["str2"], 1);

    $status = false;
    foreach ($str1 as $symbol)
    {
        if ($status) break;
        else $status = (in_array($symbol, $str2));
    }

    $answer = (object) array();
    if ($status) {
        $answer->type = "error";
        $answer->message = "Символы встречаются!";
    } else {
        $answer->type = "success";
        $answer->message = "Символы не встречаются!";
    }

    die(json_encode($answer));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №1</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://ruseller.com/adds/adds2561/example/js/jquery.noty.js"></script>
    <link rel="stylesheet" type="text/css" href="https://ruseller.com/adds/adds2561/example/css/jquery.noty.css"/>
</head>
<body>
<form id="form" action="javascript:Check()">
    <div class="Line">
        <label for="str1">Первая строка: </label>
        <input name="str1" id="str1" type="text" placeholder="Введите строку">
    </div>
    <div class="Line">
        <label for="str2">Первая строка: </label>
        <input name="str2" id="str2" type="text" placeholder="Введите строку">
    </div>
    <div class="Line">
        <button type="submit">Проверить</button>
    </div>
</form>
</body>
</html>

<script type="text/javascript">
    var $ = jQuery;

    function Check() {
        var data = $("#form").serialize();
        $.ajax({
            type: 'POST',
            url: "/laba1",
            data: data,
            cache: false,
            async: false,
            dataType: "json",
            timeout: 15000,
            success: function (data) {
                noty({
                    theme: 'relax',
                    layout: 'bottom',
                    timeout: 1500,
                    type: data.type,
                    text: data.message
                });
            },
            error: function () {
                noty({
                    theme: 'relax',
                    layout: 'top',
                    timeout: 1500,
                    type: "bottom",
                    text: "Сервер не отвечает!"
                });
            }
        });
    }
</script>
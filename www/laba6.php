<?php
/**
 * Created by PhpStorm.
 * User: MISS_CEH4TOP
 * Date: 08.02.2018
 * Time: 22:51
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h3>Задача:</h3>
<span>Распечатать гласные латинские буквы, которые есть в заданной строке. </span>
<br>
<h3>Результат:</h3>
<form action="" method="post">
    <lebel for="text">Введите строку</lebel>
    <input id="text" type="text" name="text">
    <button type="submit">Проверить</button>
</form>
</body>
</html>
<?
$ABC = "e,y,u,o,a,i,E,Y,U,O,A,I";
$ABC = preg_split("/,/", $ABC);
$text = $_POST['text'];
if($text) {
    print_r("Ваша срока: $text <br>");
    $res = "";
    foreach ($ABC as $symbol)
        if(strpos($text,$symbol) !== false){
            $res .= $symbol;
        }
    if(!empty($res))
        print_r("Гласные латинские буквы: $res");
    else echo "Гласных латинских букв не найдено!";
}
?>

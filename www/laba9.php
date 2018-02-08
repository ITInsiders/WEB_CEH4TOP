<?php
/**
 * Created by PhpStorm.
 * User: MISS_CEH4TOP
 * Date: 09.02.2018
 * Time: 1:44

Написать запрос,
выполняющий вывод списка фамилий студентов,
имеющих только отличные оценки и проживающих в городе,
не совпадающем с городом их университета.

 */
$mysqli = mysqli_connect("localhost", "root", "", "university");
if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
}

$res = $mysqli->query("SELECT stud.SURNAME FROM student AS stud LEFT JOIN exam_marks AS em ON em.STUD_ID = stud.STUD_ID
LEFT JOIN university AS univ ON stud.UNIV_ID = univ.UNIV_ID
where em.MARK = 5 and stud.CITY <> univ.CITY;");
$students = array();
while ($row = $res->fetch_object()) $students[] = $row;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h3>Задача:</h3>
<span>Запрос, выполняющий вывод списка фамилий студентов, имеющих только отличные оценки и проживающих в городе,
    не совпадающем с городом их университета.</span>
<br>
<h3>Результат:</h3>
<?foreach ($students as $item)  { ?>
    <div ><?=$item->SURNAME;?></div>
<? } ?>
</body>
</html>
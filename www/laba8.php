<?php
/**
 * Created by PhpStorm.
 * User: MISS_CEH4TOP
 * Date: 09.02.2018
 * Time: 1:15
 */
$mysqli = mysqli_connect("localhost", "root", "", "university");
if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
}

$res = $mysqli->query("SELECT STUD_ID AS id, MAX(MARK) AS `max`, MIN(MARK) AS `min` FROM `exam_marks` GROUP BY STUD_ID;");
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
<span>Написать запрос, который по таблице EXAM_MARKS позволяет найти:
     а) максимальные и б) минимальные оценки каждого студента – и выводит их вместе с идентификатором студента.</span>
<br>
<h3>Результат:</h3>
<table>
    <thead>
    <tr>
        <th>Индентификатор</th>
        <th>Минимальная оценка</th>
        <th>Максимальная оценка</th>
    </tr>
    </thead>
    <tbody>
    <?foreach ($students as $student):?>
        <tr>
            <td><?=$student->id;?></td>
            <td><?=$student->min;?></td>
            <td><?=$student->max;?></td>
        </tr>
    <?endforeach;?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
    </tr>
    </tfoot>
</table>
</body>
</html>
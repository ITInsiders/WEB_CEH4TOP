<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 09.02.2018
 * Time: 1:41
 */

require_once( "../_system/db.php" );
$DB = getDB();

$QUERY = "SELECT `kurs`, `surname`, `name`, `stipend` FROM `students` ORDER BY kurs, stipend;";
$QUERY = $DB->query($QUERY);
$DATA = array();
while ($LINE = $QUERY->fetch_object()) $DATA[] = $LINE;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №3</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <td>Курс</td>
        <td>Фамилия</td>
        <td>Имя</td>
        <td>Стипендия</td>
    </tr>
    </thead>
    <tbody>
    <?foreach ($DATA as $DATUM):?>
    <tr>
        <td><?=$DATUM->kurs;?></td>
        <td><?=$DATUM->surname;?></td>
        <td><?=$DATUM->name;?></td>
        <td><?=$DATUM->stipend;?></td>
    </tr>
    <?endforeach;?>
    </tbody>
</table>
</body>
</html>
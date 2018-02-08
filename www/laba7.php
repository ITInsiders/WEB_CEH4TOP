<?php
/**
 * Created by PhpStorm.
 * User: MISS_CEH4TOP
 * Date: 08.02.2018
 * Time: 23:01
 */
$mysqli = mysqli_connect("localhost", "root", "", "university");
if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
}
$res = $mysqli->query("SELECT SURNAME, KURS FROM `student`;");
$surname = array();
$kurs = array();
while ($row = $res->fetch_object()) {
    $surname[] = $row->SURNAME;
    if(!in_array($row->KURS, $kurs)) $kurs[] = $row->KURS;
}
$res = $mysqli->query("SELECT SEMESTER FROM `subject`;");
$semester = array();
while ($row = $res->fetch_object()) {
    if(!in_array($row->SEMESTER, $semester)) $semester[] = $row->SEMESTER;
}
sort($surname);
sort($kurs);
sort($semester);

    $res = $mysqli->query("select em.MARK from exam_marks as em " .
        "left join subject as sub on em.SUBJ_ID = sub.SUBJ_ID " .
        "left join student as stud on stud.STUD_ID = em.STUD_ID " .
        "where em.MARK IS NOT NULL and stud.SURNAME = '".$_POST['fio']."' and stud.KURS = '".$_POST['kurs'].
        "' and sub.SEMESTER = '".$_POST['semester']."';");
    $mark = array();
    while ($row = $res->fetch_object()) { $mark[] = $row->MARK; }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h3>Задача:</h3>
<span>Создать форму, позволяющую выбрать оценку по номеру семестра, номеру группы и фамилии студента.</span>
<br>
<h3>Результат:</h3>
<form action="" method="post">
    <lebel for="fio">Выберите фамилию</lebel>
    <select id="fio" name="fio">
        <?foreach ($surname as $item)  { ?>
        <option val="<?=$item;?>" <?=($_POST['fio'] == $item)?"selected":"";?>><?=$item;?></option>
        <? } ?>
    </select>
    <br>
    <lebel for="kurs">Выберите курс</lebel>
    <select id="kurs" name="kurs">
        <?foreach ($kurs as $item)  { ?>
            <option val="<?=$item;?>" <?=($_POST['kurs'] == $item)?"selected":"";?>><?=$item;?></option>
        <? } ?>
    </select>
    <br>
    <lebel for="semester">Выберите семестр</lebel>
    <select id="semester" name="semester">
        <?foreach ($semester as $item)  { ?>
            <option val="<?=$item;?>" <?=($_POST['semester'] == $item)?"selected":"";?>><?=$item;?></option>
        <? } ?>
    </select>
    <br>
    <button type="submit">Проверить</button>
    <br>
    <?
    if(!empty($mark)) {?> Оценки: <? echo implode(", ", $mark); }
    elseif (!empty($_POST)) echo "Нет оценки для выбранного студента с выбранным курсом или семестром!";
    else echo "";
    ?>
</form>
</body>
</html>


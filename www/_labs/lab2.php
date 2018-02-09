<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 09.02.2018
 * Time: 1:41
 */

require_once( "../_system/db.php" );
$DB = getDB();

if (!empty($_POST))
{
    $ID = $_POST["lang"];
    $QUERY = "SELECT `name` FROM `languages` WHERE id = '$ID';";
    $QUERY = $DB->query($QUERY);
    $NAME = $QUERY->fetch_object()->name;

    $answer = (object) array();
    $answer->type = "success";
    $answer->message = "Язык: $NAME";
    $answer->name = $NAME;

    die(json_encode($answer));
}

$QUERY = "SELECT `name`, `language_id` FROM `countries`;";
$QUERY = $DB->query($QUERY);
$DATA = array();
while ($LINE = $QUERY->fetch_object()) $DATA[] = $LINE;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №2</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://ruseller.com/adds/adds2561/example/js/jquery.noty.js"></script>
    <link rel="stylesheet" type="text/css" href="https://ruseller.com/adds/adds2561/example/css/jquery.noty.css"/>
</head>
<body>
<label for="country">Страны: </label>
<select name="country" id="country">
    <?foreach ($DATA as $DATUM):?>
    <option value="<?=$DATUM->language_id;?>"><?=$DATUM->name;?></option>
    <?endforeach;?>
</select>
<label for="lang">Язык: </label>
<input id="lang" value="" readonly>
</body>
</html>

<script type="text/javascript">
    var $ = jQuery;

    $(function () {
        $("#country").change(function () {
            var data = {"lang": this.value};
            $.ajax({
                type: 'POST',
                url: "/laba2",
                data: data,
                cache: false,
                async: false,
                dataType: "json",
                timeout: 15000,
                success: function (data) {
                    $("#lang").val(data.name);
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
                        layout: 'bottom',
                        timeout: 1500,
                        type: "error",
                        text: "Сервер не отвечает!"
                    });
                }
            });
        });
    });
</script>
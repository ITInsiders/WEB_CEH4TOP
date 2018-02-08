<?
$s = file_get_contents("http://web.com/rus.json");
$s = json_decode($s);
$name = array();
foreach ($s->data as $k => $v) {
    if (stristr($v->name, ' г')) {
        $name[] = mb_strcut($v->name, 0, count($v->name) - 3);
    }
}

$mysqli = mysqli_connect("localhost", "root", "", "web");
if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
}


$queryCountry = "INSERT INTO `cities`(`name`, `country_id`) VALUES ";
foreach ($name as $v) {
    $queryCountry .= "('$v', '131'), ";
}
$queryCountry = mb_strcut($queryCountry, 0, count($queryCountry) - 3);
$queryCountry .= ";";
$res = $mysqli->query($queryCountry);
echo $res;
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

</body>
</html>
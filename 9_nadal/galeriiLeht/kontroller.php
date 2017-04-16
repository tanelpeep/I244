<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Praktikum  - Ülesanne</title>
    <link rel="stylesheet" type="text/css" href="kontrolleriga/multipage/style.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Tanel
 * Date: 16.04.2017
 * Time: 19:32
 */
include_once("kontrolleriga/multipage/head.html");

if (empty($_GET["page"])){
    $vaade = "";
}
else
{
    $vaade = $_GET["page"];
}

switch ($vaade){
    case 'pealeht': include_once("kontrolleriga/pealeht.php"); break;
    case 'galerii': include_once("kontrolleriga/galerii.php"); break;
    case 'vote': include_once("kontrolleriga/vote.php"); break;
    case 'tulemus': include_once("kontrolleriga/tulemus.php"); break;
    default: include_once("kontrolleriga/pealeht.php"); break;
}

include_once("kontrolleriga/multipage/foot.html");
?>
</body>
</html>

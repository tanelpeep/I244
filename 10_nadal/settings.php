<?php
session_start();

if (!isset($_SESSION["values"])){
    $_SESSION["values"] = array();
}

$text_bg="#FFFFFF";
if (isset($_POST['bg'])) {
    $text_bg = htmlspecialchars($_POST['bg']);
    $_SESSION["values"]["bg"] = htmlspecialchars($_POST['bg']);
}
if (isset($_SESSION["values"]["bg"]))
    $text_bg = $_SESSION["values"]["bg"];

$text_color="#FFFFFF";
if (isset($_POST['tc'])) {
    $text_color = htmlspecialchars($_POST['tc']);
    $_SESSION["values"]["tc"] = htmlspecialchars($_POST['tc']);
}
if (isset($_SESSION["values"]["tc"]))
    $text_color = $_SESSION["values"]["tc"];

$border_width =2;
if (isset($_POST['bw']) ){
    $border_width = htmlspecialchars($_POST['bw']);
$_SESSION["values"]["bw"] = htmlspecialchars($_POST['bw']);
}
if (isset($_SESSION["values"]["bw"]))
    $border_width = $_SESSION["values"]["bw"];

$border_style ="dashed";
if (isset($_POST['bs']) ){
    $border_style = htmlspecialchars($_POST['bs']);
    $_SESSION["values"]["bs"] = htmlspecialchars($_POST['bs']);
}
if (isset($_SESSION["values"]["bs"]))
    $border_style = $_SESSION["values"]["bs"];

$border_color ="#000000";
if (isset($_POST['bc']) ){
    $border_color = htmlspecialchars($_POST['bc']);
    $_SESSION["values"]["bc"] = htmlspecialchars($_POST['bc']);
}
if (isset($_SESSION["values"]["bc"]))
    $border_color = $_SESSION["values"]["bc"];

$border=$border_color." ".$border_style." ".$border_width;

$border_radius =10;
if (isset($_POST['br']) ){
    $border_radius = htmlspecialchars($_POST['br']);
    $_SESSION["values"]["br"] = htmlspecialchars($_POST['br']);
}
if (isset($_SESSION["values"]["br"]))
    $border_radius = $_SESSION["values"]["br"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Praktikum  - Ülesanne</title>

    <style type="text/css">

        #text { background: <?php echo $text_bg; ?>;
            color: <?php echo $text_color; ?>;
            border:  <?php echo $border; ?>px;
            border-radius: <?php echo $border_radius; ?>px;
            padding:10px;
            min-height:100px;
            max-width: 400px;
        }

    </style>

</head>
<body>

<?php

$stiilid=array("solid", "dashed", "dotted", "none", "double");

?>

<div id="text"> <?php if (isset($_POST['text'])) echo htmlspecialchars($_POST['text']); ?></div>

<hr/>
<form method="POST" action="?">
    <textarea name="text" placeholder="kommentaari tekst"></textarea>
    <br/>
    <input type="color" name="bg" id="bg" value="<?php echo $text_bg ?>">
    <label for="bg">Taustavärvus</label>
    <br/>
    <input type="color" name="tc" id="tc" value="<?php echo $text_color ?>">
    <label for="tc">Tekstivärvus</label>
    <br/>
    <fieldset>
        <legend>Piirjoon</legend>
        <input type="number" min="0" max="20" step="1" name="bw" id="bw" value="<?php echo $border_width ?>" >
        <label>Piirjoone laius (0-20px)</label>
        <br/>
        <select name="bs">
            <?php foreach($stiilid as $stiil):?>
                <option <?php if ($stiil == $border_style){echo 'selected';}?>><?php echo $stiil; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <input type="color" name="bc" id="bc" value="<?php echo $border_color ?>" >
        <label for="bc">Piirjoone värvus</label>
        <br/>
        <input type="number" min="0" max="100" step="1" name="br" id="br" value="<?php echo $border_radius ?>" >
        <label>Piirjoone nurga raadius (0-100px)</label>
        <br/>
    </fieldset>
    <input type="submit" value="esita" />
</form>

</body>
</html>
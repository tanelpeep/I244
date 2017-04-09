<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>8. nädal</title>

        <?php

        $bgcolorInput="#fff"; // vaikimisi valge
        $textInput="test";
        $colorInput="#000";
        $plaiusInput="8";
        $pstiilInput="double";
        $pvarvInput="#000";
        $praadiusInput="24";


        if (isset($_POST['bgcolorInput']) && $_POST['bgcolorInput']!="") {
            $bgcolorInput=htmlspecialchars($_POST['bgcolorInput']);
        }
        if (isset($_POST['textInput']) && $_POST['textInput']!="") {
            $textInput=htmlspecialchars($_POST['textInput']);
        }
        if (isset($_POST['colorInput']) && $_POST['colorInput']!="") {
            $colorInput=htmlspecialchars($_POST['colorInput']);
        }
        if (isset($_POST['plaiusInput']) && $_POST['plaiusInput']!="") {
            $plaiusInput=htmlspecialchars($_POST['plaiusInput']);
        }
        if (isset($_POST['pstiilInput']) && $_POST['pstiilInput']!="") {
            $pstiilInput=htmlspecialchars($_POST['pstiilInput']);
        }
        if (isset($_POST['pvarvInput']) && $_POST['pvarvInput']!="") {
            $pvarvInput=htmlspecialchars($_POST['pvarvInput']);
        }
        if (isset($_POST['praadiusInput']) && $_POST['praadiusInput']!="") {
            $praadiusInput=htmlspecialchars($_POST['praadiusInput']);
        }

        ?>

        <style>
            p {
                color: <?php echo $colorInput?>;
            }
            #content {
                border: <?php echo $praadiusInput;?>px <?php echo $pstiilInput;?> <?php echo $pvarvInput?>;
                border-radius: <?php echo $praadiusInput;?>px;
                background-color: <?php echo $bgcolorInput;?>;
            }
        </style>
    </head>
    <body>
        <div id="content">
            <p class="contentText"><?php echo "<p>".$textInput."</p>"; ?></p>
        </div>
        <div>
            <form action="index.php" method="post">
                <fieldset>
                    <textarea name="textInput" placeholder="Sisesta tekst.."></textarea>
                    <br>
                    <input type="color" name="bgcolorInput">
                    <label>Taustavärvus</label>
                    <br>
                    <input type="color" name="colorInput">
                    <label>Tekstivärvus</label>
                </fieldset>
                <fieldset>
                    <legend>Piirjoon</legend>
                    <input type="number" min="0" max="20" step="1" name="plaiusInput">
                    <label>Piirjoone laius (0-20px)</label>
                    <br>
                    <select name="pstiilInput">
                        <option>dashed</option>
                        <option>dotted</option>
                        <option>solid</option>
                        <option>double</option>
                    </select>
                    <br>
                    <input type="color" name="pvarvInput">
                    <label>Piirjoone värvus</label>
                    <br>
                    <input type="number" min="0" max="100" step="1" name="praadiusInput">
                    <label>Piirjoone nurga raadius (0-100px)</label>

                </fieldset>
                <button type="submit">Esita</button>
            </form>
        </div>
    </body>
</html>
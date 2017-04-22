<div id="wrap">
	<h3>Valiku tulemus</h3>
	<p>
        <?php

        if (!empty($_SESSION["voted_for"]))
        {
            echo "Oled juba hääle andnud. Hääletatud pilt: ".$_SESSION["voted_for"];
        }
        else
        {
            If( isset( $_POST["pilt"] ) ) {
                $_SESSION["voted_for"]=$_POST["pilt"];
                echo 'Valitud pilt: '.$_POST["pilt"];
            }
            else
            {
                echo 'Pilti ei ole valitud.';
            }
        }

        ?>
    </p>

</div>
<?php

?>
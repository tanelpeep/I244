<div id="wrap">
	<h3>Valiku tulemus</h3>
	<p>
        <?php
        If( isset( $_POST["pilt"] ) ) {
            echo 'Valitud pilt: '.$_POST["pilt"];
        }
        else
        {
            echo 'Pilti ei ole valitud.';
        }
        ?>
    </p>

</div>
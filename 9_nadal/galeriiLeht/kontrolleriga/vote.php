<div id="wrap">
	<h3>Vali oma lemmik :)</h3>
	<form action="?page=tulemus" method="POST">

        <?php
        $files = glob('kontrolleriga/multipage/pildid/*.{jpg,png}', GLOB_BRACE);
        $n = 1;
        foreach($files as $file) {
            echo '<p>'.PHP_EOL;
            echo '<label for="p'.$n.'">'.PHP_EOL;
            echo '<img src="'.$file.'" alt="nimetu '.$n.'" height="100" />'.PHP_EOL;
            echo '</label>'.PHP_EOL;
            echo '<input type="radio" value="'.$n.'" id="p'.$n.'" name="pilt"/>'.PHP_EOL;
            echo '</p>'.PHP_EOL;
            $n++;

        }
        ?>
		<br/>
		<input type="submit" value="Valin!"/>
	</form>

</div>
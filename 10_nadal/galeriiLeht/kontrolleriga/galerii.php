<div id="wrap">
	<h3>Fotod</h3>
	<div id="gallery">
    <?php
    $files = glob('kontrolleriga/multipage/pildid/*.{jpg,png}', GLOB_BRACE);
    $n = 1;
    foreach($files as $file) {
        echo '<img src="'.$file.'" alt="nimetu '.$n.'" />'.PHP_EOL;
        $n++;
    }
    ?>
	</div>
</div>
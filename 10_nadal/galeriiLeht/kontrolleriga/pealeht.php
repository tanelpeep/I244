<div id="wrap">
	<h3>Minu galerii</h3>
	<p>Tere tulemast minu galerii lehele. Siin saad näha minu katseid fotograafias ning nende hulgast oma lemmiku valida.</p>
	<p>Polegi vaja pikemalt sissejuhatust teha, soovin sulle meeldivat lehekülastust.</p>
    <?php
    if (isset($_POST["session_clean"]))
    {
        if ($_POST["session_clean"]== "true") {
            if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 42000, '/');
            }
            session_destroy();
        }
    }
    ?>

    <form <form action="?page=pealeht" method="POST">
        <input type="hidden" name="session_clean" value="true">
        <input type = "submit" value = "Lõpeta sessioon!" />
    </form>
</div>
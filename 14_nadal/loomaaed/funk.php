<?php


function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="Test12345";
	$db="loomad";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function logi(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (isset($_POST['user']) && isset($_POST['pass'])) {

            global $connection;

            $username = $_POST['user'];
            $password = $_POST['pass'];

            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);

            $sql = "SELECT * FROM tpeep_kylastajad where passw=SHA1('$password') AND username='$username'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_num_rows($result);

            if ($row == 1) {
                $_SESSION['user'] = $username;
                $_SESSION['roll'] = mysqli_fetch_assoc($result)['roll'];

                header("Location: loomaaed.php");
            } else {
                global $errors;
                $errors[] = "kasutajanimi või parool on vale!";
            }
        }

    }
	include_once('views/login.html');
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}

function kuva_puurid(){
    if (isset($_SESSION['user'])) {

        // siia on vaja funktsionaalsust
        global $connection;
        $puurid = array();
        $sql = "SELECT DISTINCT(puur) FROM tpeep_loomaaed";
        $result = mysqli_query($connection, $sql);
        while ($rida = mysqli_fetch_assoc($result)) {
            $puurid[] = $rida;
        }
        $loomad = array();
        foreach ($puurid as $id => $puur) {
            $sql2 = "SELECT id, nimi, puur, liik FROM tpeep_loomaaed WHERE puur=" . $puur['puur'];
            //echo $sql2;
            $result2 = mysqli_query($connection, $sql2);
            while ($rida2 = mysqli_fetch_assoc($result2)) {
                $loomad[$puur["puur"]][] = $rida2;
            }
        }


        include_once('views/puurid.html');
    }
    else{
        header("Location: loomaaed.php?page=login");
    }
	
}

function lisa(){
    global $errors;

    global $connection;
    if (isset($_SESSION['user']) && $_SESSION['roll'] == 'admin'){

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['nimi']) && isset($_POST['puur']) && $_FILES['liik']){

                $nimi = $_POST['nimi'];
                $puur = $_POST['puur'];

                //print_r($_FILES['liik']);
                if ($liik = upload("liik")){


                    $nimi = mysqli_real_escape_string($connection,$nimi);
                    $puur = mysqli_real_escape_string($connection,$puur);
                    $liik = mysqli_real_escape_string($connection,$liik);

                    $sql = "INSERT INTO tpeep_loomaaed (nimi, puur, liik) VALUES ('$nimi', '$puur', '$liik')";
                    $result = mysqli_query($connection, $sql);
                    echo mysqli_insert_id($connection);
                    if(mysqli_insert_id($connection)>0){
                        header("Location: loomaaed.php?page=loomad");
                    }
                    else{
                        $errors[] = "Looma lisamine ebaõnnestus";
                    }
                }
                else {
                    $errors[] = "Faili üleslaadimine ebaõnnestus";
                }

            }

        }

        include_once('views/loomavorm.html');
    }
    else
    {
        header("Location: loomaaed.php?page=loomad");
    }
}

function upload($name){

	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)

		&& ($_FILES[$name]["size"] < 1000000)
		&& in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
		if ($_FILES[$name]["error"] > 0) {
			$_SESSION['notices'][]= "Return Code: " . $_FILES[$name]["error"];
			return "";
		} else {
      // vigu ei ole
			if (file_exists("pildid/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
				$_SESSION['notices'][]= $_FILES[$name]["name"] . " juba eksisteerib. ";
				return "pildid/" .$_FILES[$name]["name"];
			} else {
        // kõik ok, aseta pilt
				move_uploaded_file($_FILES[$name]["tmp_name"], "pildid/" . $_FILES[$name]["name"]);
				return "pildid/" .$_FILES[$name]["name"];
			}
		}
	} else {
		return "";
	}
}
function hangi_loom($id)
{
    global $errors;
    global $connection;
    $id = mysqli_real_escape_string($connection,$id);
    $sql = 'SELECT * FROM `tpeep_loomaaed` WHERE id = '.$id;
    $result = mysqli_query($connection, $sql);
    if ($rida = mysqli_fetch_assoc($result)){
        return $rida;
    }
    else{
        header("Location: loomaaed.php?page=loomad");
    }
}
function muuda(){
    global $errors;

    global $connection;
    if (isset($_SESSION['user']) && $_SESSION['roll'] == 'admin'){

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['nimi']) && isset($_POST['puur']) && $_FILES['liik'] && isset($_POST['id'])){

                $nimi = $_POST['nimi'];
                $puur = $_POST['puur'];
                $id = $_POST['id'];

                //print_r($_FILES['liik']);
                if ($liik = upload("liik" )){


                    $nimi = mysqli_real_escape_string($connection,$nimi);
                    $puur = mysqli_real_escape_string($connection,$puur);
                    $liik = mysqli_real_escape_string($connection,$liik);
                    $id = mysqli_real_escape_string($connection,$id);

                    $sql = "UPDATE tpeep_loomaaed SET  nimi = '$nimi', puur = '$puur', liik = '$liik' WHERE id = '$id'";
                    if (mysqli_query($connection, $sql)) {
                        header("Location: loomaaed.php?page=loomad");
                    } else {
                        $errors[] = "Looma muutmine ebaõnnestus";
                    }
                }
                elseif (empty($_POST['liik'])){
                    $nimi = mysqli_real_escape_string($connection,$nimi);
                    $puur = mysqli_real_escape_string($connection,$puur);
                    $id = mysqli_real_escape_string($connection,$id);

                    $sql = "UPDATE tpeep_loomaaed SET  nimi = '$nimi', puur = '$puur' WHERE id = '$id'";
                    if (mysqli_query($connection, $sql)) {
                        header("Location: loomaaed.php?page=loomad");
                    } else {
                        $errors[] = "Looma muutmine ebaõnnestus";
                    }

                }
                else {
                    $errors[] = "Faili üleslaadimine ebaõnnestus";
                }

            }

        }

        include_once('views/editvorm.html');

    }
    else
    {
        //header("Location: loomaaed.php?page=loomad");
    }
}
?>
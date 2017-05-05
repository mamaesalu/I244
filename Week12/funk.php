<?php


function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="t3st3r123";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function logi(){
	// siia on vaja funktsionaalsust (13. nädalal)
    global $connection;
    global $errors;
    if (!empty($_SESSION['user'])){
        header("Location: ?page=loomad");
    }
    else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array();
            if (!empty($_POST['user'])) {

            } else $errors[] = "Sisestage kasutajanimi";
            if (!empty($_POST['pass'])) {

            } else $errors[] = "Sisestage parool";

            if (empty($errors)) {
                $kasutaja = mysqli_real_escape_string($connection, $_POST["user"]);
                $parool = mysqli_real_escape_string($connection, $_POST["pass"]);
                $sql = "SELECT id FROM maile_kylastajad WHERE username = '{$kasutaja}' and passw= SHA1('{$parool}')";
                $result = mysqli_query($connection, $sql) or die ("ei saa parooli ja kasutajat kontrollitud".mysqli_error($connection));
                $rida = mysqli_num_rows($result);
                print_r($rida);
                if ($rida) {
                    $_SESSION['user'] = $_POST['user'];
                    header("Location: ?page=loomad");
                } else {
                    header("Location: ?page=login");
                }
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
	// siia on vaja funktsionaalsust
    global $connection;
    if (empty($_SESSION['user'])) {
        header("Location: ?page=login");
    }
    $puurid = array();
    $sql = "SELECT DISTINCT(puur) AS puur FROM maile_loomaaed ORDER BY puur ASC";
    $puuride_nr = mysqli_query($connection, $sql) or die ("ei saanud puuride numbreid");
    while ($puuri_nr = mysqli_fetch_assoc($puuride_nr)){
        $sql = "SELECT * FROM maile_loomaaed WHERE puur =".mysqli_real_escape_string($connection, $puuri_nr['puur']);
        $loomad = mysqli_query($connection, $sql) or die ("ei saanud vastavaid loomi");
        while ($loomarida = mysqli_fetch_assoc($loomad)){
            $puurid[$puuri_nr['puur']][]=$loomarida;
        }
    }

	include_once('views/puurid.html');
}

function lisa(){
	// siia on vaja funktsionaalsust (13. nädalal)
    global $connection;
    global $errors;
    if (empty($_SESSION['user'])){
        header("Location: ?page=login");
    }
    else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array();
            if (!empty($_POST['nimi'])) {

            } else $errors[] = "Sisestage loomanimi";
            if (!empty($_POST['puur'])) {

            } else $errors[] = "Sisestage puur";
            if ($liik = upload('liik')) {

            } else $errors[] = "Lisage fail";
            if (empty($errors)) {
                $loomanimi = mysqli_real_escape_string($connection, $_POST["nimi"]);
                $puurinr = mysqli_real_escape_string($connection, $_POST["puur"]);
                $fail = mysqli_real_escape_string($connection, $liik);
                $sql = "INSERT INTO maile_loomaaed (nimi, puur, liik) VALUES ('{$loomanimi}','{$puurinr}', '{$fail}')";
                $result = mysqli_query($connection, $sql) or die ("ei saa looma lisatud".mysqli_error($connection));
                $rida = mysqli_insert_id($result);
                #print_r($rida);
                if ($rida) {
                    $_SESSION['user'] = $_POST['user'];
                    header("Location: ?page=loomad");
                } else {
                    header("Location: ?page=lisa");
                }
            }
        }
    }
	include_once('views/loomavorm.html');
	
}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)
		&& ($_FILES[$name]["size"] < 100000)
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

?>
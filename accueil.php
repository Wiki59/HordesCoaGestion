<?php
session_start();
$token = uniqid(rand(), true);
$_SESSION['token'] = $token;
$_SESSION['token_time'] = time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Content-Language" content="fr"/>
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" href="allumette.ico" />
        <title>
            Manager
        </title>
        <script type="text/javascript" src="jquery22.js"></script>
        <script type="text/javascript">
            code = "<?php echo $_GET["code"]; ?>";
        </script>
    </head>
    <body>
        <div id="entete">
		<label id="mainLabel">Wiki</label>
	        <input type="text" placeholder="Voir ville" id="showTown"/>
            <form id="formTown" action="newTown.php" method="POST">
                <input name="token" type="hidden" value="<?php echo $token; ?>"/>
                <input name="town" type="text" placeholder="Créer une ville"/>
                <input type="submit" value="Go"/>
            </form>
        </div>
        <div id="content">
        </div>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>

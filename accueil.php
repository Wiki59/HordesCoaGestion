<?php
session_start();
$token = uniqid(rand(), true);
$_SESSION['token'] = $token;
$_SESSION['token_time'] = time();
//include("info.php?state=Ok&code=" . $_GET["code"]);
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
            var code = "<?php echo $_GET["code"]; ?>";
        </script>
    </head>
    <body>
        <?php include './entete.php'; ?>
        <div id="result">
            <?php echo var_dump($_SESSION) ?>
        </div>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>

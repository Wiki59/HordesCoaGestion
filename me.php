<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <?php include './template/header.php'; ?>
    </head>
    <body>
        <?php include './template/entete.php'; ?>
        <div id="content">
            <?php
            if ($_SESSION["user"]["pseudo"] != null) {
                $user = $_SESSION["user"];
                echo "Pseudo : " . $user["pseudo"];
            } else {
                echo "Reconnectez vous";
            }
            ?>
        </div>
        <script type="text/javascript" src="script/searcher.js"></script>
        <script type="text/javascript" src="script/script.js"></script>
    </body>
</html>

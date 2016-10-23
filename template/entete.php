<?php
/*
 * Vue que l'entête doit être incluese dans toutes les pages, on peut généraliser la vérification d'authetification ici
 * Un système de token permettra de savoir si une requête effectué est bien envoyé par un utilisateur
 */
session_start();
$token = uniqid(rand(), true);
$_SESSION['token'] = $token;
// Un délai est fixé au token, la vérification se fait dans les pages de requêtes
$_SESSION['token_time'] = time();
?>
<div id="entete">
    <div id="userDiv">
	<a href="me.php" id="mainLabel"><?php echo $_SESSION["user"]["pseudo"]?></a>
	<script>var pseudo = "<?php echo $_SESSION["user"]["pseudo"]  ?>"</script>
    	<a id="recoLink" href="requete/logout.php"><img id="rope" src="../ressource/rope.png"/></a>
    </div>
    <input type="text" placeholder="Ville" id="showTown" class="searcher" plcHoldI="0"/>
    <form id="formTown" action="requete/newTown.php" method="POST">
        <input id="token" name="token" type="hidden" value="<?php echo $token; ?>"/>
        <input name="town" type="text" placeholder="Créer une ville"/>
        <input type="submit" value="Go"/>
    </form>
    <script type="text/javascript" src="script/searcher.js"></script>
</div>

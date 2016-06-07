<?php
session_start();
$token = uniqid(rand(), true);
$_SESSION['token'] = $token;
$_SESSION['token_time'] = time();
?>
<div id="entete">
    <div id="userDiv">
	<a href="me.php" id="mainLabel"><?php echo $_SESSION["user"]["pseudo"]  ?></a>
	<script>var pseudo = "<?php echo $_SESSION["user"]["pseudo"]  ?>"</script>
    	<a id="recoLink" href="requete/logout.php">Se reconnecter</a>
    </div>
    <input type="text" placeholder="Ville" id="showTown" class="searcher" plcHoldI="0"/>
    <form id="formTown" action="requete/newTown.php" method="POST">
        <input id="token" name="token" type="hidden" value="<?php echo $token; ?>"/>
        <input name="town" type="text" placeholder="Créer une ville"/>
        <input type="submit" value="Go"/>
    </form>
</div>

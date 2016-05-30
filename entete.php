<div id="entete">
    <div id="userDiv"><a href="/me.php" id="mainLabel">Deconnecté</a><a id="recoLink" href="logout.php">Se reconnecter</a></div>
    <input type="text" placeholder="Ville" id="showTown" class="searcher" plcHoldI="0"/>
    <form id="formTown" action="newTown.php" method="POST">
        <input id="token" name="token" type="hidden" value="<?php echo $token; ?>"/>
        <input name="town" type="text" placeholder="Créer une ville"/>
        <input type="submit" value="Go"/>
    </form>
</div>

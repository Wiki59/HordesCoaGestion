<div id="entete">
    <label id="mainLabel"></label>
    <input type="text" placeholder="Voir ville" id="showTown"/>
    <form id="formTown" action="newTown.php" method="POST">
        <input name="token" type="hidden" value="<?php echo $token; ?>"/>
        <input name="town" type="text" placeholder="Créer une ville"/>
        <input type="submit" value="Go"/>
    </form>
</div>

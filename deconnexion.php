<?php session_start();
include("include/connexion_sql.php");
include("include/fonctions.php");
include("include/fonctions-panier.php");

include("include/inscription.php");
include("include/connexion.php");

include("include/haut.php");

unset($_SESSION['panier']);
unset($_SESSION);
unset($_COOKIE);

session_destroy();
?>
        <div class="container-fluid">
		<div class="row-fluid">
			<div class="span10 offset1">
			
			<h2>Déconnexion</h2>
			
			<p>Déconnexion réussie.
			</p>

			</div>
<?php
include("include/bas.php");
?>			

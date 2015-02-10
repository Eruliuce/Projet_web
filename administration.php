<?php session_start();
include("include/connexion_sql.php");
include("include/fonctions.php");
include("include/fonctions-panier.php");

include("include/inscription.php");
include("include/connexion.php");

include("include/haut.php");
?>
        <div class="container-fluid">
		<div class="row-fluid">
			<div class="span10 offset1">
			<p>
		<?php
		if (!empty($_SESSION['login'])) {
        $resultat = mysqli_query($bdd, "SELECT BOOLADMIN FROM client WHERE LOGINCLIENT='".$_SESSION['login']."'") or die(mysqli_error($bdd));
        $verification = mysqli_fetch_assoc($resultat);
        if($verification['BOOLADMIN'] == 1) {
        ?>
        
        <legend>Administration du site</legend>

        <p>Options disponibles:
		
		<ul class="nav">
		<li><a href="envoyer_rubrique.php">Insertion d'une nouvelle rubrique</a></li>
		<li><a href="envoyer_produit.php">Insertion d'un nouveau produit</a></li>
		</ul>
        </p>
        <?php
          } 
      }

      else echo "Vous n'êtes pas autorisé à afficher cette page.";
        ?>
			</p>

			</div>
<?php
include("include/bas.php");
?>			

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
			<legend>Recherche avancée</legend>

<?php
if (isset($_GET['envoyer'])) {
	foreach($_GET['option'] as $option){
		 $optionrequete = "SELECT *
							FROM produit P, composition C
							WHERE
							P.NUMPRODUIT = C.NUMPRODUIT
							AND C.NUMOPTION ='".$option."'";
		 $option_exec = mysqli_query($bdd, $optionrequete) or die(mysqli_error($bdd));
		
	while ($ligne = mysqli_fetch_array($option_exec)) {
		?>
		    	<p>
    	<ul class="list-unstyled">
    	<li><a href="affiche_produit.php?nom=<?php echo $ligne['NOMPRODUIT']; ?>"><?php echo $ligne['NOMPRODUIT']; ?></a></li>
    	<li>Taille: <?php echo $ligne['TAILLEPRODUIT']; ?></li>
    	<li>Prix: <?php echo $ligne['PRIXPRODUIT']; ?> €</li>
    	</ul>
    	</p>
		<?php
	}
	}
}

 if(!isset($_GET['envoyer'])) {
 	?>
			<form class="form-horizontal" action="#" method="get">
          <fieldset>

          		<div class="form-group">
		  <label class="col-md-4 control-label" for="radios">Options</label>
		  </div>
			<?php

			$i = 1;
			$retour = mysqli_query($bdd, 'SELECT * FROM option ORDER BY NUMOPTION');
			while ($donnees = mysqli_fetch_array($retour))
			{
				if ($i < 10) {
			?>
					  <div class="col-md-4">
				<div class="radio">
			    <label for="radios">
			      <input type="checkbox" name="option[]" id="<?php echo $donnees['NUMOPTION']; ?>" value="<?php echo $donnees['NUMOPTION']; ?>">
			      <?php echo $donnees['NOMOPTION']; ?>
			    </label>
				</div>
				</div>
			<?php
				}
				else if ($i >= 10 && $i < 20) {
					?>
							  <div class="col-md-4">
				<div class="radio">
			    <label for="radios">
			      <input type="checkbox" name="option[]" id="<?php echo $donnees['NUMOPTION']; ?>" value="<?php echo $donnees['NUMOPTION']; ?>">
			      <?php echo $donnees['NOMOPTION']; ?>
			    </label>
				</div>
				</div>
					<?php
				}
				else {
					?>
							  <div class="col-md-4">
				<div class="radio">
			    <label for="radios">
			      <input type="checkbox" name="option[]" id="<?php echo $donnees['NUMOPTION']; ?>" value="<?php echo $donnees['NUMOPTION']; ?>">
			      <?php echo $donnees['NOMOPTION']; ?>
			    </label>
				</div>
				</div>
					<?php
				}
			$i = $i + 1;
			} // Fin de la boucle
			?>
          <br />
                    <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton">Valider le formulaire</label>
            <div class="col-md-4">
              <input type = "submit" value = "Envoyer" name="envoyer" id="envoyer" class="btn btn-primary" />
            </div>
          </div>


		</fieldset>
		</form>
          <?php } ?>

			</div>
<?php
include("include/bas.php");
?>			

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
            <p><?php
	if(isset($_GET['plombe'])) {
		
		$rubrique = "SELECT * FROM rubrique WHERE NOMRUBRIQUE='Carburant'";
		$rubrique_exec = mysqli_query($bdd, $rubrique) or die(mysqli_error($bdd));
		$rubrique_result = mysqli_fetch_assoc($rubrique_exec);

		$requete = "INSERT INTO produit (NUMRUBRIQUE, NUMPROMOTION, NOMPRODUIT, PRIXPRODUIT, URLPRODUIT, TAILLEPRODUIT, PLOMBE)
		 VALUES ('".$rubrique_result['NUMRUBRIQUE']."', 1, '".$_GET['nomproduit']."', '".$_GET['prixproduit']."',
		  '".$_GET['urlproduit']."', '".$_GET['tailleproduit']."', '".$_GET['plombe']."')";
		$requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
		if ($requete_exec === true) {
			echo "Le carburant de nom '".$_GET['nomproduit']."' a bien été entrée.";
		}
	}
	
	if(!empty($_GET['option'])) {
		$rubrique = "SELECT * FROM rubrique WHERE NOMRUBRIQUE='Avion'";
		$rubrique_exec = mysqli_query($bdd, $rubrique) or die(mysqli_error($bdd));
		$resultat_rubrique = mysqli_fetch_assoc($rubrique_exec);

		$requete = "INSERT INTO produit (NUMRUBRIQUE, NUMPROMOTION, NOMPRODUIT, PRIXPRODUIT, URLPRODUIT, TAILLEPRODUIT)
		 VALUES ('".$resultat_rubrique['NUMRUBRIQUE']."', 1, '".$_GET['nomproduit']."', '".$_GET['prixproduit']."',
		  '".$_GET['urlproduit']."', '".$_GET['tailleproduit']."')";
		$requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));

		$numpizza = "SELECT * FROM produit WHERE NOMPRODUIT='".$_GET['nomproduit']."'";
		$numpizza_exec = mysqli_query($bdd, $numpizza) or die(mysqli_error($bdd));
		$numpizza_result = mysqli_fetch_assoc($numpizza_exec);

		foreach($_GET['option'] as $check){
			echo $check;
		 $optionrequete = "INSERT INTO composition (NUMPRODUIT, NUMOPTION) VALUES 
		 ('".$numpizza_result['NUMPRODUIT']."', '".$check."' )";
		 $option_exec = mysqli_query($bdd, $optionrequete) or die(mysqli_error($bdd));
		}

		if ($requete_exec === true && $option_exec === true) {
			echo "L'avion de nom '".$_GET['nomproduit']."' a bien été entrée.";
		}
	}
	
	if(!empty($_GET['nomoption'])) {
		$requete = "INSERT INTO option (NOMOPTION, PRIXOPTION, QUANTITEOPTION) VALUES
		 ('".$_GET['nomoption']."', '".$_GET['prixoption']."', '".$_GET['quantiteoption']."')";
		$requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
		if ($requete_exec === true) {
			echo "L'option de nom '".$_GET['nomoption']."' a bien été entré.";
		}
	}
	
	
    $admin = "SELECT * FROM client WHERE LOGINCLIENT = '".$_SESSION['login']."'";  
    $req_exec = mysqli_query($bdd, $admin) or die(mysqli_error($bdd));
    
     // Création du tableau associatif du résultat
    $resultat = mysqli_fetch_assoc($req_exec); 

	if(!empty($_SESSION['login']) && $resultat['BOOLADMIN'] == 1)
	{


?>

	<form class="form-horizontal" action="entrer_produit.php" method="post">
	<fieldset>

	<!-- Form Name -->

	<!-- Select Multiple -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="selection">Selection du type de produit</label>
	  <div class="col-md-4">
	    <select id="selection" name="selection" class="form-control" multiple="multiple">
			<?php

			$i = 1;
			$retour = mysqli_query($bdd, 'SELECT * FROM rubrique ORDER BY NUMRUBRIQUE');
			while ($donnees = mysqli_fetch_array($retour))
			{
			?>
			<option value="<?php echo $donnees['NOMRUBRIQUE']; ?>"><?php echo $donnees['NOMRUBRIQUE']; ?></option>

			<?php
			$i = $i + 1;
			} // Fin de la boucle
			?>
			<option value="option">Option</option>
	    </select>
	   </div>
	</div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton">Valider le formulaire</label>
            <div class="col-md-4">
              <input type = "submit" value = "Envoyer" name="envoyer" id="envoyer" class="btn btn-primary" />
            </div>
          </div>
	</fieldset>
	</form>

<?php

}
else echo "Vous n'êtes pas inscrit ou vous n'avez pas accès.";
?>
</p>

			</div>
<?php
include("include/bas.php");
?>			

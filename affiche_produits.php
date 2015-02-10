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
	<?php
	  if(!empty($_GET['type'])) {
    
    if ($_GET['type'] == 'Avion') {

    $rubrique = "SELECT * FROM rubrique WHERE NOMRUBRIQUE = 'Avion'";
    $rubrique_exec = mysqli_query($bdd, $rubrique) or die(mysqli_error($bdd));
    $result = mysqli_fetch_assoc($rubrique_exec);

    $requete = "SELECT * FROM produit WHERE NUMRUBRIQUE='".$result['NUMRUBRIQUE']."' AND PERSO=0";
    $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
        ?>
        	<legend>Nos avions</legend>
    <?php
    while ($row = mysqli_fetch_assoc($requete_exec)) {	

    	?>
    	<p>
    	<ul class="nav">
    	<li><a href="affiche_produit.php?nom=<?php echo $row['NOMPRODUIT']; ?>"><?php echo $row['NOMPRODUIT']; ?></a></li>
		<li>
    <?php

        $option = "SELECT I.NOMOPTION FROM composition C, `option` I
        WHERE C.NUMPRODUIT='".$row['NUMPRODUIT']."' AND C.NUMOPTION = I.NUMOPTION";
        $option_exec = mysqli_query($bdd, $option) or die(mysqli_error($bdd));
        while ($ligne = mysqli_fetch_assoc($option_exec)) {
  			echo $ligne['NOMOPTION'];
  			echo " ";
		}
	?>
    	</li>
    	<li><?php echo $row['PRIXPRODUIT']; ?> €</li>
    	<li><a href="panier.php?action=ajout&amp;l=<?php echo $row['NUMPRODUIT']; ?>&amp;q=1&amp;p=<?php echo $row['PRIXPRODUIT']; ?>">Ajouter au panier</a>
</li>
    	</ul>
    	</p>
	<?php

  	}
  	}

  	if ($_GET['type'] == 'Carburant') {

    $rubrique = "SELECT * FROM rubrique WHERE NOMRUBRIQUE = 'Carburant'";
    $rubrique_exec = mysqli_query($bdd, $rubrique) or die(mysqli_error($bdd));
    $result = mysqli_fetch_assoc($rubrique_exec);

    $requete = "SELECT * FROM produit WHERE NUMRUBRIQUE='".$result['NUMRUBRIQUE']."'";
    $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
    ?>
        	<legend>Les carburants</legend>
    <?php
    while ($row = mysqli_fetch_assoc($requete_exec)) {	

    	?>

    	<p>
    	<ul class="list-unstyled">
    	<li><a href="affiche_produit.php?nom=<?php echo $row['NOMPRODUIT']; ?>"><?php echo $row['NOMPRODUIT']; ?></a></li>
    	<li>Taille: <?php echo $row['TAILLEPRODUIT']; ?> cl</li>
    	<li><?php if ($row['PLOMBE'] == 1) {
    		echo "Carburant plombé";
   		 	}
   		 	else echo "Carburant non plombé";
    		?></li>
    	</ul>
    	</p>
    <?php
  		}
  	}

}

else {
    $requete = "SELECT * FROM produit";
    $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
        ?>
        	<legend>Tous nos produits</legend>
    <?php
    while ($row = mysqli_fetch_assoc($requete_exec)) {	

    	?>
    	<p>
    	<ul class="list-unstyled">
    	<li><a href="affiche_produit.php?nom=<?php echo $row['NOMPRODUIT']; ?>"><?php echo $row['NOMPRODUIT']; ?></a></li>
    	<li>Taille: <?php echo $row['TAILLEPRODUIT']; ?></li>
    	<li>Prix: <?php echo $row['PRIXPRODUIT']; ?> €</li>
    	</ul>
    	</p>
    <?php
  		}
}
  

?>
			


			</div>
<?php
include("include/bas.php");
?>
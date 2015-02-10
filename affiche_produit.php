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
	  if(!empty($_GET['nom'])) {

    $rubrique = "SELECT * FROM rubrique R, produit P WHERE R.NUMRUBRIQUE = P.NUMRUBRIQUE
    AND NOMPRODUIT = '".$_GET['nom']."'";
    $rubrique_exec = mysqli_query($bdd, $rubrique) or die(mysqli_error($bdd));
    $result = mysqli_fetch_assoc($rubrique_exec);
    
    if ($result['NOMRUBRIQUE'] == 'Avion') {

    $requete = "SELECT * FROM produit WHERE NOMPRODUIT='".ucfirst(strtolower($_GET['nom']))."'";
    $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
    $row = mysqli_fetch_assoc($requete_exec) 

    	?>
    	<p>
    	<ul class="list-unstyled">
    	<li><h2><?php echo $row['NOMPRODUIT']; ?></h2></li>
        <li><img src="<?php echo $row['URLPRODUIT'] ?>" alt="Image du produit" class="img-responsive" style="margin: 0 auto; max-width: 50%; max-height:50%;" /></li>
        <li>
    <?php

        $option = "SELECT NOMOPTION FROM composition C, option I
        WHERE C.NUMPRODUIT='".$row['NUMPRODUIT']."' AND C.NUMOPTION = I.NUMOPTION";
        $option_exec = mysqli_query($bdd, $option) or die(mysqli_error($bdd));
        while ($ligne = mysqli_fetch_assoc($option_exec)) {
            echo $ligne['NOMOPTION'];
            echo " ";
        }
    ?>
        </li>
        <li>Prix: <?php echo $row['PRIXPRODUIT']; ?> €</li>
        <li>Taille: <?php echo $row['TAILLEPRODUIT']; ?></li>
        <li><a href="panier.php?action=ajout&amp;l=<?php echo $row['NUMPRODUIT']; ?>&amp;q=1&amp;p=<?php echo $row['PRIXPRODUIT']; ?>" onclick="window.open(this.href, '', 
'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;">Ajouter au panier</a>
</li>
    	</ul>
    	</p>
    <?php
  
  	}
  	
    if ($result['NOMRUBRIQUE'] == 'Carburant') {

    $requete = "SELECT * FROM produit WHERE NOMPRODUIT='".ucfirst(strtolower($_GET['nom']))."'";
    $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
    $row = mysqli_fetch_assoc($requete_exec) 

        ?>
        <p>
        <ul class="list-unstyled">
        <li><?php echo $row['NOMPRODUIT']; ?></li>
        <li><img src="<?php echo $row['URLPRODUIT'] ?>" alt="Image du produit" /></li>
        <li>Prix: <?php echo $row['PRIXPRODUIT']; ?> €</li>
        <li>Taille: <?php echo $row['TAILLEPRODUIT']; ?> cl</li>
        <li><?php if ($row['PLOMBE'] == 1) {
            echo "Carburant plombé";
            }
            else echo "Carburant non plombé";
            ?></li>
            <li><a href="panier.php?action=ajout&amp;l=NUMPRODUIT&amp;q=1&amp;p=PRIXPRODUIT" onclick="window.open(this.href, '', 
'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;">Ajouter au panier</a>
</li>
        </ul>
        </p>
    <?php

    }
  	

}

else {
    echo "Erreur. Aucun produit sélectionné/trouvé";
}
  

?>
			


			</div>
<?php
include("include/bas.php");
?>
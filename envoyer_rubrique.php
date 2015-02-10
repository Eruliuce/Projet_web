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
  if(!empty($_GET['nomrubrique'])) {
    
    $requete = "INSERT INTO rubrique (NOMRUBRIQUE)
     VALUES ('".$_GET['nomrubrique']."')";
    $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
    if ($requete_exec === true) {
      echo "La rubrique '".$_GET['nomrubrique']."' a bien été entrée.";
    }
  }

    $admin = "SELECT * FROM client WHERE LOGINCLIENT = '".$_SESSION['login']."'";  
    $req_exec = mysqli_query($bdd, $admin) or die(mysqli_error($bdd));
    
     // Création du tableau associatif du résultat
    $resultat = mysqli_fetch_assoc($req_exec); 

  if(!empty($_SESSION['login']) && $resultat['BOOLADMIN'] == 1)
  {


?>

        <form class="form-horizontal" action="envoyer_rubrique.php" method="get">
          <fieldset>
          <legend>Insertion d'une rubrique</legend>
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Nom de la rubrique</label>  
            <div class="col-md-4">
             <input class="form-control" type = "text" name = "nomrubrique" id = "nomrubrique" placeholder="Nom" />
            </div>
          </div>

                    <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton">Valider le formulaire</label>
            <div class="col-md-4">
              <input type = "submit" value = "Envoyer" name="valider" id="valider" class="btn btn-primary" />
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

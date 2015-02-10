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
$nbArticles=count($_SESSION['panier']['libelleProduit']);
if ($nbArticles == 0) {
   echo "Panier non créé! Vous n'avez aucune commande en cours!";
}

else if(!isset($_SESSION['login'])) {
   $requete = "SELECT MAX(NUMCLIENT) FROM client";
   $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
   $requete_result = mysqli_fetch_assoc($requete_exec);

   $i = $requete_result['MAX(NUMCLIENT)'];
   $i = $i + 1;

   $insert = "INSERT INTO client (NUMCLIENT) VALUES (".$i.")";
   $_SESSION['login'] = $i;

   ?>

<form class="form-horizontal" action="confir_commande.php" method="post">
          <fieldset>

          <!-- Form Name -->
          <legend>Validation de la commande</legend>
          <span class="help-block">Les informations que vous entrerez seront conservées dans la base de données. <br />
          Il vous sera proposé après la commande de supprimer ces informations ou de les conserver pour vous créer un compte client.</span>

          <p id = "message"><?php if(isset($message)) echo $message ?></p>


          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Nom de famille</label>  
            <div class="col-md-4">
             <input class="form-control" type = "text" name = "name" id = "name" placeholder="Nom de famille" />
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Prénom</label>  
            <div class="col-md-4">
             <input class="form-control" type = "text" name = "prenom" id = "prenom" placeholder="Prénom" />
            </div>
          </div>

          <!-- Textarea -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">Adresse</label>
            <div class="col-md-4">                     
              <textarea class="form-control" id="adresse" name="adresse"></textarea>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Carte bleue</label>  
            <div class="col-md-4">
             <input class="form-control" type = "number" name = "cartebleue" id = "cartebleue" placeholder="N° CB" />
            </div>  
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Code postal</label>  
            <div class="col-md-4">
             <input class="form-control" type = "number" name = "codepostal" id = "codepostal" placeholder="N° CP" />
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Téléphone</label>  
            <div class="col-md-4">
             <input class="form-control" type = "number" name = "telephone" id = "telephone" placeholder="Téléphone" />
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

<table class="table table-hover">

   <tr>
      <td>Libellé</td>
      <td>Nom produit</td>
      <td>Quantité</td>
      <td>Prix Unitaire</td>
   </tr>
   
<?php
      if (creationPanier())
      {  
         $_SESSION['panier']['verrou'] = true;

            for ($i=0 ;$i < $nbArticles ; $i++) {
             echo "<tr>";
               echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";

               $requete = "SELECT * FROM produit WHERE NUMPRODUIT=".$_SESSION['panier']['libelleProduit'][$i]."";
               $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
                $ligne = mysqli_fetch_assoc($requete_exec);
                echo "<td>".htmlspecialchars($ligne['NOMPRODUIT'])."</td>";

                echo "<td>".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."</td>";
               echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])." € </td>";
               echo "</tr>";
            
            }

            echo "</table>";

            echo "Total : ".MontantGlobal()." € pour ".$nbArticles." articles différents <br />";
         
      }

   }

else if(isset($_SESSION['login']) && !isset($_POST['adresse'])) {

      $requete = "SELECT * FROM client WHERE LOGINCLIENT='".$_SESSION['login']."'";
      $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
      $requete_result = mysqli_fetch_assoc($requete_exec);
   ?>
   <form class="form-horizontal" action="confir_commande.php" method="post">
          <fieldset>
          <legend>Validation de la commande</legend>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Nom de famille</label>  
            <div class="col-md-4">
             <input class="form-control" type = "text" name = "name" id = "name" value="<?php echo $requete_result['NOMCLIENT']; ?>" placeholder="Nom de famille" />
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Prénom</label>  
            <div class="col-md-4">
             <input class="form-control" type = "text" name = "prenom" id = "prenom" value="<?php echo $requete_result['PRENOMCLIENT']; ?>" placeholder="Prénom" />
            </div>
          </div>

          <!-- Textarea -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">Adresse</label>
            <div class="col-md-4">                     
              <textarea class="form-control" id="adresse" name="adresse"><?php echo $requete_result['ADRESSECLIENT']; ?></textarea>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Carte bleue</label>  
            <div class="col-md-4">
             <input class="form-control" type = "number" name = "cartebleue" id = "cartebleue" value="<?php echo $requete_result['CBCLIENT']; ?>" placeholder="N° CB" />
            </div>  
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Code postal</label>  
            <div class="col-md-4">
             <input class="form-control" type = "number" name = "codepostal" id = "codepostal" value="<?php echo $requete_result['CPCLIENT']; ?>" placeholder="N° CP" />
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Téléphone</label>  
            <div class="col-md-4">
             <input class="form-control" type = "number" name = "telephone" id = "telephone" value="<?php echo $requete_result['TELCLIENT']; ?>" placeholder="Téléphone" />
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

          <form method="post" action="panier.php" class="form-horizontal" role="form">

<table class="table table-hover">

   <tr>
      <td>Libellé</td>
      <td>Nom produit</td>
      <td>Quantité</td>
      <td>Prix Unitaire</td>
   </tr>
   
<?php
      if (creationPanier())
      {  
         $_SESSION['panier']['verrou'] = true;

            for ($i=0 ;$i < $nbArticles ; $i++) {
             echo "<tr>";
               echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";

               $requete = "SELECT * FROM produit WHERE NUMPRODUIT=".$_SESSION['panier']['libelleProduit'][$i]."";
               $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
                $ligne = mysqli_fetch_assoc($requete_exec);
                echo "<td>".htmlspecialchars($ligne['NOMPRODUIT'])."</td>";

                echo "<td>".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."</td>";
               echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])." € </td>";
               echo "</tr>";
            
            }

            echo "</table>";

            echo "Total : ".MontantGlobal()." € pour ".$nbArticles." articles différents <br />";
         
      }

   }
   ?>

</div>
			</div>
<?php
include("include/bas.php");
?>			

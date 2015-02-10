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
  if (isset($_POST['profil'])) {

      $update = mysqli_query($bdd, "UPDATE CLIENT SET NOMCLIENT='".$_POST['name']."',
       PRENOMCLIENT='".$_POST['prenom']."',
       ADRESSECLIENT='".$_POST['adresse']."',
       CBCLIENT = '".$_POST['cartebleue']."',
       CPCLIENT = '".$_POST['codepostal']."',
       TELCLIENT='".$_POST['telephone']."'
        WHERE LOGINCLIENT='".$_SESSION['login']."' ") or die(mysqli_error($bdd)); 

      echo "Modification terminée.";

  }


 if(isset($_SESSION['login'])) {
      $requete = "SELECT * FROM client WHERE LOGINCLIENT='".$_SESSION['login']."'";
      $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
      $requete_result = mysqli_fetch_assoc($requete_exec);
   ?>
   <form class="form-horizontal" action="#" method="post">
          <fieldset>
          <legend>Modifier son profil</legend>
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
              <input type = "submit" value = "Envoyer" name="profil" id="profil" class="btn btn-primary" />
            </div>
          </div>

          </fieldset>
          </form>
          <?php
        }
        ?>  


</div>
			</div>
<?php
include("include/bas.php");
?>			

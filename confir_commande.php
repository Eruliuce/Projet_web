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
if (isset($_POST['envoyer'])) {
  $pseudo = (isset($_POST['pseudo']) && trim($_POST['pseudo']) != '')? Verif_magicquotes($_POST['pseudo']) : null;
  $pass = (isset($_POST['pass']) && trim($_POST['pass']) != '')? Verif_magicquotes($_POST['pass']) : null;
  $pseudo = mysqli_real_escape_string($bdd, $pseudo);
  $pass = mysqli_real_escape_string($bdd, $pass);
  $pass = md5($pass);

   $requete = "INSERT INTO client(LOGINCLIENT, PASSCLIENT) VALUES ('".$pseudo."', '".$pass."')";
   $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
   $commande = mysqli_insert_id($bdd);

   echo "VOUS ETES INSCRITS.";
}


$nbArticles=count($_SESSION['panier']['libelleProduit']);
if ($nbArticles == 0) {
   echo "Panier non créé! Vous n'avez aucune commande en cours!";
}

else if(gettype($_SESSION['login']) == 'integer' && !isset($_POST['envoyer'])) {
      unset($_SESSION);
      unset($_COOKIE);

       $requete = "INSERT INTO commande(NUMCLIENT, NUMETAT, DATECOMMANDE) VALUES ('".$_SESSION['NUMCLIENT']."', 1, NOW())";
       $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd)); 
       $commande = mysqli_insert_id($bdd);

       foreach (array_combine($_SESSION['panier']['libelleProduit'], $_SESSION['panier']['qteProduit']) as $libelle => $quantite) {
          $requete = "INSERT INTO lignecommande(NUMPRODUIT, NUMCOMMANDE, QUANTITELC) VALUES ('".$libelle."', '".$commande."', '".$quantite."')";
          $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
       }

  echo "Commande payée: ".MontantGlobal()." € pour ".$nbArticles." articles différents <br />";

  unset($_SESSION['panier']);

   ?>

    <form class="form-horizontal" action="#" method="post">
          <fieldset>

          <!-- Form Name -->
          <legend>Validation de la commande</legend>
          <p>Voulez-vous vous inscrire pour obtenir diverses promotions, et ne plus avoir à retaper votre adresse à plusieurs reprises?</p>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Pseudonyme</label>  
            <div class="col-md-4">
            <input id="pseudo" name="pseudo" type="text" placeholder="Pseudonyme" class="form-control input-md">
            </div>
          </div>

          <!-- Password input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="passwordinput">Password</label>
            <div class="col-md-4">
              <input id="pass" name="pass" type="password" placeholder="Mot de passe" class="form-control input-md">
              <span class="help-block">Choississez correctement un mot de passe pour éviter de vous faire voler votre compte.</span>
            </div>
          </div>

                    <!-- Button -->
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

    else if(gettype($_SESSION['login']) != 'integer' && !isset($_POST['envoyer'])) {
       $login = "SELECT * FROM client WHERE LOGINCLIENT='".$_SESSION['login']."'";
       $login_exec = mysqli_query($bdd, $login) or die(mysqli_error($bdd));
       $login_ligne = mysqli_fetch_assoc($login_exec);

       $requete = "INSERT INTO commande(NUMCLIENT, NUMETAT, DATECOMMANDE) VALUES ('".$login_ligne['NUMCLIENT']."', 1, NOW())";
       $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd)); 
       $commande = mysqli_insert_id($bdd);

       foreach (array_combine($_SESSION['panier']['libelleProduit'], $_SESSION['panier']['qteProduit']) as $libelle => $quantite) {
          $requete = "INSERT INTO lignecommande(NUMPRODUIT, NUMCOMMANDE, QUANTITELC) VALUES ('".$libelle."', '".$commande."', '".$quantite."')";
          $requete_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
       }

  echo "Commande payée: ".MontantGlobal()." € pour ".$nbArticles." articles différents <br />";

  unset($_SESSION['panier']);

}

?>
</div>
			</div>
<?php
include("include/bas.php");
?>			

<?php 
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
          <form class="form-horizontal" action="#" method="post">
          <fieldset>

          <!-- Form Name -->
          <legend>Inscription</legend>
          <p id = "message"><?php if(isset($message)) echo $message ?></p>

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
              <input type = "submit" value = "Envoyer" name="inscription" id="inscription" class="btn btn-primary" />
            </div>
          </div>

          </fieldset>
          </form>

          </div>
<?php
include("include/bas.php");
?>          

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
	if(!empty($_POST['selection']))
	{
		
		if ($_POST['selection'] == 'option') {
?>
	      <form class="form-horizontal" action="envoyer_produit.php" method="get">
          <fieldset>
          <legend>Insertion d'une option</legend>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Nom de l'option</label>  
            <div class="col-md-4">
            <input id="NOMOPTION" name="NOMOPTION" type="text" placeholder="Nom" class="form-control input-md">
            </div>
          </div>

          <!-- Password input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Prix de l'option</label>
            <div class="col-md-4">
              <input id="prixoption" name="prixoption" type="text" placeholder="Prix" class="form-control input-md">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Quantité de l'option</label>  
            <div class="col-md-4">
             <input class="form-control" type = "number" name = "quantiteoption" id = "quantiteoption" placeholder="Quantité" />
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

		if ($_POST['selection'] == 'carburant') {
?>

	      <form class="form-horizontal" action="envoyer_produit.php" method="get">
          <fieldset>
		  <legend>Insertion d'un carburant</legend>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Nom du carburant</label>  
            <div class="col-md-4">
            <input id="nomproduit" name="nomproduit" type="text" placeholder="Nom" class="form-control input-md">
            </div>
          </div>

          <!-- Password input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Prix du carburant</label>
            <div class="col-md-4">
              <input id="prixproduit" name="prixproduit" type="text" placeholder="Prix" class="form-control input-md">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">URL directe de la photo</label>  
            <div class="col-md-4">
             <input class="form-control" type = "text" name = "urlproduit" id = "urlproduit" placeholder="URL" />
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Taille</label>  
            <div class="col-md-4">
             <input class="form-control" type = "number" name = "tailleproduit" id="tailleproduit" placeholder="URL" />
            </div>
          </div>

		<!-- Multiple Radios -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="radios">Plombé?</label>
		  <div class="col-md-4">
		  <div class="radio">
		    <label for="radios">
		      <input type="radio" name="plombe" id="1" value="1">
		      Oui
		    </label>
			</div>
		  <div class="radio">
		    <label for="radios">
		      <input type="radio" name="plombe" id="0" value="0" checked="checked">
		      Non
		    </label>
			</div>
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

		if ($_POST['selection'] == 'avion') {
?>
	      <form class="form-horizontal" action="envoyer_produit.php" method="get">
          <fieldset>
          <legend>Insertion d'un avion</legend>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Nom de l'avion</label>  
            <div class="col-md-4">
            <input id="nomproduit" name="nomproduit" type="text" placeholder="Nom" class="form-control input-md">
            </div>
          </div>

          <!-- Password input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Prix de l'avion</label>
            <div class="col-md-4">
              <input id="prixproduit" name="prixproduit" type="text" placeholder="Prix" class="form-control input-md">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">URL directe de la photo</label>  
            <div class="col-md-4">
             <input class="form-control" type = "text" name = "urlproduit" id = "urlproduit" placeholder="URL" />
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Taille</label>  
            <div class="col-md-4">
             <input class="form-control" type = "number" name = "tailleproduit" id="tailleproduit" placeholder="URL" />
            </div>
          </div>

		<!-- Multiple Radios -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="radios">options</label>
		  </div>
			<?php

			$i = 1;
			$retour = mysqli_query($bdd, 'SELECT * FROM `option` ORDER BY NUMOPTION');
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
	
<?php
	}

	}

	else echo "Vous n'êtes pas inscrits ou vous n'avez pas accès.";
?>

			</div>
<?php
include("include/bas.php");
?>			

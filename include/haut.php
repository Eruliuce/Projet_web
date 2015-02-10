<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Plan'etMarket</title>

        <!-- Le styles -->
        <meta name="viewport" content="width=device-width" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	     	<link href="css.css" rel="stylesheet" type="text/css">

	    <script src="bootstrap/jquery-2.1.0.js"></script>
	    <script src="bootstrap/js/bootstrap.min.js"></script>
		<script>
		$(function (){
		    $('.carousel').carousel();
		});  
		</script>
    </head>
    <body>


<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php"><img class="img-responsive" style="max-width:110px;" src="images/avion_Yolo2.png"></a>
  </div>




  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="panier.php">Panier</a></li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nos produits <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="affiche_produits.php?type=Avion">Avions</a></li>
          <li><a href="affiche_produits.php?type=Carburant">Carburants</a></li>
          <li class="divider"></li>
          <li><a href="affiche_produits.php">Tout</a></li>
        </ul>
      </li>
    </ul>
    <form class="navbar-form navbar-left"  action="affiche_produit.php" method="get">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Rechercher un avion..." name="nom" id="nom">
      </div>
      <input type = "submit" value = "Envoyer"  class="btn btn-primary" />
    </form>
    <ul class="nav navbar-nav navbar-right">
      <?php
      if (empty($_SESSION['login'])) {
      ?>


      <li><a href="inscription.php">Inscription</a></li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Se connecter <b class="caret"></b></a>
        <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 10px;">
			<form method="post" accept-charset="UTF-8">
				<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
	     		<input class="form-control" id="pseudo" type="text" name="pseudo" size="25" placeholder="Login" autofocus />
			  	<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input class="form-control" id="pass" type="password" name="pass" size="25" placeholder="Password" />
			  	<br />
			  	          <?php
           echo $message;
          ?>
			  	<input class="btn btn-primary" type="submit" name="connexion" id="connexion" value="Connecter" />
			  	<br >

			</form>
      <?php
      }
      ?>

      <?php
      if (!empty($_SESSION['login']) && gettype($_SESSION['login']) != 'integer') {
      ?>


      <li><a href="deconnexion.php">Déconnexion</a></li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bonjour <?php echo $_SESSION['login']; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 10px;">
        <ul class="nav">
         <?php
        $resultat = mysqli_query($bdd, "SELECT BOOLADMIN FROM client WHERE LOGINCLIENT='".$_SESSION['login']."'") or die(mysqli_error($bdd));
        $verification = mysqli_fetch_assoc($resultat);
        if($verification['BOOLADMIN'] == 1) {
        ?>
        <li><a href="administration.php">Administration</a></li>
        <?php
          }
        ?>
        <li><a href="profil.php">Mon profil</a></li>
        <li><a href="commandes.php">Mes commandes</a></li>
        </ul>

      <?php
      }

      if (!empty($_SESSION['login']) && gettype($_SESSION['login']) == 'integer') {
      ?>

     <li><a href="inscription.php">Inscription</a></li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Se connecter <b class="caret"></b></a>
        <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 10px;">
      <form method="post" accept-charset="UTF-8">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
          <input class="form-control" id="pseudo" type="text" name="pseudo" size="25" placeholder="Login" autofocus />
          <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input class="form-control" id="pass" type="password" name="pass" size="25" placeholder="Password" />
          <br />
                    <?php
           echo $message;
          ?>
          <input class="btn btn-primary" type="submit" name="connexion" id="connexion" value="Connecter" />
          <br >

      </form>


      <?php
      }
      ?>


      </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>




			</div>	

			</div>
		</div>
    </div>
    

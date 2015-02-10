<?php
/* Création d'une fonction - utilisée dans la récupération des variables - qui teste la configuration get_magic_quotes_gpc du serveur.
Si oui, supprime avec la fonction stripslashes les antislashes "\" insérés dans les chaines de caractère des variables gpc (GET, POST, COOKIE) */

if (isset($_POST['connexion'])) {
    $message = null;

// Si le formulaire est envoyé
if (isset($_POST['pseudo'])) 
{

    /* Récupération des variables issues du formulaire
    Teste l'existence les données post en vérifiant qu'elles existent, qu'elles sont non vides et non composées uniquement d'espaces.
    (Ce dernier point est facultatif et l'on pourrait se passer d'utiliser la fonction trim())
    En cas de succès, on applique notre fonction Verif_magicquotes pour (éventuellement) nettoyer la variable */
    $pseudo = (isset($_POST['pseudo']) && trim($_POST['pseudo']) != '')? Verif_magicquotes($_POST['pseudo']) : null;
    $pass = (isset($_POST['pass']) && trim($_POST['pass']) != '')? Verif_magicquotes($_POST['pass']) : null;
    

    // Si $pseudo et $pass différents de null
    if(isset($pseudo,$pass)) 
    {
         // Préparation des données pour les requêtes à l'aide de la fonction mysql_real_escape_string
         $pseudo = mysqli_real_escape_string($bdd, $pseudo);
         $pass = mysqli_real_escape_string($bdd, $pass);
		 $pass = md5($pass);
    
         /* Requête pour récupérer les enregistrements répondant à la clause : 
         champ du pseudo et champ du mdp de la table = pseudo et mdp postés dans le formulaire*/
        $requete = "SELECT * FROM client WHERE LOGINCLIENT = '".$pseudo."' AND PASSCLIENT = '".$pass."'";  
    
         // Exécution de la requête
         $resultat = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
    
         // Création du tableau associatif du résultat
         $req_exec = mysqli_fetch_assoc($resultat); 

         // Les valeurs (si elles existent) sont retournées dans le tableau $resultat; 
         if (isset($req_exec['LOGINCLIENT'],$req_exec['PASSCLIENT']))  
               {
                 /* Démarre la session et enregistre le pseudo dans la variable de session $_SESSION['login']
                 qui donne au visiteur la possibilité de visiter les pages protégées.  */
                 
                 $_SESSION['login'] = $pseudo;
            
                 // A MODIFIER Remplacer le '#' par l'adresse de votre page de destination, sinon ce lien indique la page actuelle.
                 $message = 'Bonjour '.htmlspecialchars($_SESSION['login']).'';
                }
                else
                {   // Le pseudo ou le mot de passe sont incorrect
                $message = 'Le pseudo ou le mot de passe sont incorrects';
                } 

                mysqli_free_result($resultat);

    }
    else 
    {  //au moins un des deux champs "pseudo" ou "mot de passe" n'a pas été rempli
    $message = 'Les champs Pseudo et Mot de passe doivent être remplis.';
    }
}
}

?>
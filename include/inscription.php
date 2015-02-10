<?php
// Initialisation du message de réponse
$message = null;

if (isset($_POST['inscription'])) {
    // Si le formulaire est envoyé
    if (isset($_POST['pseudo'])) 
    {

        /* Récupération des variables issues du formulaire
        Teste l'existence les données post en vérifiant qu'elles existent, qu'elles sont non vides et non composées uniquement d'espaces.
        (Ce dernier point est facultatif et l'on pourrait se passer d'utiliser la fonction trim())
        En cas de succès, on applique notre fonction Verif_magicquotes pour (éventuellement) nettoyer la variable */
        $pseudo = (isset($_POST['pseudo']) && trim($_POST['pseudo']) != '')? Verif_magicquotes($_POST['pseudo']) : null;
        $pass = (isset($_POST['pass']) && trim($_POST['pass']) != '')? Verif_magicquotes($_POST['pass']) : null;
        $name = (isset($_POST['name']) && trim($_POST['name']) != '')? Verif_magicquotes($_POST['name']) : null;
        $prenom = (isset($_POST['prenom']) && trim($_POST['prenom']) != '')? Verif_magicquotes($_POST['prenom']) : null;
        $adr = (isset($_POST['adresse']) && trim($_POST['adresse']) != '')? Verif_magicquotes($_POST['adresse']) : null;
        $cb = (isset($_POST['cartebleue']) && trim($_POST['cartebleue']) != '')? Verif_magicquotes($_POST['cartebleue']) : null;
        $cp = (isset($_POST['codepostal']) && trim($_POST['codepostal']) != '')? Verif_magicquotes($_POST['codepostal']) : null;
        $tel = (isset($_POST['telephone']) && trim($_POST['telephone']) != '')? Verif_magicquotes($_POST['telephone']) : null;
        

        // Si $pseudo et $pass différents de null
        if(isset($pseudo,$pass)) 
        {
        
             // Préparation des données pour les requêtes à l'aide de la fonction mysql_real_escape_string
             $pseudo = mysqli_real_escape_string($bdd, $pseudo);
             $pass = mysqli_real_escape_string($bdd, $pass);
    		     $pass = md5($pass);
             $name = mysqli_real_escape_string($bdd, $name);
             $prenom = mysqli_real_escape_string($bdd, $prenom);
             $adr = mysqli_real_escape_string($bdd, $adr);
             $cb = mysqli_real_escape_string($bdd, $cb);
             $cb = md5($cb);
             $cp = mysqli_real_escape_string($bdd, $cp);
             $tel = mysqli_real_escape_string($bdd, $tel);
        
        
             // Requête pour compter le nombre d'enregistrements répondant à la clause : champ du pseudo de la table = pseudo posté dans le formulaire
             $requete = "SELECT count(*) as nb FROM client WHERE LOGINCLIENT = '".$pseudo."'";
        
             // Exécution de la requête
             $req_exec = mysqli_query($bdd, $requete) or die(mysqli_error($bdd));
        
             // Création du tableau associatif du résultat
             $resultat = mysqli_fetch_assoc($req_exec);
        

             // nb est le nom de l'allias associé à count(*) et retourne le résultat de la requête dans le tableau $resultat; 
             if (isset($resultat['nb']) && $resultat['nb'] == 0) 
             // Résultat du comptage = 0 pour ce pseudo, on peut donc l'enregistrer 
             {
                 // Pour enregistrer la date actuelle (date/heure/minutes/secondes) on peut utiliser directement la fonction mysql : NOW()
                 $insertion = "INSERT INTO client(LOGINCLIENT,PASSCLIENT,NOMCLIENT,PRENOMCLIENT,ADRESSECLIENT,CPCLIENT,TELCLIENT,CBCLIENT,DATEINSC)
                  VALUES('".$pseudo."', '".$pass."', '".$name."', '".$prenom."', '".$adr."', '".$cp."', '".$tel."', '".$cb."', NOW())";
             
                 // Exécution de la requête d'insertion
                 $inser_exec = mysqli_query($bdd, $insertion) or die(mysqli_error($bdd));
            
                 /* Si l'insertion s'est faite correctement (une requête d'insertion retourne "true" en cas de succès, je peux donc utiliser 
                 l'opérateur de comparaison strict '==='  c.f. http://fr.php.net/manual/fr/language.op ... arison.php) */
                 if ($inser_exec === true) 
                 {
                     /* Démarre la session et enregistre le pseudo dans la variable de session $_SESSION['login']
                     qui donne au visiteur la possibilité de se connecter.  */
                     session_start();
                     $_SESSION['login'] = $pseudo;

                     $message = 'Votre inscription est enregistrée.';
                 }    
             }
             else {  
                 $message = 'Ce pseudo est déjà utilisé, changez-le.';
             }
        }
        else {   
             $message = 'Un des deux champs n\'a pas été rempli.';
        }
    }
}
?>
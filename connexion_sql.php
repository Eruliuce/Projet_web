<?php  
         
		 /* Connexion au serveur : dans cet exemple, en local sur le serveur d'évaluation */
         $hostname = "localhost";
         $database = "Avion";
         $username = "root";
         $password = "";

         if($bdd = mysqli_connect($hostname, $username, $password, $database))
         {
             mysqli_query($bdd, "SET NAMES 'utf8'");
          }
         else // Mais si elle rate…
         {
            echo 'Erreur lors de la connexion'; // On affiche un message d'erreur.
         }
?>
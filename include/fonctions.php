<?php
function Verif_magicquotes ($chaine) 
{
if (get_magic_quotes_gpc()) $chaine = stripslashes($chaine);

return $chaine;
} 

?>
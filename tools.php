<?php

function sub()
{
    if (isset($_POST['nom']) and isset($_POST['prenom'] )) {
        echo "<p> Vous vous appelez ".$_POST['nom']." ".$_POST['prenom']."</p>";
        header("/connection");
    }
}

?>

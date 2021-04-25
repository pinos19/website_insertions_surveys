<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=ip', 'root', '');
    }catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }
?>

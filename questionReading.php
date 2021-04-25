<?php
include "connect_db.php";


$sql = "SELECT id , question  FROM questions";

if (@count($db->query($sql)) > 0) {
    echo "<table class='center' ><tr><th>Numéro</th><th>Intitule question</th><th>Statistiques Réponses</th><th>Actions</th></tr>";
    foreach ($db->query($sql) as $row){

        $countOfA=$db->prepare('SELECT COUNT(*) as nbA FROM reponses WHERE idQ = :idQ');
        $countOfA->execute(array('idQ' => $row['id']));
        $countOfU=$db->query('SELECT COUNT(id) as nbU FROM utilisateurs');

        echo "<tr><td>".$row["id"]."<td>".$row["question"]."</td>"."<td>".$countOfA->fetch()['nbA'].'/'.$countOfU->fetch()['nbU']."</td> <td> <a href='questions.php?id=".$row['id']."'>Voir les résultats</a> </td>"; 
    }
    echo "</table>";
  } else {
    echo "0 results";
  }

?>

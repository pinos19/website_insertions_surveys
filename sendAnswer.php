<?php
if (isset($_POST['send']))
{
    echo "<script type='text/javascript'>console.log('ok')</script>";
    date_default_timezone_set('UTC');
    if(!empty($_POST['annee']))
    {
      $this_year = date("Y");
      $annee = intval($_POST['annee']);
      if(is_int($annee))
      {
        if($annee > $this_year OR $annee < 2000)
        {
          $errormessage = "Année invalide";
          $annee = null;
        }
        // Sinon l'année renseignée est considérée comme correcte
        $req=$db->prepare("INSERT INTO reponses (idU, idQ, reponse) VALUES(:idU, :idQ, :reponse)");
        $req->execute(array(
          'idU' => $user['id'],
          'idQ' => 1,
          'reponse' => $annee
        ));
      }
      else
      {
        $annee = null;
        $errormessage = "Année incorrecte";
      }
    }
    if(!empty($_POST['formation']))
    {
      $formation = $_POST['formation'];
      switch($formation)
      {
        case "info":
        $f = "Informatique";
        break;
        case "indus":
        $f = "Industriel";
        break;
        case "dd":
        $f = "Développement durable";
        break;
        default:
        $f = null;
        $errormessage = "Formation inconnue";
      }
      if(!is_null($f))
      {
        $req=$db->prepare("INSERT INTO reponses (idU, idQ, reponse) VALUES(:idU, :idQ, :reponse)");
        $req->execute(array(
          'idU' => $user['id'],
          'idQ' => 2,
          'reponse' => $f
        ));
      }
    }
    else
    {
      $f = null;
    }
    if(!empty($_POST['jobanswer']))
    {
      $job = $_POST['jobanswer'];
      switch($job)
      {
        case "yes":
        $job = "oui";
        break;
        case "no":
        $job = "non";
        break;
        default:
        $job = null;
        $errormessage = "Réponse incorrecte";
      }
      if(!is_null($job))
      {
        $req=$db->prepare("INSERT INTO reponses (idU, idQ, reponse) VALUES(:idU, :idQ, :reponse)");
        $req->execute(array(
          'idU' => $user['id'],
          'idQ' => 3,
          'reponse' => $job
        ));
      }
    }
    else
    {
      $job = null;
    }
    if(!empty($_POST['mois']))
    {
      $mois = intval($_POST['mois']);
      if(is_int($mois))
      {
        if($mois < 0)
        {
          $mois = null;
          $errormessage = "Nb mois incorrect";
        }
        //Sinon on considère que la vairable est correcte
        $req=$db->prepare("INSERT INTO reponses (idU, idQ, reponse) VALUES(:idU, :idQ, :reponse)");
        $req->execute(array(
          'idU' => $user['id'],
          'idQ' => 4,
          'reponse' => $mois
        ));
      }
      else
      {
        $mois = null;
        $errormessage = "Nb mois incorrect";
      }
    }
    else
    {
      $mois = null;
    }
    if(!empty($_POST['salaire']))
    {
      $salaire = $_POST['salaire'];
      switch($salaire)
      {
        case 1:
        $s = "Entre 0 et 20 000€";
        break;
        case 2:
        $s = "Entre 20 000 et 40 000€";
        break;
        case 3:
        $s = "Supérieur à 40 000€";
        break;
        default:
        $s = null;
        $errormessage = "Salaire inccorect";
      }
      if(!is_null($s))
      {
        $req=$db->prepare("INSERT INTO reponses (idU, idQ, reponse) VALUES(:idU, :idQ, :reponse)");
        $req->execute(array(
          'idU' => $user['id'],
          'idQ' => 5,
          'reponse' => $s
        ));
      }
    }
    else
    {
      $s = null;
    }
    header('Location:index.php?token='.$user['token'].'');
}else if(!isset($_POST['jobanswer']) or !isset($_POST['formation']) or !isset($_POST['annee'] )) {
    $errormessage = "Remplissez les champs";
}
?>

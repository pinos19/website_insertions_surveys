<?php include('connect_db.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Enquête d'insertion professionnelle</title>
        <link rel="stylesheet" type="text/css" href="style.css?d=2"/>
        <link rel="icon" type="image/png" href="img/student.png" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
      <header class="flex jc-center center">
        <div class="wrapper flex jc-sb ai-center">
          <div>
            <a href="index.php"><img src="img/logo.png" width="200"/></a>
          </div>
          <div>
            <h1>Enquête Insertion Professionnelle</h1>
          </div>
        </div>
      </header>
      <?php
      if(isset($_GET['token']))
      {
        $rl=$db->prepare('SELECT COUNT(*) as nbU FROM utilisateurs WHERE token = :token');
        $rl->execute(array(
          'token' => $_GET['token']
        ));
        $count = $rl->fetch();
        if($count['nbU'] == 1) // Si le token existe
        {
          $req=$db->prepare('SELECT * FROM utilisateurs WHERE token = :token');
          $req->execute(array(
            'token' => $_GET['token']
          ));
          $user=$req->fetch();
          echo'
                <div class="subheader">
                  <div class="subheader-grey flex jc-center ai-center">
                    <div>
                      <img src="img/student.png" width="100px"/>
                    </div>
                    <div>'.$user['nom'].' '.$user['prenom'].'</div>
                  </div>
                </div>
                <div class="flex jc-center center">
                  <div class="wrapper">
                    <form method="post">
                      <h2>Questionnaire</h2>
                      <div class="left">';
                      $rl_q=$db->prepare('SELECT COUNT(*) as q FROM reponses WHERE idU = :idU AND idQ = :idQ');
                      $rl_q->execute(array(
                        'idU' => $user['id'],
                        'idQ' => 1
                      ));
                      $q1_exist=$rl_q->fetch();
                      if($q1_exist['q'] == 0)
                      {
                        echo'
                        <div class="q">
                            En quelle année avez-vous été diplomé ?
                            <div>
                              <input  type="number" name="annee" min="2000" max="'.date("Y").'"/>
                            </div>
                          </div>';
                      }
                      $rl_q->execute(array(
                        'idU' => $user['id'],
                        'idQ' => 2
                      ));
                      $q1_exist=$rl_q->fetch();
                      if($q1_exist['q'] == 0)
                      {
                        echo'<div class="q">
                          Dans quelle formation étiez-vous ?
                          <div>
                            <input  type="radio" name="formation" value="info" />Informatique
                            <input  type="radio" name="formation" value="indus" />Génie Industriel
                            <input  type="radio" name="formation" value="dd" />Développement Durable
                          </div>
                        </div>';
                      }
                      echo'<div>';
                      $rl_q->execute(array(
                        'idU' => $user['id'],
                        'idQ' => 3
                      ));
                      $display = "none";
                      $q1_exist=$rl_q->fetch();
                      if($q1_exist['q'] == 0)
                      {
                        echo'
                        <div class="q">
                          Avez-trouvez du travail ?
                          <div>
                            <input type="radio" id="yesJob" name="jobanswer" value="no" onchange="document.getElementById(\'otherQuestions\').style.display = \'none\';">
                            <label>Non</label>
                            <input type="radio" id="noJob" name="jobanswer" value="yes" onchange="document.getElementById(\'otherQuestions\').style.display = \'unset\';">
                            <label>Oui</label><br>
                          </div>
                        </div>';
                      }
                      else
                      {
                        $req=$db->prepare('SELECT * FROM reponses WHERE idU = :idU AND idQ = :idQ');
                        $req->execute(array(
                          'idU' => $user['id'],
                          'idQ' => 3
                        ));
                        $q = $req->fetch();
                        if($q['reponse'] == "oui"){$display = "unset";}else{$display="none";}
                      }

                      echo'<span style ="display: '.$display.';" id="otherQuestions">';
                      $rl_q->execute(array(
                        'idU' => $user['id'],
                        'idQ' => 4
                      ));
                      $q1_exist=$rl_q->fetch();
                      if($q1_exist['q'] == 0)
                      {
                        echo'
                        <div class="q">
                          En combien de mois avez-vous trouvé un emploi après obtention du diplôme ?
                          <div>
                            <input  type="number" name="mois" min="O" /> mois
                          </div>
                        </div>';
                      }
                      $rl_q->execute(array(
                        'idU' => $user['id'],
                        'idQ' => 5
                      ));
                      $q1_exist=$rl_q->fetch();
                      if($q1_exist['q'] == 0)
                      {
                        echo'<div class="q">
                          Votre salaire annuel se situe :
                          <div>
                            <input  type="radio" name="salaire" value="1" />Entre 0 et 20 000€
                            <input  type="radio" name="salaire" value="2" />Entre 20 000 et 40 000€
                            <input  type="radio" name="salaire" value="3" />Supérieur à 40 000€
                          </div>
                        </div>';
                      }
                      echo'
                      </span>

                      <input type="submit" name="send" value="Envoyer" autocomplete="off"/>';
                      include('sendAnswer.php');
                      echo'
                          <p>'.@$errormessage.'</p>
                        </div>
                      </form>
                    </div>
                  </div>
              </body>
          </html>';
        }
        else
        {
          echo'Token incorrect';
        }
      }
      else
      {
        echo'
        <div class="subheader">
          <div class="subheader-grey flex jc-center ai-center">
            <div>
              Aucun token renseigné
            </div>
          </div>
        </div>
        <div class="flex jc-center center">
          <div class="wrapper">
            Séléctionnez un étudiant
            <ul style="list-style:none">';
            $req=$db->query('SELECT * FROM utilisateurs');
            while($user=$req->fetch())
            {
              echo'<li><a href="index.php?token='.$user['token'].'">'.$user['nom'].' '.$user['prenom'].'</a></li>';
            }
            echo'
            </ul>
          </div>
        </div>';
      }
      ?>

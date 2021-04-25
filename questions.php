<!DOCTYPE html>
<html>
    <head>
        <title>Enquête d'insertion professionnelle - Statistiques</title>
        <link rel="stylesheet" type="text/css" href="style.css?d=3"/>
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
      <div class="subheader">
        <div class="subheader-grey flex jc-center ai-center">
          <div><h2>Questions</h2>
            <a href="users.php">Étudiants</a>
          </div>
        </div>
      </div>
      <div class="flex jc-center center">
        <div class="wrapper">
          <?php
          include('connect_db.php');
          if(isset($_GET['id']))
          {
            $req=$db->prepare('SELECT * FROM questions WHERE id = :id');
            $req->execute(array(
              'id' => $_GET['id']
            ));
            $q = $req->fetch();
            $reqA=$db->prepare('SELECT * FROM reponses WHERE idQ = :idQ');
            $reqA->execute(array(
              'idQ' => $_GET['id']
            ));
            $res = array();
            $cpt = 0;
            while($ans=$reqA->fetch())
            {
              if(count($res) == 0) // Si c'est le premier résultat qu'on analyse
              {
                $res[] = ["y" => 1, "label" => $ans['reponse']];
              }
              else
              {
                if(in_array($ans['reponse'], array_column($res,'label'))) // Si la valeur existe déjà
                {
                  $key = array_search($ans['reponse'],array_column($res, 'label'));
                  $res[$key]['y'] = $res[$key]['y']+1;
                }
                else // Si la valeur n'existe pas
                {
                  $res[] = ["y" => 1, "label" => $ans['reponse']];
                }
              }
              $cpt++;
            }
            //unset($value);
            array_multisort(array_column($res,'label'), SORT_ASC, $res);
            foreach($res as &$value) // Passage en % de la valeur y
            {
              $value['y'] = $value['y']/$cpt*100;
            }
            $dataPoints = $res;

            ?>
            <script>
            window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
              text: <?php echo json_encode($q['question']);?>
            },
            axisY: {
              minimum: 0,
              maximum: 100,
              title: "Répartition en %"
            },
            data: [{
              type: "column",
              yValueFormatString: "#,##0.00\"%\"",
              dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
            });
            chart.render();

            }
            </script>
            <?php
            echo'<a href="questions.php">Retour aux questions</a>
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>';
          }
          else {
            include "questionReading.php";
          }
           ?>
        </div>
      </div>
      <script type="text/javascript" src="inc/canvasjs.min.js"></script>
    </body>
</html>

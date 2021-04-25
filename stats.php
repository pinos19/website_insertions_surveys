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
            <img src="img/logo.png" width="200"/>
          </div>
          <div>
            <h1>Enquête Insertion Professionnelle</h1>
          </div>
        </div>
      </header>
      <div class="subheader">
        <div class="subheader-grey flex jc-center ai-center">
          <div><h2>Statistiques</h2>
            <a href="questions.php">Questions</a> / <a href="users.php">Étudiants</a>
          </div>
        </div>
      </div>
      <div class="flex jc-center center">
        <div class="wrapper">
          <script>
          window.onload = function() {

          var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          theme: "light2",
          title:{
            text: "En quelle année avez-vous eu votre diplome ?"
          },
          axisY: {
            minimum: 0,
            maximum: 100,
            title: "Répartition en %"
          },
          data: [{
            type: "column",
            yValueFormatString: "#,##0.00\"%\"",
            dataPoints: [
              { label: "2014",  y: 65 },
              { label: "2015",  y: 41  },
              { label: "2016",  y: 49  },
              { label: "2017",  y: 46  },
              { label: "2018",  y: 39  },
              { label: "2019",  y: 42  },
              { label: "2020",  y: 57  }
            ]
          }]
          });
          chart.render();

          }
          </script>
          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
      </div>
      <script type="text/javascript" src="inc/canvasjs.min.js"></script>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <?php 
          include 'tools.php' ;
           // Definition des constantes et variables
          define('LOGIN','admin');
          define('PASSWORD','admin');
          $errorMessage = '';

          if(!empty($_POST)){
            // Les identifiants sont transmis ?
            if(!empty($_POST['login']) && !empty($_POST['pass'])) {
              // Sont-ils les mêmes que les constantes ?
              if($_POST['login'] !== LOGIN or $_POST['pass'] !== PASSWORD ) {
                $errorMessage = 'Mauvais Identifiant ou Mot de passe';
              }else{
                session_start();
                $_SESSION['login'] = LOGIN;
                header('Location: login.php');
                exit();
              }
            }else{
              $errorMessage = 'Veuillez inscrire vos identifiants svp !';
              header("/connection");
            }
          }
        ?>
        <title>Connexion </title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    </head>
    <body>
        
      <div class="flex jc-center center">
        <div>
          <h1>Poratil de connexion</h1>
          <form method="post">
            <div>
              <input type="text" name="login" placeholder="Identifiant" autocomplete="off"/>
              <input type="password" name="pass" placeholder="Mot de passe" autocomplete="off"/>
              <?php if(!empty($errorMessage)){echo '<p id="error">'.$errorMessage.'</p>';} ?>
            </div>
            <input type="submit" name="send" value="Connexion" autocomplete="off"/>
          </form>
        </div>
      </div>
    </body>
</html>
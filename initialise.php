<?php
/*
 * Script d'initialisation de la base de données
 */
  require_once('includes/fonctions.php');
  
     // Création du fichier avec les données de connexion
  
  if(isset($_POST['hote'])) {
    $fp = fopen('includes/basededonnees.php','w');
    $l1 = '$hote="'.$_POST['hote'].'";';
    $l2 = '$utilisateur="'.$_POST['utilisateur'].'";';
    $l3 = '$motdepasse="'.$_POST['motdepasse'].'";';
    $l4 = '$nomdelabase="'.$_POST['nomdelabase'].'";';
    fwrite($fp, "<?php\n$l1\n$l2\n$l3\n$l4\n?>");
    fclose($fp);
    include('includes/basededonnees.php');

    //Connexion

      $conn = new mysqli($hote,$utilisateur,$motdepasse,$nomdelabase);

    /* Vérification de la connexion */ 
    if (mysqli_connect_errno()) {
      die("Échec de la connexion : \n". mysqli_connect_error());
    }        
    // Création des tables

   $utilisateurs = "CREATE TABLE utilisateurs (
    uid INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(25) NOT NULL,
    motdepasse VARCHAR(80) NOT NULL,
    email VARCHAR(100) NOT NULL,
    sexe VARCHAR(10) NOT NULL,
    telephone BIGINT(50) NULL,
    description TEXT
    )";

    if ($conn->query($utilisateurs) === FALSE) {
        echo "Erreur lors de la création de la table utilisateurs : " . $conn->error;
    }

    $offres = "CREATE TABLE offres (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    uid INT(11) NOT NULL,
    source VARCHAR(250) NOT NULL,
    destination VARCHAR(250) NOT NULL,
    datedebut DATETIME NOT NULL,
    nbpersonne INT(11) NOT NULL DEFAULT '1',
    prix INT(11) NOT NULL DEFAULT '0',
    vehicule VARCHAR(250) NOT NULL,
    description TEXT
    )";

    if ($conn->query($offres) === FALSE) {
        echo "Erreur lors de la création de la table offres : " . $conn->error;
    }

    $notifications = "CREATE TABLE notifications (
    slno INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    expediteur INT(11) NOT NULL,
    destinataire INT(11) NOT NULL,
    type INT(11) NOT NULL,
    cid INT(11) NOT NULL,
    timestamp DATETIME NOT NULL,
    statut VARCHAR(100) NOT NULL
    )";

    if ($conn->query($notifications) === FALSE) {
        echo "Erreur lors de la création de la table notifications : " . $conn->error;
    }

    $route = "CREATE TABLE route (
    routeid INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cid INT(11) NOT NULL,
    via VARCHAR(250) NOT NULL,
    numeroserie INT(11) NOT NULL
    )";

    if ($conn->query($route) === FALSE) {
        echo "Erreur lors de la création de la table route : " . $conn->error;
    }
    
    // Création d'un compte administrateur
    
    $nameandpass = "admin";    
    $sexe = "M";
    $admin = "INSERT INTO utilisateurs (nom , motdepasse , email, sexe) VALUES ('".$nameandpass."', '".$nameandpass."', '".$_POST['email']."', '".$sexe."')";
    
    if ($conn->query($admin) === FALSE) {
        echo "Erreur lors de la création de l'admin : " . $conn->error;
    }else{
        echo "<script>alert('Hello !')</script>";
    }

    /* Fermeture de la connexion */
    $conn->close();

    header("Location: initialise.php?installer=1");
  }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Covoiturage Maroc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/common.css" rel="stylesheet">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>

    <div id="wrap">
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="index.php">Covoiturage</a>
            </div>
        </div>
      </div>

      <div class="container">
        <?php
      if(isset($_GET['installer'])) {
    ?>
        <div class="alert alert-success">Site de covoiturage initialisé avec succès !<br/>
        Cliquez sur le header pour retourner sur le site !</div>
          <?php  }else if(!file_exists("includes/basededonnees.php")){ ?>
      <h1><small>Détails de la base de données</small></h1>
    <form action="initialise.php" method="post">
      Hôte : <input type="text" name="hote" placeholder="ex : localhost"/><br/>
      Nom d'utilisateur : <input type="text" name="utilisateur" placeholder="ex : root"/><br/>
      Mot de passe : <input type="password" name="motdepasse"/><br/>
      Nom de la base : <input type="text" name="nomdelabase" placeholder="ex : db_covoiturage"/><br/>
      Email: <input type="email" name="email"/><br/>
      <input type="submit" class="btn btn-primary" value="Initialiser"/>
    </form>
      <?php } else {?>
      <div class="alert alert-error">Base de données déjà initialisée. Supprimez le fichier includes/basededonnees.php et re-initialisé le site</div>
    <?php } ?>
      </div>
      <div id="push"></div>
    </div>

    <!-- JS placé à la fin pour un chargement plus rapide -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>

<?php

/*
 * Fonctions trouvées sur Internet et adaptées pour le projet
 */

session_start();

// connexion à la base de données
function connexionBDD() {
  include('basededonnees.php');
  $conn = new mysqli($hote,$utilisateur,$motdepasse,$nomdelabase);

    /* Vérification de la connexion */ 
    if (mysqli_connect_errno()) {
      die("Échec de la connexion : \n". mysqli_connect_error());
    }        

  $conn->query("SET NAMES 'utf8'");
  return $conn;
}

// générer un nombre aléatoire
function nbAleatoire($longueur){
  $min = pow(36, $longueur-1);
  $max = pow(36, $longueur)-1;
  $base10Rand = mt_rand($min, $max);
  $newRand = base_convert($base10Rand, 10, 36);
  return $newRand;
}

// vérifier si l'utilisateur est connecté
function estConnecte() {
  return isset($_SESSION['identification']);
}

// obtenir l'id de l'utilisateur
function getIdUtilisateur(){
  $uid = $_SESSION['identification'];
  $requete = "SELECT uid FROM utilisateurs WHERE uid = '".$uid."'";
  $conn = connexionBDD();
  $result = $conn->query($requete);
  $fields = mysqli_fetch_array($result);
  $id = $fields['uid'];
  return $id;
}

function nom(){
  $uid = $_SESSION['identification'];
  $requete = "SELECT nom FROM utilisateurs WHERE uid = '".$uid."'";
  $conn = connexionBDD();
  $result = $conn->query($requete);
  $fields = mysqli_fetch_array($result);
  $nom = $fields['nom'];
  return $nom;
}

function getNom($uid){
  $requete = "SELECT nom FROM utilisateurs WHERE uid = ".$uid;
  $conn = connexionBDD();
  $res = $conn->query($requete);
  $result = mysqli_result($res, 0);
  return $result;
}

function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
} 
?>

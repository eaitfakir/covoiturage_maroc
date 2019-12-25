<?php
/*
 * Script d'ajout d'un trajet
 */
require_once('includes/fonctions.php');
$conn = connexionBDD();
                 
$idutilisateur = $_POST["uid"];
$source = $_POST["source"];
$destination = $_POST["destination"];
$cid = $_POST["cid"];
$requete = 'SELECT * FROM offres WHERE id = "'.$cid.'"';
$result = $conn->query($requete) or die("".mysqli_error($conn)) ;
$row = mysqli_fetch_array($result);
$aujourdhui = date("Y-m-d H:i:s");

$destinataire = $row["uid"];

//expéditeur attendant la réponse du destinataire

$requete = 'INSERT INTO notifications (expediteur, destinataire, cid, timestamp, type) VALUES("'.$destinataire. '","'. $idutilisateur .'","'. $cid .'","'. $aujourdhui .'", 3)';

$result = $conn->query($requete) or die("Erreur 42 :".mysqli_error($conn))  ;

//envoi au destinataire pour approbation

$requete = 'INSERT INTO notifications (expediteur, destinataire, cid, timestamp, type) VALUES("'.$idutilisateur. '","'. $destinataire .'","'. $cid .'","'. $aujourdhui .'", 1)';

$result = $conn->query($requete) or die("Erreur 43 :".mysqli_error($conn));

header("Location: index.php?succes=1");

?>



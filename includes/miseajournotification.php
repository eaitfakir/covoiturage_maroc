<?php

require_once('fonctions.php');
$conn = connexionBDD();
$type = $_POST["type"];
$slno = $_POST["numeroNo"];
if ($type == "1") {

    $requete = 'SELECT * FROM notifications WHERE slno = "'.$slno.'"';
    $result = $conn->query($requete) or die("Erreur 94522555454");
    $stat = $_POST["stat"];
    $row = mysqli_fetch_array($result);

	$expediteur = $row["expediteur"]; 
    $destinataire= $row["destinataire"];
    $nouveauType = 2;
    $cid = $row["cid"];
    $timestamp = date("Y-m-d H:i:s");
	$slno2 = $slno-1;

        $requete = 'UPDATE notifications SET statut = "'.$stat.'" WHERE slno = "'.$slno.'"';
        
        $result = $conn->query($requete) or die("Erreur 412352463726164176476746746772746");
        
		
		$requete = 'UPDATE notifications SET statut = "'.$stat.'", type = "'.$nouveauType.'" WHERE slno = "'.$slno2.'"';
        
        $result = $conn->query($requete) or die("Erreur 546153153456415656335464156498484");

        if ($stat == "A"){
        
            $requete = 'SELECT * FROM offres WHERE id = "'.$cid.'"';
            $result = $conn->query($requete) or die("Erreur 465421745521467124454");
            
            $row = mysqli_fetch_array($result);

            $nbPersoDecrem = (int)$row["nbpersonne"]-1;
            
            $requete = 'UPDATE offres SET nbpersonne = "'.$nbPersoDecrem.'" WHERE id = "'.$cid.'"';
            $result = $conn->query($requete) or die("Erreur 41754765594641646546");
           
        }
}
?>


<?php
/*
 * Script de mise à jour
 */
include('fonctions.php');
$conn = connexionBDD();

if (isset($_POST['action'])) {
		if ($_POST['action'] == 'partager') {
			$uid = getIdUtilisateur();
			$source = $_POST['source'];
			$destination = $_POST['destination'];
			$datedebut = $_POST['datedebut'];
			$vehicule = "";
			$duree = $_POST['duree'];
			$prix = $_POST['prix'];
			$descriptiontrajet = $_POST['descriptiontrajet'];
			$mode = $_POST['vehicule'];
			$nbpersonne = $_POST['nbpersonne'];
			if ($mode == "voiture") {
				$vehicule = "Voiture";
			}
			else if ($mode == "minibus") {
				$vehicule = "Minibus";
			}
			else if ($mode == "taxi") {
				$vehicule = "Taxi";
			}

			$conn->query("INSERT INTO offres (uid,source,destination,datedebut,nbpersonne,prix,vehicule,duree,description) VALUES 
				(".$uid.",'".$source."','".$destination."','".$datedebut."',".$nbpersonne.",".$prix.",'".$vehicule."','".$duree."','".$descriptiontrajet."')") or die(mysqli_error());

			$requete = "SELECT id FROM offres WHERE uid= ".$uid." AND source ='".$source."' AND destination ='".$destination."' AND datedebut ='".$datedebut."' AND nbpersonne =".$nbpersonne." AND prix =".$prix." AND vehicule ='".$vehicule."' AND description ='".$descriptiontrajet."'";
			
			$result = $conn->query($requete) or die(mysqli_error());
			$rep = mysqli_fetch_array($result);
			$cid = $rep['id'];
			$conn->query("INSERT INTO route (cid,via,numeroserie) VALUES(".$cid.",'".$source."',1)") or die("Erreur insertion dans la table route 1".mysqli_error($conn));
			$num = $_POST['nbRequetes'];
			for($i = 1; $i <= $num; $i++){
				$id = "dynamic".(string)$i;
				$donnees = $_POST[$id];
				$j = $i+1;
				$conn->query("INSERT INTO route (cid,via,numeroserie) VALUES(".$cid.",'".$donnees."',".$j.")") or die("Erreur insertion dans la table route 2".mysqli_error());
			}
			$j = $i+1;
			$conn->query("INSERT INTO route (cid,via,numeroserie) VALUES(".$cid.",'".$destination."',".$j.")") or die("Erreur insertion dans la table route 3".mysqli_error());

			header("Location: ../index.php?partager=1");
	}
}


?>

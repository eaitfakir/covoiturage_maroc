<?php
/*
 * Script de notification
 */
	require_once('includes/fonctions.php');
	if(!estConnecte())
		header("Location: connexion.php");
	else
		include('includes/header.php');
		$conn = connexionBDD();
?>
<div class="container">
	
	<?php
		include('includes/messages.php');
	?>

	<?php
		include('includes/menu.php');
	?>
<div class="row-fluid" id="main-content">
		<div class="span1"></div>
        <div class="span10">
		<h2 align="center"><small> Notifications</small></h2>
<?php
    require_once('includes/fonctions.php');
        $conn = connexionBDD();
        $uid = getIdUtilisateur();
        $requete = 'SELECT * FROM notifications WHERE destinataire ="'.$uid.'" ORDER BY timestamp DESC;';
        $result = $conn->query($requete) or die("Erreur 123456 :".mysqli_error($conn));
		if (($result->num_rows) == 0) {
                echo("<div class='alert alert-info'>Aucune notification pour le moment !</div>\n");
          }
        else {
        
?>
        <table class="table table-hover">
            <thead><tr>
			<th>ID</th>
            <th>Date</th>
            <th>Trajet</th>
			<th>Utilisateur</th>
            <th>Action</th>
            </tr>
			</thead>
            <tbody>
<?php
        while($row = mysqli_fetch_array($result)){
            $type = $row["type"];
            echo '<tr>';
			echo '<td>'. $row["cid"] . '</td>'; 
            echo '<td>'.$row["timestamp"].'</td>';
            if($type=="1"){
                // Requête de l'expéditeur pour approuver sa requête
                $requete = 'SELECT * FROM offres WHERE id = "'.$row["cid"].'";';
                $result1 = $conn->query($requete) or die("Erreur 245455642 :".mysqli_error($conn));
                $rowcovoi = mysqli_fetch_array($result1);
                echo '<td><a href="trajet.php?id='. $row["cid"] . '" >'. $rowcovoi["source"] . ' - '. $rowcovoi["destination"] . '</a></td>'; 
				$uid2 = $row["expediteur"];
				$nom = getNom($uid2);
                echo '<td><a href="profil.php?id='.$uid2.'" >'.$nom.'</a></td>';
                $statut = $row["statut"];
                $slno = $row["slno"];
                if ($statut == "A") { 
                    echo '<td><button class="btn" disabled >Approuvé</button><td>';
                }
                else if ($statut == "R"){
                
                    echo '<td><button class="btn" disabled >Refusé</button></td>';
                }
                else {
                    $fctApp = '"ApprouveRequete('.$slno.',1)"';
                    $fctRef = '"ApprouveRequete('.$slno.',0)"';
                    echo '<td><button class="btn"  onclick='.$fctApp.'>Approuver</button> 
                        <button onclick='.$fctRef. 'class="btn" >Refuser</button></td>';
                }
                echo '<td></td>';
            }            
			else if ($type == "2") {
				$requete = 'SELECT * FROM offres WHERE id = "'.$row["cid"].'";';
				$result1 = $conn->query($requete) or die("Erreur 412417246424");
				$rowcovoi = mysqli_fetch_array($result1); 
				$statut = $row["statut"];
				$slno = $row["slno"];
                echo '<td><a href="trajet.php?id='. $row["cid"] . '" >'. $rowcovoi["source"] . ' - '. $rowcovoi["destination"] . '</a></td>'; 
				$uid2 = $row["expediteur"];
				$nom = getNom($uid2);
                echo '<td><a href="profil.php?id='.$uid2.'" >'.$nom.'</a></td>';
				if ($statut == "A") {
					echo '<td>Approuvé, profitez !</td>';
				}
				else if ($statut == "R"){
					echo '<td>Désolé votre demande est refusé !</td>';
				}
				else {
					echo 'alert("Erreur 2452457651567")';
				}

			}
			else if ($type == "3"){
				$requete = 'SELECT * FROM offres WHERE id = "'.$row["cid"].'";';
				$result1 = $conn->query($requete) or die("Erreur 4225465313567656");
				$rowcovoi = mysqli_fetch_array($result1); 
				$statut = $row["statut"];
				$slno = $row["slno"];
                echo '<td><a href="trajet.php?id='. $row["cid"] . '" >'. $rowcovoi["source"] . ' - '. $rowcovoi["destination"] . '</a></td>'; 
				$uid2 = $row["expediteur"];
				$nom = getNom($uid2);
                echo '<td><a href="profil.php?id='.$uid2. '" >'.$nom.'</a></td>';
				echo '<td>En attente de réponse, revenez plus tard !</td>';

			}   
		}

	} 
?>
    </tbody>
    </table>
        
</div>
		<div class="span1"></div>
</div>

</div>
<?php
	include('includes/footer.php');
?>

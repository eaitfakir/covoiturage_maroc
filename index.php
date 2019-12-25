<?php
/*
 * Page d'index du site
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
			<h2 align="center"><small>Derniers trajets (cliquez sur le trajet qui vous intéresse pour plus de détails)</small></h2>
			<?php
						$aujourdhui = date("Y-m-d");
						$requete ="SELECT id, source , destination , datedebut, duree, prix FROM offres WHERE datedebut >= '".$aujourdhui."' AND nbpersonne > 0";
						$result = $conn->query($requete);
						$i = 0;
						if (($result->num_rows) == 0) {
		          	    	echo("<p align='center'>Aucun trajet de prévu pour le moment :( </p>\n");     	  
						}
		          	  	else {
							echo '<table id="tabListe" class="table table-hover">
								<thead><tr> <th> ID </th> <th> De </th> <th> À </th> <th> Date de départ </th> <th> Durée </th> <th> Prix</th></tr></thead>
								<tbody>';
									
							while (($i < 10) && ($colonne = mysqli_fetch_array($result))) {
								echo "<tr><td>".$colonne['id']."</td><td>".$colonne['source']."</td><td>".$colonne['destination']."</td><td>".$colonne['datedebut']."</td><td>".$colonne['duree']."</td><td><span class=\"label label-info\">".$colonne['prix']." MAD</span></td></tr>";
								$i++;
							}
						}
					?>
					</tbody>
			</table>
		</div>
	</div>
</div>
<?php
	include('includes/footer.php');
?>

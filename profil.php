<?php
/*
 * Page de profil
 */
	require_once('includes/fonctions.php');
	if (!estConnecte())
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
		<div class="span5"></div>
		<div class="span5">
			<?php if (isset($_GET['id'])){
				$requete = "SELECT * FROM utilisateurs WHERE uid = ".$_GET['id'];
				$res = $conn->query($requete);
				$recuperer = mysqli_fetch_array($res);
				$nom = $recuperer['nom'];
				$email = $recuperer['email'];
				$sexe = $recuperer['sexe'];
				$telephone = $recuperer['telephone'];
				$desc = $recuperer['description'];
				$id = $_GET['id'];
				if ($sexe == "M") {
					$sex="Homme";
				}	
				else $sex="Femme";
				
				echo "<p>Nom : &nbsp; <strong>".$nom." </strong></p>";
				echo "<p>E-mail : &nbsp; <strong>".$email."</strong></p>";
				echo "<p>Sexe : &nbsp; <strong>".$sex." </strong></p>";
				echo "<p>Téléphone : &nbsp; <strong>+(212) ".$telephone."</strong></p>";
				echo "<p>Description : &nbsp; <strong>".$desc."</strong></p>";

			}
			else {
				$uid = $_SESSION['identification'];
				$requete = "SELECT * FROM utilisateurs WHERE uid = '".$uid."'";
				$res = $conn->query($requete);
				$recuperer = mysqli_fetch_array($res);
				$nom = $recuperer['nom'];
				$email = $recuperer['email'];
				$sexe = $recuperer['sexe'];
				$telephone = $recuperer['telephone'];
				$desc = $recuperer['description'];
				if ($sexe == "M") {
					$sex="Homme";
				}
				else $sex="Femme";
				
				echo "<p>Nom : &nbsp; <strong>".$nom." </strong></p>";
				echo "<p>E-mail : &nbsp; <strong>".$email."</strong></p>";
				echo "<p>Sexe : &nbsp; <strong>".$sex." </strong></p>";
				echo "<p>Téléphone : &nbsp; <strong>+(212) ".$telephone."</strong></p>";
				echo "<p>Description : &nbsp; <strong>".$desc."</strong></p>";

			}
			
			?>
			

		</div>
		<div class="span2"></div>
</div>

</div>
<?php
	include('includes/footer.php');
?>
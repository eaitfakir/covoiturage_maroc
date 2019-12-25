<?php
/*
 * Script d'inscription
 */

	require_once('includes/fonctions.php');
	if(estConnecte())
		header("Location: index.php");
	else if(isset($_POST['action'])) {
		$conn = connexionBDD();
		$nom = $_POST['nom'];
		if($_POST['action']=='inscription') {
			$motdepasse = $_POST['motdepasse'];
			$email = $_POST['email'];
			$telephone = $_POST['telephone'];			
			$sexe = $_POST['sexe'];
			$desc = $_POST['description'];

			if($sexe == "femme"){
				$sex = "F";
			}
			else {
				$sex = "M";
			}
			
				$requete = "SELECT uid FROM utilisateurs WHERE email = '".$email."'";
				$result = $conn->query($requete) or die($conn->error);
				if (($result->num_rows) != 0) {
					header("Location: senregistrer.php?existe=1");
				}
				else {
					$sql = "INSERT INTO utilisateurs (nom , motdepasse , email , sexe , telephone , description ) VALUES ('".$nom."', '".$motdepasse."', '".$email."','".$sex."','".$telephone."','".$desc."')";
					$conn->query($sql) or die($conn->error);
					header("Location: connexion.php?enregistrer=1");
				}
			
		}
	}
?>

<?php
include("includes/header.php");
?>

 <div class="container">
  <div class="span12"> 
	<?php
		include('includes/messages.php');
	?>
      <form method="post" action="senregistrer.php">
        <input type="hidden" name="action" value="inscription"/>
        <h1><small>S'enregistrer maintenant (ne pas utiliser d'accents dans les champs ci-dessous)</small></h1>
        <input type="text" name="nom" placeholder="Nom" required/><br/>
        <input type="password" name="motdepasse" placeholder="Mot de passe"  required/><br/>
        <input type="text" name="email" placeholder="E-mail" required/><br/>
        <div class="input-prepend">
		<span class="add-on">+(212)</span>
		Numéro : <input class="span2" id="prependedInput" type="text" name="telephone" placeholder="Numéro" required>
		</div>
		<div class="input-group">
		  <span class="input-group-addon">
			<input type="radio" name="sexe" value="homme"> Homme
		  </span>
		  <br/>
		  <span class="input-group-addon">
			<input type="radio" name="sexe" value="femme"> Femme
		  </span>
		</div>
		<br/>
		<textarea width="500px" rows="3" name="description" placeholder="Votre description peut aider les gens à vous envoyez une requête de trajet plus facilement !"></textarea>
		<br/>
        <input class="btn btn-primary" type="submit" name="submit" value="S'enregistrer"/>
	</form>
	</div>
    </div> <!-- /container -->
	
	

<?php
	include('includes/footer.php');
?>




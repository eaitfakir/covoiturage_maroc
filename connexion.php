<?php
/*
 * Script de connexion
 */
	require_once('includes/fonctions.php');
	if (estConnecte())
		header("Location: index.php");
	else if (isset($_POST['action'])) {
		$email = $_POST['email'];
		if ($_POST['action'] == 'connexion') {
			if(trim($_POST['email']) == "" or trim($_POST['motdepasse']) == "")
				header("Location: connexion.php?erreurvide=1"); 
			else {
				$conn = connexionBDD();			
				$requete = "SELECT * FROM utilisateurs WHERE email = '".$_POST['email']."'";
				$result = $conn->query($requete);
				$champs = mysqli_fetch_array($result);
				$motdepasse = $_POST['motdepasse'];
				if($motdepasse == $champs['motdepasse']) {
					$_SESSION['identification'] = $champs['uid'];
					header("Location: index.php");

				} else
					header("Location: connexion.php?erreur=1");
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
      <h1><small>Connexion</small></h1>
      <p>Connectez-vous pour continuer</p><br/>
      <form method="post" action="connexion.php">
        <input type="hidden" name="action" value="connexion"/>
        Adresse e-mail : <input type="text" name="email"/><br/>
        Mot de passe : <input type="password" name="motdepasse"/><br/><br/>
        <input class="btn" type="submit" name="submit" value="Connexion"/>
      </form>
      <hr/>
      <form>
        <h1><small>Nouvel utilisateur ? Enregistrez-vous !</small></h1>
        <a href="senregistrer.php" class="btn btn-info" role="button"> S'enregistrer </a>
    </form>
	</div>
    </div> <!-- /container -->

<?php
	include('includes/footer.php');
?>



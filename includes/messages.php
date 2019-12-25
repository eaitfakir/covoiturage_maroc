<?php
	if (isset($_GET['partager']))
		echo("<div class=\"alert alert-info\">\nVotre trajet a été ajouté !\n</div>");
	else if (isset($_GET['erreurvide']))
		echo("<div class=\"alert alert-error\">\nEntrez tout les détails demandés avant de continuer !\n</div>");
	else if(isset($_GET['succes']))
          echo("<div class=\"alert alert-success\">\nVotre requête a été envoyé au conducteur pour qu'il l'approuve. Vérifiez vos notifications fréquemment !\n</div>");
	else if(isset($_GET['deconnexion']))
          echo("<div class=\"alert alert-info\">\nVous vous êtes déconnecté !\n</div>");
    else if(isset($_GET['erreur']))
          echo("<div class=\"alert alert-error\">\nNom d'utilisateur ou mot de passe incorrect !\n</div>");
    else if(isset($_GET['enregistrer']))
          echo("<div class=\"alert alert-success\">\nVous vous êtes enregistré avec succès ! Connectez-vous pour continuer.\n</div>");
    else if(isset($_GET['existe']))
          echo("<div class=\"alert alert-error\">\nCette adresse e-mail existe déjà ! Choisissez une adresse e-mail différente !\n</div>");
?>
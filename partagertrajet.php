<?php
/*
 * Script de partage de trajet
 */ 
	require_once('includes/fonctions.php');
	if(!estConnecte())
		header("Location: connexion.php");
	else
		$conn = connexionBDD();

?>

<!DOCTYPE html>
<html lang="fr"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Covoiturage Maroc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/common.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="css/datetimepicker.css">

    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body onload="load()">
    <div id="wrap">
      <div class="container-fluid">
        <header class="row-fluid">          
          <div class="span2">
            <img src="img/logo.png" width="150">
          </div>          
          <div class="span10">
              <div class="row-fluid">
                <div class="span10">
                  <h3 align="center">Covoiturage Maroc</h3>
                </div>
                <div class="span2">
                    <a class="btn btn-warning" href="index.php" role="button">Accueil</a>
                </div>
              </div>
        </div> 
        </header> 
      </div> 

<div class="container">

	  
	<?php
		include('includes/messages.php');
	?>

<?php
include('includes/menu.php');
?>

	<div class="row-fluid" id="main-content">
		<div class="span2"></div>

            <div class="span5">
                <h2 align="center"><small>Partagez votre trajet</small></h2>
                <hr>
                <br/>
                <form method="post" action="includes/miseajour.php" >
                    <input type="hidden" name="action" value="partager" />
                    <input type="hidden" id="total" name="nbRequetes" value=0 />
                    <input type="text" id="source" name="source" data-provide="typeahead" class="typeahead" placeholder="Source" required/><br/>
                    <div class="inputs">
                    </div>
                    <input type="text" id="destination" name="destination" data-provide="typeahead" class="typeahead" placeholder="Destination"  required/><br/>

                    Date de début de votre trajet : <br>
                    <div id="choixdatedebut" class="input-append date">
                        <input type="date" name="datedebut" required>
                        <span class="add-on">
				        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
				      </span>
                    </div> <br/>
                    Type de véhicule : <br/> <label class="radio inline">
                        <input type="radio" name="vehicule" value="Voiture">Voiture
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="vehicule" value="taxi">Taxi
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="vehicule" value="minibus">Mini-Bus
                    </label>
                    <br/> <br/>
                    Durée : <br>
                    <div class="input-append">
                        <input type="time" name="duree" placeholder="Durée" required>
                        <!--<span class="add-on"></span>-->
                    </div>
                    <br/>
                    <input type="number" name="nbpersonne" min="1" placeholder="Nombre de places" required> <br/>
                    <div class="input-prepend">
                        <span class="add-on">MAD</span>
                        <input class="span10" id="prependedInput" type="number" name="prix" step="0.01" min="1" placeholder="Prix par personne" required>
                    </div>
                    <br/>
                    <br/>
                    Description : <br>
                    <textarea width="500px" rows="3" name="descriptiontrajet" placeholder="Autre détails qui pourrait aider les  gens à sélectionner votre trajet"></textarea> <br/>
                    <input class="btn" type="submit" name="envoyer" value="Partager"/>
                </form>
            </div>

		<div class="span1"></div>
		<div class="span5" style="margin-top: 150px;width: 400px; height: 400px">
            <div class="text-center text-info"><h1>Covoiturage !</h1></div>
            <div class="text-center text-success"><h2>L'expérience</h2></div>
            <div class="text-center text-success"><h2>la plus folle</h2></div>
            <div class="text-center text-success"><h2>de ta vie.</h2></div>
		</div>
	</div>
</div>
<?php
	include('includes/footer.php');
?>
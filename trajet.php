<?php
/*
 * Page de trajet
 */
	require_once('includes/fonctions.php');
	if(!estConnecte())
		header("Location: connexion.php");
	else
		$conn = connexionBDD();

?>

<!DOCTYPE html>
<html lang="fr"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Covoiturage Maroc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/common.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
     href="css/datetimepicker.css">

    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body onload="load()">
    <div id="wrap">

      <!-- Fixed navbar -->
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
			<h2 align="center"><small>Informations sur le trajet</small></h2>
			<hr>
      <br/>
      <?php 
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $requete = "SELECT * FROM offres WHERE id = ".$id;
        $result = $conn->query($requete);
        if (($result->num_rows) == 0) {
            echo("<p align='center'>Il semblerait que vous ayez entré une URL qui n'existe pas ! Revenez à la page précédente !</p>\n");
          }
        else{
          $row = mysqli_fetch_array($result);
          $uid = $row['uid'];
          $source = $row['source'];
          $destination = $row['destination'];
          $datedebut = $row['datedebut'];
          $duree = $row['duree'];
          $nbpersonne = $row['nbpersonne'];
          $prix = $row['prix'];
          $vehicule=$row['vehicule'];
          $desc = $row['description'];
          $cid = $row['id'];
		  $uidlive = getIdUtilisateur();
          
      ?>
<form method="post" action="ajoutertrajet.php">
  Conducteur : <a href="<?php echo "profil.php?id=".$uid;?>" > <?php echo getNom($uid); ?></a> <br/>
  Date de départ : <?php echo $datedebut ?> <br/>
  Lieu de départ : <?php echo $source; ?> <br/>
  Lieur d'arrivée: <?php echo $destination; ?> <br/>
  Durée: <?php echo $duree; ?> <br/>
  Places disponibles : <?php echo $nbpersonne; ?> <br/>
  Prix par personne : <?php echo $prix; ?> <br/>
  Type de véhicule : <?php echo $vehicule; ?> <br/>
  Description : <?php echo $desc; ?> <br/>
  <br/>
  <?php $aujourdhui = date("Y-m-d");
  if ($uidlive != $uid) { ?>
  <?php if ($datedebut >= $aujourdhui) { ?>
  <?php if ($nbpersonne > 0) { ?>
  <h2> <small>Réservation</small></h2>
    <input type="hidden" id="formsource" name="source" value=<?php echo $source; ?> />
    <input type="hidden" id="formdestination" name="destination" value="<?php echo $destination; ?>" />
    <input type="hidden" name="uid" value=<?php echo getIdUtilisateur(); ?> />
    <input type="hidden" name="cid" value=<?php echo $cid; ?> />
	
	  
            Pour réserver une place, cliquez sur le bouton ci-dessous

	  <br/><br/>
    </select> 
    <input class="btn btn-success" type="submit" name="submit" value="Réserver"/>

</form>

	<?php } 
	else { 
		echo"<h3><small> Il n'y a plus de place disponible :( </small></h3>"; 
	}  ?>
	
       <?php }
        else{
          echo"<h3><small> Trajet archivé ! Revenez à la page précédente ! </small></h3>";
        }
	?>
	
	<?php } 
		else { 
			echo"<h3><small> Vous n'allez pas réserver de place pour votre propre trajet !! </small></h3>";
		}  
	?>
	
	
	<?php	
	
      }
      }
	  
      
	  else{
echo("<p align='center'>Il semblerait que vous ayez entré une URL qui n'existe pas ! Revenez à la page précédente !</p>\n");
      }?>
      
		</div>
		<div class="span5" id="carte" style="width: 400px; height: 400px">
		</div>
	</div>
</div>
<?php
	include('includes/footer.php');
?>
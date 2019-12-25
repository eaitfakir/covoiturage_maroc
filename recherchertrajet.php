<?php
/*
 * Script de recherche de trajet
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
include('includes/menu.php');
?>
	<div class="row-fluid" id="main-content">
		<div class="span1"></div>
		<div class="span12"> 
			<h2 align="center"><small>Rechercher un covoiturage</small></h2>
			<hr>
      		<br/>
			<form method="post" action="recherchertrajet.php">
          <?php if(isset($_POST['action'])){?>
           <input type="hidden" name="action" value="search" />
       		 <input type="text" name="source" value="<?php echo $_POST['source']?>" data-provide="typeahead" class="typeahead" placeholder="Source" required/><br/>
    	    	<input type="text" name="destination" value="<?php echo $_POST['destination']?>" data-provide="typeahead" class="typeahead" placeholder="Destination" required/><br/>
   				 <br/>
    			<input class="btn" type="submit" name="submit" value="Rechercher"/>
      		</form>
			</div>
			
			<div class="span1"></div>
			<div class="span10"> 
			<h2 align="center"><small>Résultats</small></h2> <hr/>
			
      <?php if(isset($_POST['action'])){
	  
		
          $source = $_POST['source'];
          $destination = $_POST['destination'];
          //$datedebut = $_POST['datedebut'];
          $aujourdhui = date("Y-m-d");
		  $compt = 0;
          /*$taxi = 0; $voiture = 0; $poussepousse = 0;
          if(isset($_POST['taxi'])) $taxi = 1;
          if(isset($_POST['voiture'])) $voiture = 1;
          if(isset($_POST['poussepousse'])) $poussepousse = 1;*/

          $requete = "SELECT R1.cid FROM route R1 INNER JOIN route R2 ON R1.via = '".$source."' AND R2.via = '".$destination."' AND R1.numeroserie < R2.numeroserie AND R1.cid = R2.cid";
          $result = $conn->query($requete) or die($conn->error);
          while ($temp = mysqli_fetch_array($result)) {
			$requete2 = "SELECT id FROM offres WHERE id ='".$temp['cid']."' AND datedebut >= '".$aujourdhui."'";
			$result2 = $conn->query($requete2) or die($conn->error);
			if (($result2->num_rows) != 0) {
			
					$compt++;			  
            }
		  }			
          if (($result->num_rows) == 0 || $compt == 0) {
                echo("<p align='center'>Aucun trajet ne correspond à votre recherche :( </p>\n");
          }
          else {            
            echo '<table id="tabListe" class="table table-hover">
                <thead><tr><th>ID</th> <th> De </th> <th> À </th> <th> Date de départ </th> <th> Durée </th> <th> Prix</th></tr></thead>
                <tbody>';

           $requete3 = "SELECT R1.cid FROM route R1 INNER JOIN route R2 ON R1.via = '".$source."' AND R2.via = '".$destination."' AND R1.numeroserie < R2.numeroserie AND R1.cid = R2.cid";
          $result3 = $conn->query($requete3) or die($conn->error);
        
           while ($row = mysqli_fetch_array($result3)) {
              $requete4 = "SELECT id,source,destination,datedebut,duree,prix FROM offres WHERE id ='".$row['cid']."' AND datedebut >= '".$aujourdhui."'";
              $result4 = $conn->query($requete4) or die($conn->error);
              if (($result4->num_rows) == 0) {
              }
              else {
				  $result5 = mysqli_fetch_array($result4);
              
				  echo "<tr><td>".$result5['id']."</td><td>".$result5['source']."</td><td>".$result5['destination']."</td><td>".$result5['datedebut']."</td><td>".$result5['duree']."</td><td><span class=\"label label-info\">".$result5['prix']." MAD</span></td></tr>";
			  }
          }


           }

      }
  ?>
  </tbody>
      </table>
	</div>
			
			
      <?php } else{ ?>
	  <div class="span12"> 
      <input type="hidden" name="action" value="search" />
          <input type="text" name="source"  data-provide="typeahead" class="typeahead" placeholder="Source" required/><br/>
          <input type="text" name="destination"  data-provide="typeahead" class="typeahead" placeholder="Destination"  required/><br/>
          <br/>
          <br/>
          <input class="btn" type="submit" name="submit" value="Rechercher"/>
       </form>
      </div>

          <?php } ?>

    </div>
	</div>
</div>
<?php
	include('includes/footer.php');
?>

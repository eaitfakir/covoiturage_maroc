<?php
/*
 * Footer pour les pages utilisateurs
 */
?>
	
	<!-- JS placé à la fin pour un chargement plus rapide -->
    
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/datetimepicker.js"></script>
	
	<script>
		$(".dropdown-menu li a").click(function(){
			var texte = $(this).text();
            $('#fartDropDown').html(texte);
        
		});

		function ApprouveRequete (slno, stat) {
			if (stat == "0") {
				$.post("includes/miseajournotification.php", { type: "1", numeroNo: slno, stat: "R" })
				.done(function(data) {
					//alert("Données chargées : " + data);
					location.reload();
				});     
            } 
            else if (stat == "1") {
				$.post("includes/miseajournotification.php", { type: "1", numeroNo: slno, stat: "A" })
				.done(function(data) {
					//alert("Données chargées : " + data);
					location.reload();
				});     
            }
            else {
				alert("Erreur 8656896753");
            }
		}

		$('.dropdown-toggle').dropdown();
	  
    </script>

    <script type="text/javascript">
		$('#choixdatedebut').datetimepicker({
			format: 'yyyy-MM-dd',
		});
	  
		$('td:nth-child(1),th:nth-child(1)').hide(); // pour cacher les ID
		$('#tabListe').find('tr').click( function() {
			var colonne = $(this).find('td:first').text();
			window.location.href = "trajet.php?id="+colonne;
		});
    </script>
  
  </body>
  </html>
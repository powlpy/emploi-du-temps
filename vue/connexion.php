<h2>Connexion au site</h2>

<?php
// si il y a des eu des erreurs, on les affiches
if (!empty($erreurs_connexion)) {

	echo '<ul>'."\n";
	// on affiche les erreurs une par une
	foreach($erreurs_connexion as $e) {
	
		echo '	<li>'.$e.'</li>'."\n";
	}
	
	echo '</ul>';
}
// affichage du formulaire
echo $form_connexion;
?>

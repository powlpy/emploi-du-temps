<?php
include '../modele/Form.php';
$form_connexion = new Form('formulaire_connexion');

$form_connexion->method('POST');

$form_connexion->add('Text', 'nom_utilisateur')
               ->label("Votre nom d'utilisateur");

$form_connexion->add('Password', 'mot_de_passe')
               ->label("Votre mot de passe");

$form_connexion->add('Submit', 'submit')
               ->value("Connectez-moi !");

// Création d'un tableau des erreurs
$erreurs_connexion = array();

// Si le formulaire est valide avec les données issues du tableau $_POST
if ($form_connexion->is_valid($_POST)) {
	
	list($nom_utilisateur, $mot_de_passe) =
		$form_connexion->get_cleaned_data('nom_utilisateur', 'mot_de_passe');
	

	include '../modele/Utilisateur.php';
	$id_utilisateur = Utilisateur::connect($nom_utilisateur, md5($mot_de_passe)); // md5 ou sha1
	
	// Si les identifiants sont valides
	if ($id_utilisateur != null) {

		$infos_utilisateur = Utilisateur::getUtilisateurById($id_utilisateur);
		
		// On enregistre les informations dans la session
		$_SESSION['id']     = $id_utilisateur;
		$_SESSION['pseudo'] = $nom_utilisateur;
		//$_SESSION['avatar'] = $infos_utilisateur['avatar'];
		//$_SESSION['email']  = $infos_utilisateur['adresse_email'];
		
		// Affichage de la confirmation de la connexion
		echo '../index.php';
	
	} else {

		$erreurs_connexion[] = "Couple nom d'utilisateur / mot de passe inexistant.";
		
		// On réaffiche le formulaire de connexion
		//include 'connexion.php';
		echo 'mauvais mdp';
	}
	
} else {

    // On réaffiche le formulaire de connexion
    //include 'connexion.php';
    echo 'formulaire non valide';
}

?>

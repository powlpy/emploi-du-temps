<?php

include '../modele/Form.php';

// "formulaire_connexion" est l'ID unique du formulaire
$form_connexion = new Form('formulaire_connexion', 'POST');
$form_connexion->action('validConnexion.php');

$form_connexion->add('Text', 'nom_utilisateur')
               ->label("Votre nom d'utilisateur");

$form_connexion->add('Password', 'mot_de_passe')
               ->label("Votre mot de passe");

$form_connexion->add('Submit', 'submit')
               ->value("Connectez-moi !");

// Pré-remplissage avec les valeurs précédemment entrées (s'il y en a)
$form_connexion->bound($_POST);

include '../vue/connexion.php';
?>

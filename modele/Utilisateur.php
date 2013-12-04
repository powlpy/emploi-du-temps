<?php
include '../base/accesBDD.php';

class Utilisateur{
	private $id;
	private $nom;
	private $prenom;
	private $adresse;
	private $email;
	private $hashMdp;
	private $droits;
	
	//getter
	public function id() {
		return $this->id;
	}
	
	public function nom() {
		return $this->nom;
	}
	
	public function prenom() {
		return $this->prenom;
	}
	
	public function hashMdp() {
		return $this->hashMdp;
	}
	
	public function email() {
		return $this->email;
	}
	
	public function adresse() {
		return $this->adresse;
	}
	
	public function droits() {
		return $this->droits;
	}
	
	//setter
	public function setNom($nom){
		$this->nom = $nom;;
	}
	
	public function setPrenom($prenom){
		$this->prenom = $prenom;
	}
	
	public function setHashMdp($hash){
		$this->hashMdp = $hash;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setAdresse($adresse){
		$this->adresse = $adresse;
	}
	
	public function setDroits($droits){
		$this->droits = $droits;
	}
	
	//constructeur
	public function __construct ($nom, $prenom, $email, $adresse, $hash, $droits, $id = null) {
		$this->id = $id;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->adresse = $adresse;
		$this->email = $email;
		$this->hashMdp = $hash;
		$this->droits = $droits;
	}
	
	public static function getUtilisateurById ($id){
		$req = "SELECT * FROM Utilisateur WHERE id='$id'";
		$res = mysql_query($req) or die ("erreur insertion Utilisateur::getUtilisateurById : ".mysql_error());
		
		if (mysql_num_rows($res) == 0) //l'utilisateur n'existe pas
			return null;
			
		$tuple = mysql_fetch_array($res);
		return new Utilisateur($tuple['nom'], $tuple['prenom'], $tuple['email'], $tuple['adresse'], $tuple['hashMdp'], $tuple['droits'], $id);
	}
	
	public static function getUtilisateurByEmail ($email){
		$req = "SELECT * FROM Utilisateur WHERE email='$email'";
		$res = mysql_query($req) or die ("erreur insertion Utilisateur::getUtilisateurByEmail : ".mysql_error());
		
		if (mysql_num_rows($res) == 0) //l'utilisateur n'existe pas
			return null;
			
		$tuple = mysql_fetch_array($res);
		return new Utilisateur($tuple['nom'], $tuple['prenom'], $tuple['email'], $tuple['adresse'], $tuple['hashMdp'], $tuple['droits'], $tuple['id']);
	}
	
	public static function connect ($email, $hash){
		$req = "SELECT * FROM Utilisateur WHERE email='$email' AND hashMdp='$hash'";
		$res = mysql_query($req) or die ("erreur insertion Utilisateur->connect : ".mysql_error());
		
		if (mysql_num_rows($res) == 0) //l'utilisateur n'existe pas
			return null;
			
		$tuple = mysql_fetch_array($res);
		return $tuple['id'];
	}
}

?>

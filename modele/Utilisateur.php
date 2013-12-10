<?php
class Utilisateur{
    private $id;
    private $nom;
    private $prenom;
    private $adresse;
    private $email;
    private $hashMdp;
    private $droits;
    private $groupeTD;
    private $numero;
    
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
    
    public function groupeTD() {
        return $this->groupeTD;
    }
    
    public function numero() {
        return $this->numero;
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
    
    public function setGroupeTD($groupeTD){
         $this->groupeTD = $groupeTD;
    }
    
    public function setNumero($numero){
         $this->numero = $numero;
    }
            
    //constructeur
    public function __construct ($nom, $prenom, $email, $adresse, $hash, $droits, $numero, $groupeTD, $id = null) {
           $this->id = $id;
          $this->nom = $nom;
          $this->prenom = $prenom;
          $this->adresse = $adresse;
           $this->email = $email;
           $this->hashMdp = $hash;
          $this->droits = $droits;
        $this->groupeTD = $groupeTD;
           $this->numero = $numero;
    }
    
    public static function getUtilisateurById ($id){
        $req = "SELECT * FROM Utilisateur WHERE id='$id'";
        $res = mysql_query($req) or die ("erreur insertion Utilisateur->getUtilisateurById : ".mysql_error());
       
        if (mysql_num_rows($res) == 0){ //l'utilisateur n'existe pas
               return null;
        }    
        else{
             $tuple = mysql_fetch_array($res);
               return new Utilisateur($tuple['nom'], $tuple['prenom'], $tuple['email'], $tuple['adresse'], $tuple['hashMdp'], $tuple['droits'], $tuple['numero'], $tuple['groupeTD'], $id);
         }
    }
   
    public static function getUtilisateurByEmail ($email){
        $req = "SELECT * FROM Utilisateur WHERE email='$email'";
        $res = mysql_query($req) or die ("erreur insertion Utilisateur->getUtilisateurByEmail : ".mysql_error());
       
        if (mysql_num_rows($res) == 0){ //l'utilisateur n'existe pas
               return null;
        }
        else{
        $tuple = mysql_fetch_array($res);
        return new Utilisateur($tuple['nom'], $tuple['prenom'], $tuple['email'], $tuple['adresse'], $tuple['hashMdp'], $tuple['droits'], $tuple['numero'], $tuple['groupeTD'], $id);
        }
    }
    
    public function create () {
        $req = "INSERT INTO Utilisateur ('$nom', '$prenom', '$email', '$adresse', '$hashMdp', '$droits', '$numero', '$groupeTD', null)";
        $res = mysql_query($req) or die ("erreur insertion Utilisateur->create : ".mysql_error());
    }
    
    public function save () {
        $id = $this->id;
          $nom = $this->nom  ;
          $prenom = $this->prenom;
          $adresse = $this->adresse;
           $email = $this->email;
           $hashMdp = $this->hash;
          $droits = $this->droits;
        $groupeTD = $this->groupeTD;
       $numero = $this->numero;
        $req = "UPDATE utilisateurs SET nom='$nom', prenom='$prenom', email='$email',
        adresse='$adresse', hashMdp='$hashMdp', droits='$droits', numero='$numero', groupeTD='$groupeTD' WHERE id='$id'";
        mysql_query($req) or die ("erreur insertion Utilisateur->save");
    }
    
    public static function connect ($email, $hash){
                $req = "SELECT * FROM Utilisateur WHERE email='$email' AND hashMdp='$hash'";
                $res = mysql_query($req) or die ("erreur insertion Utilisateur->connect : ".mysql_error());
                
                if (mysql_num_rows($res) == 0) // mauvais email ou mot de passe
                        return null;
                        
                $tuple = mysql_fetch_array($res);
                return $tuple['id'];
        }
}

?>

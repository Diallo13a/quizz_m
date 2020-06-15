<?php

include("define.php");
function redirection($url,$time=0){
    if(!headers_sent()){
        header("refresh: $time;url=$url");
        exit;
    }else {
        echo '<meta http-equiv="refresh" contents="',$time,';url=',$url,'">';
    }
}
class Bdd{
    private static $connexion = null;
    public static function connectBdd(){
        if (!self::$connexion) {
            self::$connexion = new PDO (DNS,USER,PASS);
            self::$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        }
        return self::$connexion;
    }
}
?>

<?php
class Connexion{
    
    public static function deconnexion($redirection){
     $_SESSION = array();
     
        Session_destroy();
        if(!empty($redirection)){
            redirection($redirection);
        }
    }

    //verif login
    public static function verifLogin($login){    
        $resultat= Bdd::connectBdd()->prepare('SELECT * FROM membres WHERE  NOM_ad=:NOM_ad');
        $resultat->execute(array(':NOM_ad'=> $login));
        
       if ($resultat->rowCount()===1) {
            return true;
        }else {
            return false;
        }
    }

    //verif password
    public static function verifPass($pass,$login){
        $resultat= Bdd::connectBdd()->prepare('SELECT * FROM membres WHERE  NOM_ad=:NOM_ad');
        $resultat->execute(array(':NOM_ad'=> $login));
        $donnee = $resultat ->fetch(PDO::FETCH_ASSOC);
        if ($pass===$donnee['password']) {
            return true;
        }else{
            return false;
        }
    }
    public static function connexionCreate(){
        $mes = '';
        if(!empty($_POST['username']) AND !empty($_POST['password'])){
            $log=htmlspecialchars(stripcslashes(trim($_POST['username'])));
            $password = htmlspecialchars(stripcslashes(trim($_POST['password'])));
            if (Connexion::verifLogin($log)) {
                if(Connexion::verifPass($password,$log)){
                    $_SESSION['Id']=Connexion::recupId($log);
                    Connexion::niveau($log);
                    
                }else {
                    return false;

                }
            } else {
                return false;
            }
            
        }
    }
    public static function niveau($login){
        $resultat = Bdd::connectBdd()->prepare('SELECT * FROM membres WHERE  NOM_ad=:NOM_ad');
        $resultat->execute(array(':NOM_ad'=> $login));
        $donnee = $resultat->fetch(PDO::FETCH_ASSOC);
        switch ($donnee['type']) {
            case 'admin':
                $_SESSION['type']='admin';
                $redirect = redirection('pages/admin.php');
                break;
            case 'joueur':
                $_SESSION['type']='joueur';
                $redirect = redirection('pages/joueur.php');
                break;
            
        }
        return $redirect;
    }

    //fonction de deconnexion
    public static function recupId($login){
        $resultat = Bdd::connectBdd()->prepare('SELECT * FROM membres WHERE  NOM_ad=:NOM_ad');
        $resultat->execute(array(':NOM_ad'=> $login));
        $donnee=$resultat->fetch(PDO::FETCH_ASSOC);
        return $donnee['Id'];
    }

    public static function decTotal($id){
        if (empty($id)) {
            redirection('../index.php');
        }
    }

}
#######################################################################################################################
class register{
    public static function enregistrement($type){
        if (!empty($_POST['nom']) AND !empty($_POST['prenom'])  
        AND !empty($_POST['password_un']) AND !empty($_POST['password_deux'])) {
            $nom=htmlspecialchars(stripcslashes(trim($_POST['nom']))); 
            $prenom=htmlspecialchars(stripcslashes(trim($_POST['prenom'])));   
            $password_un=htmlspecialchars(stripcslashes(trim($_POST['password_un'])));  
            $password_deux=htmlspecialchars(stripcslashes(trim($_POST['password_deux'])));   
            if (!Connexion::verifLogin($nom)) {
                if ($password_un==$password_deux) {
                    $idd='';
                    $mess='';
                    $ret=false;
                    $img_type='';
                    $img_nom='';
                    $taille_max=1000000;
                    $ret=is_uploaded_file($_FILES['image']['tmp_name']);
                    if($ret){
                    $img_type=$_FILES['image']['type'];
                    $img_nom=$_FILES['image']['name'];
                    $tmp=$_FILES['image']['tmp_name'];
                    $last_ext=strrchr($img_nom, ".");
                    $tab= array('.jpg','.JPG','.jpeg','.JPEG','.gif','.GIF','.png','.PNG' );
                    if(in_array($last_ext, $tab)){
                    $taille=$_FILES['image']['size'];
                    if($taille < $taille_max){
                    $destinationf='../public/images/'.$img_nom;
                    move_uploaded_file($tmp, $destinationf);
                    $destination='../public/images/'.$img_nom;
                    $resultat=Bdd::connectBdd()->prepare("INSERT INTO membres(Id,NOM_ad,Prenom_ad,password,type,stamp,nom_photo,type_photo) values(:Id,:NOM_ad,:Prenom_ad,:password,:type,:stamp,:nom_photo,:type_photo)");
                    $resultat -> bindParam(':Id', $idd);
                    $resultat -> bindParam(':NOM_ad', $nom);
                    $resultat -> bindParam(':Prenom_ad', $prenom);
                    $resultat -> bindParam(':password', $password_un);
                    $resultat -> bindParam(':type', $type);
                    $resultat -> bindParam(':stamp', $destination);
                    $resultat -> bindParam(':nom_photo', $img_nom);
                    $resultat -> bindParam(':type_photo', $img_type);
                    $resultat -> execute();
                    $mess= '<font size="2" Face="Arial Black" color="green">Votre enregistrement a bien réussi</font>';
                    }else{
                    $mess= '<font size="2" Face="Arial Black" color="red">la taille est trop grande</font>';
                    }
                    }else{
                    $mess='<font size="2" Face="Arial Black" color="red">extention non autorisé</font>';
                    }
                    }else{
                    $mess='<font size="2" Face="Arial Black" color="red">Vous devez séléctionner un élément</font>';
                    }
            }else {
                $mess= 'Les mots de pass ne sont pas identiques';
            } 
            }else {
                $mess= 'Ce login existe déja';
            } 
            
        }else {
        $mess= '<font size="2" Face="Arial Black" color="red">Veuillez remplir toutes les champs</font>';
        }
        return $mess;
    }

    public static function selectImage($id){
        $resultat=Bdd::connectBdd()->prepare('SELECT stamp FROM membres WHERE Id=:Id');
        $resultat->execute(array(':Id'=> $id));
        $donnee=$resultat->fetch(PDO::FETCH_ASSOC);
        return $donnee['stamp'];
    }

    public static function afficheJoueur($type){
        $resultat=Bdd::connectBdd()->prepare('SELECT * FROM membres WHERE type=:type ORDER BY score DESC LIMIT 5 ');
        $resultat->execute(array(':type'=> $type));
        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function supprimer($id){
        $resultat=Bdd::connectBdd()->prepare('DELETE FROM  membres WHERE Id="'.$id.'" ');
        $resultat->bindParam(':Id', $id);
        $resultat->execute();
    }
    public static function modifier($id){
        $resultat=Bdd::connectBdd()->prepare('SELECT * FROM membres WHERE Id=:Id');
        $resultat->execute(array(':Id'=> $id));
        while($donnee=$resultat->fetch(PDO::FETCH_ASSOC)){
        echo '<div class="row">
        <div class="col-lg-4">
            <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group" style="margin-top:20px ;">
              
              <input type="text" class="form-control" name="nom" value="'.$donnee['NOM_ad'].'" id="" aria-describedby="helpId" placeholder="Login">
              <small id="helpId" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              
              <input type="text" class="form-control" name="prenom" value="'.$donnee['Prenom_ad'].'" id="" aria-describedby="helpId" placeholder="Prenom">
              <small id="helpId" class="form-text text-muted"></small>
            </div>
           
            <div class="form-group">
              
              <input type="password" class="form-control" name="password_un" value="'.$donnee['password'].'" id="" aria-describedby="helpId" placeholder="Mot de pass">
              <small id="helpId" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              
              <input type="password" class="form-control" name="password_deux" id="" aria-describedby="helpId" placeholder="Confirmer mot de pass">
              <small id="helpId" class="form-text text-muted"></small>
            </div>
           <div class="form-group">
             <label for=""></label>
             <img src="'.$donnee['stamp'].'"  style="margin-left:700px;margin-top:-200px;width:100px;height:100px"/>
             <input type="file" class="form-control" name="image" id="" aria-describedby="helpId" placeholder="" style="margin-left:600px;margin-top:-80px">
             <small id="helpId" class="form-text text-muted"></small>
             <div class="row">
                 <button id="valider" type="submit" name="modifier" class="btn btn-success" style="margin-top:150px">Modifier</button>
             </div>
           </div>
            </form>
        </div>
    </div>';
}
if (isset($_POST['modifier'])) {
    extract($_POST);
    $idd=$_GET['id'];
    $mess='';
    $ret=false;
    $img_type='';
    $img_nom='';
    $taille_max=1000000;
    $ret=is_uploaded_file($_FILES['image']['tmp_name']);
    if($ret){
    $img_type=$_FILES['image']['type'];
    $img_nom=$_FILES['image']['name'];
    $tmp=$_FILES['image']['tmp_name'];
    $last_ext=strrchr($img_nom, ".");
    $tab= array('.jpg','.JPG','.jpeg','.JPEG','.gif','.GIF','.png','.PNG' );
    if(in_array($last_ext, $tab)){
    $taille=$_FILES['image']['size'];
    if($taille < $taille_max){
    $destinationf='../public/images/'.$img_nom;
    move_uploaded_file($tmp, $destinationf);
    $destination='../public/images/'.$img_nom;
    $resultat=Bdd::connectBdd()->prepare('UPDATE membres SET NOM_ad=:NOM_ad, Prenom_ad=:Prenom_ad, password=:password, stamp=:stamp, nom_photo=:nom_photo, type_photo=:type_photo WHERE Id=:Id');
    $resultat -> bindParam(':Id', $idd);
    $resultat -> bindParam(':NOM_ad', $nom);
    $resultat -> bindParam(':Prenom_ad', $prenom);
    $resultat -> bindParam(':password', $password_un);
    $resultat -> bindParam(':stamp', $destination);
    $resultat -> bindParam(':nom_photo', $img_nom);
    $resultat -> bindParam(':type_photo', $img_type);
    $resultat -> execute();
    $mess= '<font size="2" Face="Arial Black" color="green">Votre enregistrement a bien réussi</font>';
    }else{
    $mess= '<font size="2" Face="Arial Black" color="red">la taille est trop grande</font>';
    }
    }else{
    $mess='<font size="2" Face="Arial Black" color="red">extention non autorisé</font>';
    }
    }else{
        $resultat=Bdd::connectBdd()->prepare('UPDATE membres SET NOM_ad=:NOM_ad, Prenom_ad=:Prenom_ad, password=:password WHERE Id=:Id');
        $resultat->bindParam(':Id', $idd);
        $resultat->bindParam(':NOM_ad', $nom);
          $resultat->bindParam(':Prenom_ad', $prenom);
          $resultat->bindParam(':password', $password_un);
          $resultat->execute();
    }
    
}
       
    } 
}
?>
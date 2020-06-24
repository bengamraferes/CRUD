<?php
require('config.php');
if (isset($_POST['valider']) AND isset($_GET['id']) ){
    $id = (int) htmlspecialchars( $_GET['id']);
    if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['mail']) AND isset($_POST['salaire']) AND isset($_POST['dateEmbauche']) AND isset($_POST['poste']) ){
        $prenom = (string) htmlspecialchars($_POST['prenom']) ;
        $nom = (string) htmlspecialchars($_POST['nom']);
        $mail = (string) htmlspecialchars($_POST['mail']);
        $salaire = (int) htmlspecialchars($_POST['salaire']);
        $dateEmbauche =  htmlspecialchars($_POST['dateEmbauche']);
        $poste = (string) htmlspecialchars($_POST['poste']);
        if (empty($nom) OR empty($prenom) OR empty($mail) OR empty($salaire) OR empty($dateEmbauche) OR empty($poste)){
               echo 'un champ de saisie est vide';
        }
        else{
             try
             {
                //   $bdd->exec("INSERT INTO `employees`(`id`, `firstname`, `name`, `email`, `post`, `salary`, `hiring_date`) VALUES (NULL,`$nom`,''dsffd,'@','chéf',200,2020-05-01)");
                $requetteUpdate = $bdd->prepare("UPDATE `employees` SET `firstname`= :prenom,`lastname`= :nom,`email`= :mail,`post`= :poste,`salary`= :salaire,`hiring_date`= :dateEmbauche WHERE id = :id ");
                  //VALUES (:id, :prenom, :nom, :mail, :poste, :salaire, :dateEmbauche)
                $requetteUpdate->execute(array(
                'prenom'=> $nom,
                'nom'=>$prenom,
                'mail'=> $mail,
                'poste'=> $poste,
                'salaire'=> $salaire,
                'dateEmbauche'=> $dateEmbauche,
                'id'=> $id
            ));
            
                 header('Location: ./index.php');
                 exit;
             }
             catch(Exception $e){
                die('Erreur : '.$e->getMessage());
             }
             
           
            }
    }
    
}
?>
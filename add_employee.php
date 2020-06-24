<?php
require('config.php');
 if (isset($_POST['valider'])){
    if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['mail']) AND isset($_POST['salaire']) AND isset($_POST['dateEmbauche']) AND isset($_POST['poste']) ){
        $prenom = (string) htmlspecialchars($_POST['prenom']) ;
        $nom = (string) htmlspecialchars($_POST['nom']);
        $mail = (string) htmlspecialchars($_POST['mail']);
        $salaire = (int) htmlspecialchars($_POST['salaire']);
        $dateEmbauche =  htmlspecialchars($_POST['dateEmbauche']);
        $poste = (string) htmlspecialchars($_POST['poste']);
        echo $nom.'</br>';
        echo $prenom.'</br>';
        echo $mail.'</br>';
        echo $salaire.'</br>';
        echo $poste.'</br>';
        echo $dateEmbauche.'</br>';
        if (empty($nom) OR empty($prenom) OR empty($mail) OR empty($salaire) OR empty($dateEmbauche) OR empty($poste) ){
               echo 'un champ de saisie est vide';
        }
        else{
             try
             {
                //   $bdd->exec("INSERT INTO `employees`(`id`, `firstname`, `name`, `email`, `post`, `salary`, `hiring_date`) VALUES (NULL,`$nom`,''dsffd,'@','chéf',200,2020-05-01)");
                $requette = $bdd->prepare("INSERT INTO `employees`(`id`, `firstname`, `name`, `email`, `post`, `salary`, `hiring_date`)
                 VALUES (:id, :prenom, :nom, :mail, :poste, :salaire, :dateEmbauche)");
                $requette->execute(array('id'=> NULL,
                'prenom'=> $nom,
                'nom'=>$prenom,
                'mail'=> $mail,
                'poste'=> $poste,
                'salaire'=> $salaire,
                'dateEmbauche'=> $dateEmbauche
            ));

                // header('Location: ./index.php');
                // exit;
             }
             catch(Exception $e){
                die('Erreur : '.$e->getMessage());
             }
             
           
            }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="./add_employee.php" method = "POST"  >
        <p>Prénom : <input type="text" name ="prenom"></p>
        <p>Nom : <input type="text" name = "nom"></p>
        <p>Mail : <input type="email" name = "mail"></p>
        <p>Poste : <input type="text" name = "poste"></p>
        <p>Slaire : <input type="number" name = "salaire"></p>
        <p>Date d'embauche : <input type="date" name = "dateEmbauche"></p>
        <p><button type="submit" name ="valider">Accéder </button></p>
        </form>
</body>
</html>